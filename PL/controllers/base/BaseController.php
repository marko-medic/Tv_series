<?php

namespace TvSeries\PL\controllers\base;

abstract class BaseController {

    public function getView($viewName, $data = []) {
        $data = extract($data);
        $path = dirname(dirname(__DIR__))."/views/pages/$viewName" . ".php";
        if (!file_exists($path)) {
            throw new \Exception("View '$viewName' was not found");
        }
        require_once $path;
    }
}