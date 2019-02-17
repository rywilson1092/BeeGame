<?php

namespace App;

use Exception;

class Queen extends Bee{
    
    /**
    * @var int
    */

    private $lifeSpan = 100;

    /**
    * @var int
    */

    private $perHit = 8;

    public function hit() : string
    {
       if($this->lifeSpan > 0)
       {
            if(($this->lifeSpan - $this->perHit) <= 0 ) $this->lifeSpan = 0;
            else $this->lifeSpan -= $this->perHit;
            
            if($this->lifeSpan === 0) return "Direct Hit. You have killed the Queen. The other Bees will die!";
            else return "Direct Hit. You took {$this->perHit} hit points from a Queen bee";
       }else{
           throw new exception("Queen is already dead!");
       }
    }
    
    public function getLifeSpan() : int
    {
        return $this->lifeSpan;
    }

    public function getRemainingHits() : int
    {
        if($this->lifeSpan > 0) return ceil($this->lifeSpan / $this->perHit);
        else return 0;
    }
}