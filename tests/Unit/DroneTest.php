<?php

use PHPUnit\Framework\TestCase;
use App\Drone as Drone;

class DroneTest extends TestCase
{
    /**
     * We will test here that the Drone Class exists and can instiate.
     * 
     */
    public function testItCanInstantiate()
    {
        $drone = new Drone();

        $this->assertInstanceOf('App\Drone' , $drone);
    }

    /**
     * We will test here that the lifespan starts off has 50 hitpoints 
     */
    public function testLifeSpanStarts50()
    {
        $drone = new Drone();

        $this->assertEquals(50 , $drone->getLifeSpan() );
    }

     /**
     * Get Remaining Hits 
     */
    public function testCanGetRemainingHits()
    {
        $drone = new Drone();

        $this->assertEquals(5 , $drone->getRemainingHits() );
    }

    /**
     * We will test here that the hit function will deduct 12 points from the lifespan
     */
    public function testHitDeducts12()
    {
        $drone = new Drone();

        $drone->hit();

        $this->assertEquals(38 , $drone->getLifeSpan() );
    }

    /**
     * We will test here that the hit function will return message
    */
    public function testHitReturnMessage()
    {
        $drone = new Drone();

        $this->assertEquals("Direct Hit. You took 12 hit points from a Drone bee" , $drone->hit());
    }

    /**
     * We will test here that the hit function will return the message informing us the bee has died
    */
    public function testHitReturnDeathMessage()
    {
        $drone = new Drone();

        for($i = 0; $i < 4; $i++) $drone->hit();

        $this->assertEquals("Direct Hit. You have killed a drone Bee!" , $drone->hit());
    }

    /**
     * We will test here that the bee dies.
     * We do this by hitting it 5 times
     */
    public function testItCanDie()
    {
        $drone = new Drone();

        for($i = 0; $i < 5; $i++) $drone->hit();

        $this->assertEquals(0 , $drone->getLifeSpan());
    }

    /**
     * We will test here that it can quickKilled
     */
    public function testItCanDieQuickly()
    {
        $drone = new Drone();

        $drone->quickKill();

        $this->assertEquals(0 , $drone->getLifeSpan());
    }

    /**
     * We will test here that an exception is thrown if the user 
     * tries to kill a bee thats already dead
     * We do this by hitting it 6 times
     */
    public function testItThrowsExceptionIfHitWhenDead()
    {
        $drone = new Drone();

        for($i = 0; $i < 5; $i++) $drone->hit();

        $this->expectException('Exception');
        $this->expectExceptionMessage("Drone is already dead!");

        $drone->hit();
    }
}