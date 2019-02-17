<?php

namespace App;

abstract class Bee{

    /**
    * @var int
    */

    private $lifeSpan;

    /**
    * @var int
    */

    private $perHit;

    abstract function hit() : string;
    abstract function getLifeSpan() : int;
    abstract function getRemainingHits() : int;
}