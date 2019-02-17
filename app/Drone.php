<?php

namespace App;

use Exception;

class Drone extends Bee{
    /**
    * @var int
    */

    private $lifeSpan = 50;

    /**
    * @var int
    */

    private $perHit = 12;

    public function hit() : string
    {
       if($this->lifeSpan > 0)
       {
           if( ($this->lifeSpan - $this->perHit) <= 0  ) $this->lifeSpan = 0;
           else $this->lifeSpan -= $this->perHit;

           if($this->lifeSpan === 0) return "Direct Hit. You have killed a drone Bee!";
           else return "Direct Hit. You took {$this->perHit} hit points from a Drone bee";
       }else{
           throw new exception("Drone is already dead!");
       }
    }
    
    public function getLifeSpan() : int
    {
        return $this->lifeSpan;
    }

    public function quickKill() : bool
    {
        $this->lifeSpan = 0;
        return true;
    }

    public function getRemainingHits() : int
    {
        if($this->lifeSpan > 0) return ceil($this->lifeSpan / $this->perHit);
        else return 0;
    }
}