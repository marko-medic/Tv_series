<?php

namespace TvSeries\PL\Controllers;

use TvSeries\PL\controllers\base\BaseController;

class SeriesController extends BaseController {

    public $seriesService;

    public function __construct($appServices)
    {
        if (empty($appServices) || !method_exists($appServices, "getSeriesService")) {
            throw new InvalidArgumentException("App services is empty or doesn't containt Series service");
        }
        $this->seriesService = $appServices->getSeriesService();
    }

    public function home() {
        $data = [
          "name" => "Marko"
        ];

        return $this->getView("home", $data);
    }

    public function show() {
        $data = [
            "series" => [],
        ];

        $allSeries = $this->seriesService->getAllSeries();
        $data["series"] = $allSeries;
        return $this->getView("show", $data);
    }

    public function single($id) {
        $data = [
            "series" => null,
        ];
        $foundedSeries = $this->seriesService->getSeriesById($id);
        $data["series"] = $foundedSeries;
        $this->getView("series", $data);
    }
}