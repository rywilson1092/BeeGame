<?php

use PHPUnit\Framework\TestCase;
use App\Queen as Queen;

class QueenTest extends TestCase
{
    /**
     * We will test here that the Queen Class exists and can instiate.
     * 
     */
    public function testItCanInstantiate()
    {
        $queen = new Queen();

        $this->assertInstanceOf('App\Queen' , $queen);
    }

    /**
     * We will test here that the lifespan starts off has 100 hitpoints 
     */
    public function testLifeSpanStarts100()
    {
        $queen = new Queen();

        $this->assertEquals(100 , $queen->getLifeSpan() );
    }

     /**
     * Get Remaining Hits 
     */
    public function testCanGetRemainingHits()
    {
        $queen = new Queen();

        $this->assertEquals(13 , $queen->getRemainingHits() );
    }

    /**
     * We will test here that the hit function will return message
    */
    public function testHitReturnMessage()
    {
        $queen = new Queen();

        $this->assertEquals("Direct Hit. You took 8 hit points from a Queen bee" , $queen->hit());
    }

    /**
     * We will test here that the hit function will return the message informing us the bee has died
    */
    public function testHitReturnDeathMessage()
    {
        $queen = new Queen();

        for($i = 0; $i < 12; $i++) $queen->hit();

        $this->assertEquals("Direct Hit. You have killed the Queen. The other Bees will die!" , $queen->hit());
    }

    /**
     * We will test here that the hit function will deduct 8 points from the lifespan
     */
    public function testHitDeducts8()
    {
        $queen = new Queen();

        $queen->hit();

        $this->assertEquals(92 , $queen->getLifeSpan() );
    }

    /**
     * We will test here that the bee dies.
     * We do this by hitting it 13 times
     */
    public function testItCanDie()
    {
        $queen = new Queen();

        for($i = 0; $i < 13; $i++) $queen->hit();

        $this->assertEquals(0 , $queen->getLifeSpan() );
    }


    /**
     * We will test here that an exception is thrown if the user 
     * tries to kill a bee thats already dead
     * We do this by hitting it 14 times
     */
    public function testItThrowsExceptionIfHitWhenDead()
    {
        $queen = new Queen();

        for($i = 0; $i < 13; $i++) $queen->hit();

        $this->expectException('Exception');
        $this->expectExceptionMessage("Queen is already dead!");

        $queen->hit();
    }
}