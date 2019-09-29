<?php

namespace TvSeries\Shared\Helpers;

abstract class AppHelpers {

    public static function pre_r($content) {
        echo "<pre>";
        print_r($content);
        echo "</pre>";
    }
}