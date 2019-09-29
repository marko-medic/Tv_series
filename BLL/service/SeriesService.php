<?php

namespace TvSeries\BLL\service;

class SeriesService
{
    private $seriesRepository;
    private $seriesWs;

    public function __construct($seriesRepository, $seriesWs)
    {
        if (empty($seriesRepository)) {
            throw new \InvalidArgumentException("Series repository cannot be empty");
        }
        if (empty($seriesWs)) {
            throw new \InvalidArgumentException("Series web service cannot be empty");
        }
        $this->seriesRepository = $seriesRepository;
        $this->seriesWs = $seriesWs;
    }

    public function getAllSeries() {
        $results = $this->seriesRepository->getAllSeries();
        foreach ($results as $result) {
            $this->validate($result);
        }
        return $results;
    }

    public function getSeriesById($id) {
        if (empty($id)) {
            throw new \InvalidArgumentException("Id cannot be empty");
        }
        $minDuration = $this->seriesWs->getMinDuration();
        $result = $this->seriesRepository->getSeriesById($id);
        if (empty($result)) {
            throw new \Exception("Result not found");
        }
        if ($minDuration > $result->duration) {
            throw new \Exception("Series duration must be at lest: $minDuration minutes");
        }
        $this->validate($result);
        return $result;
    }

    private function validate($series) {
        if (empty($series->title) || $series->episodes < 0 || $series->duration < 0 || $series->seasons < 0) {
            throw new \InvalidArgumentException("Series is not valid");
        }
    }
}