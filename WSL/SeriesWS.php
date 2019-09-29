<?php

namespace TvSeries\WSL;

class SeriesWS {
    private $jsonData;

    public function __construct()
    {
        $path = dirname(__DIR__)."/Shared/data/seriesConstrains.json";
        if (!file_exists($path)) {
            throw new \Exception("File in path $path does not exist");
        }
       $this->jsonData = file_get_contents($path);
       $this->jsonData = json_decode($this->jsonData);
    }

    public function getMinDuration() {
        return $this->jsonData->minDuration;
    }
}