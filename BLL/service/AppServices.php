<?php

namespace TvSeries\BLL\service;

use TvSeries\DAL\repositories\dbService\DbConnectionService;
use TvSeries\DAL\repositories\dbService\DbService;
use TvSeries\DAL\repositories\repository\SeriesRepository;
use TvSeries\WSL\SeriesWS;

class AppServices
{
    public function getSeriesService() {
        return new SeriesService(new SeriesRepository($this->getDbService()), new SeriesWS());
    }

    private function getDbService() {
        return new DbService(new DbConnectionService());
    }
}