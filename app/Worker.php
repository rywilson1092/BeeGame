<?php

namespace App;

use Exception;

class Worker extends Bee{
     /**
    * @var int
    */

    private $lifeSpan = 75;

    /**
    * @var int
    */

    private $perHit = 10;

    public function hit() : string
    {
       if($this->lifeSpan > 0)
       {
            if(($this->lifeSpan - $this->perHit) <= 0 ) $this->lifeSpan = 0;
            else $this->lifeSpan -= $this->perHit;

            if($this->lifeSpan === 0) return "Direct Hit. You have killed a worker bee!";
            else return "Direct Hit. You took {$this->perHit} hit points from a Worker bee";
       }else{
           throw new exception("Worker is already dead!");
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