<?php

namespace TvSeries\DAL\repositories\repository;
use TvSeries\Shared\models\Series;

class SeriesRepository
{
    private $dbService;

    public function __construct($dbService)
    {
        if (empty($dbService)) {
            throw new \InvalidArgumentException("Db service cannot be empty");
        }
        $this->dbService = $dbService;
    }

    public function getAllSeries() {
        $seriesList = [];
        $sql = "SELECT * FROM series";
        $this->dbService->query($sql);
        $result = $this->dbService->getAll();
        foreach ($result as $item) {
            $series = new Series($item->title, $item->episodes, $item->duration, $item->seasons);
            $seriesList[] = $series;
        }
        return $seriesList;
    }

    public function getSeriesById($id) {
        $sql = "SELECT * FROM series WHERE id = '$id'";
        $this->dbService->query($sql);
        $result = $this->dbService->getRow();
        if (empty($result)) {
            return null;
        }
        $series = new Series($result->title, $result->episodes, $result->duration, $result->seasons);
        return $series;
    }
}