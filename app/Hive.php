<?php

namespace App;

use App\Queen as Queen;
use App\Worker as Worker;
use App\Drone as Drone;

class Hive {
    
    /**
    * @var array
    */

    private $bees = array();

    public function __construct()
    {
        /* Get 1 queen bee and add to bees array */
        array_push($this->bees , new Queen());

        /* Get 5 worker bees and add to bees array */
        for($i = 0; $i < 5; $i++) array_push($this->bees , new Worker());

        /* Get 8 drone bees and add to bees array */
        for($i = 0; $i < 8; $i++) array_push($this->bees , new Drone());
    }

    public function getBees() : Array
    {
        return $this->bees;
    }

    public function hit() : string
    {
        /* Generate random array index */
        $randomBeeIndex = rand(0 , count($this->bees) - 1);

        /* hit a random bee */
        $result = $this->bees[$randomBeeIndex]->hit();

        /* If the bee is dead we remove from the array */
        if($this->bees[$randomBeeIndex]->getLifeSpan() === 0)
        {

            /* If it queen we kill all the bees */
            if(get_class( $this->bees[$randomBeeIndex] ) === "App\Queen")
            {
                array_splice($this->bees , $randomBeeIndex , 1);
                if(count($this->bees) > 0) $this->killAllRemainingBees();
            }else{
                array_splice($this->bees , $randomBeeIndex , 1);
            }
        }

        return $result;
    }

    /* Kill all the remaining bees */
    private function killAllRemainingBees() : void
    {
        for($i = 0; $i < count($this->bees); $i++)
        {
            $this->bees[$i]->quickKill();
        }
    }

    /* This will get the remaining hits for each bee that is remaining */

    public function getRemainingHits() : int
    {
        $remainingHits = 0;

        foreach($this->bees as $bee) $remainingHits += $bee->getRemainingHits();

        return $remainingHits;
    }
}