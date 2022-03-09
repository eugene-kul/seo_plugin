<?php namespace Eugene3993\Seo\Classes;

use Eugene3993\Seo\Models\Settings;
use Carbon\CarbonInterval;
use Carbon\Carbon;
use Request;

use System\Classes\PluginManager;

class Helper {

  public $settings;

  public function __construct() {
    $this->settings = Settings::instance();
  }

  public function url($str) {
    return $str ? url($str) : \Request::url();
  }
}
