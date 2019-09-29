<?php

namespace TvSeries\PL\app_start;
use TvSeries\BLL\service\AppServices;

class Routes {

    private $controllerPrefix = "TvSeries\\PL\\Controllers\\";
    private $currentController = "SeriesController";
    private $currentMethod = "home";
    private $currentArguments = [];

    function __construct() {
        $urlList = $this->getUrl();
        if (isset($urlList[0])) {
            $fileName = ucwords($urlList[0])."Controller";
            if (file_exists(dirname(__DIR__)."/controllers/{$fileName}.php")) {
                $this->currentController = $fileName;
                unset($urlList[0]);
            }
        }

        $controllerFullName = $this->controllerPrefix.$this->currentController;
        $this->currentController = new $controllerFullName(new AppServices());
        if (isset($urlList[1])) {
            if (method_exists($this->currentController, $urlList[1])) {
                $this->currentMethod = $urlList[1];
                unset($urlList[1]);
            }
        }
        $this->currentArguments = $urlList ? array_values($urlList) : [];
        call_user_func_array([$this->currentController, $this->currentMethod], $this->currentArguments);
    }

    function getUrl() {
        if ($url = filter_input(INPUT_GET, "url")) {
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = rtrim($url, "/");
            $url = explode("/", $url);
            return $url;
        }
    }

}
