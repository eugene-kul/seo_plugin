<?php namespace Eugene3993\Seo;

use System\Classes\PluginBase;
use System\Classes\SettingsManager;
use Eugene3993\Seo\Classes\Helper;
use System\Classes\PluginManager;
use Cms\Classes\Theme;
use Request;
use Lang;

class Plugin extends PluginBase {

    public $require = [
        'VojtaSvoboda.TwigExtensions',
    ];

    public function registerComponents() {
        return [
            'Eugene3993\Seo\Components\Meta' => 'META',
        ];
    }

    public function registerMarkupTags() {
        $helper = new Helper();
        return [
            'filters' => [
                'url' => [$helper, 'url'],
            ]
        ];
    }

    public function registerSettings() {
        return [
            'settings' => [
                'label'       => 'Seo/Sitemap/Robots',
                'description' => 'eugene3993.seo::lang.config.description',
                'icon'        => 'icon-sitemap',
                'category'    => SettingsManager::CATEGORY_CMS,
                'class'       => 'Eugene3993\Seo\Models\Settings',
                'order'       => 100,
                'permissions' => [ 'eugene3993.seo.settings' ],
            ]
        ];
    }

    public function register() {
        \Event::listen('backend.form.extendFields', function($widget) {

            if ($widget->isNested === false ) {

                if (!($theme = Theme::getEditTheme()))
                    throw new ApplicationException(Lang::get('cms::lang.theme.edit.not_found'));

                if (PluginManager::instance()->hasPlugin('RainLab.Pages')
                    && $widget->model instanceof \RainLab\Pages\Classes\Page) {

                    $widget->removeField('viewBag[meta_title]' );
                    $widget->removeField('viewBag[meta_description]');
                    $widget->addFields( array_except($this->staticSeoFields(), [
                        'viewBag[model_class]',
                    ]), 'primary');
                }

                if (PluginManager::instance()->hasPlugin('RainLab.Blog')
                    && $widget->model instanceof \RainLab\Blog\Models\Post) {
                        $widget->addFields( array_except($this->blogSeoFields(), [
                            'metadata[model_class]',
                            'metadata[changefreq]',
                            'metadata[priority]',
                        ]), 'secondary');
                }

                if (!$widget->model instanceof \Cms\Classes\Page) return;

                $widget->removeField('settings[meta_title]');
                $widget->removeField('settings[meta_description]');
                $widget->addFields($this->cmsSeoFields(), 'primary');
            }

        });
    }

    private function blogSeoFields() {
        return collect($this->seoFields())->mapWithKeys(function($item, $key) {
            return ["metadata[$key]" => $item];
        })->toArray();
    }

    private function staticSeoFields() {
        return collect($this->seoFields())->mapWithKeys(function($item, $key) {
            return ["viewBag[$key]" => $item];
        })->toArray();
    }
    private function cmsSeoFields() {
        return collect($this->seofields())->mapWithKeys(function($item, $key) {
            return ["settings[$key]" => $item];
        })->toArray();
    }

    private function seoFields() {
        $user = \BackendAuth::getUser();
        return array_except(
            \Yaml::parseFile(plugins_path('eugene3993/seo/config/seofields.yaml')),
            array_merge(
                [],
                !$user->hasPermission(["eugene3993.seo.sitemap"]) ? [
                    "use_in_sitemap",
                    "model_class",
                    "changefreq",
                    "priority",
                ] : [],
                !$user->hasPermission(["eugene3993.seo.meta"]) ? [
                    "meta_title",
                    "meta_description",
                    "canonical_url",
                ] : [],
            )
        );
    }
}
