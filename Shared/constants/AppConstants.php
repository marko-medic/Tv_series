<?php

namespace TvSeries\Shared\constants;

abstract class AppConstants {
    private static $APP_NAME = "TV series";
    private static $URL_ROOT = "http://localhost/tv_series/";

    public static function getAppName() {
        return self::$APP_NAME;
    }
    
    public static function getUrlRoot() {
        return self::$URL_ROOT;
    }
    
    public static function getAppRoot() {
        return dirname(dirname(__DIR__));
    }

}