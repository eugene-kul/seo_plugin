<?php namespace Eugene3993\Seo\Classes;

use Cms\Classes\Page;
use Cms\Classes\Theme;

class Sitemap {

    private $xml;
    private $urlSet;

    function generate() {

        $pages = Page::listInTheme(Theme::getEditTheme());
        $models = [];

        foreach( $pages as $page) {
            if (!$page->use_in_sitemap ) continue;

            $modelClass = str_replace(' ', '', $page['model_class']);

            if($modelClass) {
                foreach(explode(",", $modelClass) as $itemClass) {
                    if(class_exists($itemClass)) {
                        $models = $itemClass::all();
                        foreach ($models as $model) {
                            if (!$model->use_in_sitemap) continue;
                            $this->addItemToSet(Item::asCmsPage($page, $model));
                        }
                    }
                }
            } else {$this->addItemToSet(Item::asCmsPage($page));}

        }

        return $this->make();
    }

    protected function makeRoot() {
        if ($this->xml !== null) return $this->xml;

        $xml = new \DOMDocument;
        $xml->encoding = 'UTF-8';

        return $this->xml = $xml;
    }

    protected function makeUrlSet() {
        if ($this->urlSet !== null) return $this->urlSet;

        $xml = $this->makeRoot();
        $urlSet = $xml->createElement('urlset');
        $urlSet->setAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
        $urlSet->setAttribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
        $urlSet->setAttribute('xsi:schemaLocation', 'http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd');
        $xml->appendChild($urlSet);

        return $this->urlSet = $urlSet;
    }

    protected function addItemToSet(Item $item, $url = null, $mtime = null) {
        $xml = $this->makeRoot();
        $urlSet = $this->makeUrlSet();
        $this_url = url($item->loc);
		if($item->loc == '/')$this_url = url($item->loc).'/';

        $urlElement = $this->makeUrlElement(
            $xml,
            $this_url, // make sure output is a valid url
            $item->priority
        );

        if ($urlElement) {
            $urlSet->appendChild($urlElement);
        }

        return $urlSet;
    }

    protected function makeUrlElement($xml, $pageUrl, $priority) {

        $url = $xml->createElement('url');
        $pageUrl && $url->appendChild($xml->createElement('loc', $pageUrl));
        $url->appendChild($xml->createElement('lastmod', date("c")));
        $url->appendChild($xml->createElement('changefreq', 'weekly'));
        $priority && $url->appendChild($xml->createElement('priority', $priority));

        return $url;
    }

    protected function make() {
        $this->makeUrlSet();
        return $this->xml->saveXML();
    }
}


class Item {
    public $loc, $priority;

    function __construct($url=null, $priority=null) {
        $this->loc = Self::replaceUrl($url);
        $this->priority = $priority;
    }

    public static function replaceUrl($url, $model = null) {
        if (! is_string($url)) throw new \ApplicationException("Parameter \$url must be a string");
        $params = [];
        $reg = '/:(\w+)/';
        if(!$model) $reg = '/:(\w+)[?]/';
        preg_match_all($reg, $url, $params, PREG_SET_ORDER);
        $extract =  array_pluck($params, '1', '0'); // ex: [':slug' => 'slug' ]

        $replacedUrl = $url;

        foreach ($extract as $param => $prop) {
            if($model) {
                $replacedUrl = str_replace_first($param, $model->$prop, $replacedUrl);
            } else {
                $replacedUrl = str_replace($param, '', $replacedUrl);
            }
        }

        return $replacedUrl;
    }

    public static function asCmsPage($page, $model = null) {
        if ($model) {
            return new Self(
                url(Self::replaceUrl($page->url, $model)),
                $page->priority
            );
        }
        return new Self($page->url, $page->priority);
    }
}


