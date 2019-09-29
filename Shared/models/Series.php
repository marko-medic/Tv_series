<?php

namespace TvSeries\Shared\models;

class Series {

    public $title;
    public $episodes;
    public $duration;
    public $seasons;

    public function __construct($title, $episodes, $duration, $seasons) {
        $this->title = $title;
        $this->episodes = $episodes;
        $this->duration = $duration;
        $this->seasons = $seasons;
    }
}