<?php

use PHPUnit\Framework\TestCase;
use App\Worker as Worker;

class WorkerTest extends TestCase
{
    /**
     * We will test here that the Worker Class exists and can instiate.
     * 
     */
    public function testItCanInstantiate()
    {
        $worker = new Worker();

        $this->assertInstanceOf('App\Worker' , $worker);
    }

    /**
     * We will test here that the lifespan starts off has 75 hitpoints 
     */
    public function testLifeSpanStarts75()
    {
        $worker = new Worker();

        $this->assertEquals(75 , $worker->getLifeSpan() );
    }

    /**
     * Get Remaining Hits 
     */
    public function testCanGetRemainingHits()
    {
        $worker = new Worker();

        $this->assertEquals(8 , $worker->getRemainingHits() );
    }

    /**
     * We will test here that the hit function will deduct 10 points from the lifespan
     */
    public function testHitDeducts10()
    {
        $worker = new Worker();

        $worker->hit();

        $this->assertEquals(65 , $worker->getLifeSpan() );
    }

    /**
     * We will test here that the hit function will return message
    */
    public function testHitReturnMessage()
    {
        $worker = new Worker();

        $this->assertEquals("Direct Hit. You took 10 hit points from a Worker bee" , $worker->hit());
    }

    /**
     * We will test here that the hit function will return the message informing us the bee has died
    */
    public function testHitReturnDeathMessage()
    {
        $worker = new Worker();

        for($i = 0; $i < 7; $i++) $worker->hit();

        $this->assertEquals("Direct Hit. You have killed a worker bee!" , $worker->hit());
    }

    /**
     * We will test here that the bee dies.
     * We do this by hitting it 8 times
     */
    public function testItCanDie()
    {
        $worker = new Worker();

        for($i = 0; $i < 8; $i++) $worker->hit();

        $this->assertEquals(0 , $worker->getLifeSpan());
    }

    /**
     * We will test here that it can quickKilled
     */
    public function testItCanDieQuickly()
    {
        $worker = new Worker();

        $worker->quickKill();

        $this->assertEquals(0 , $worker->getLifeSpan());
    }

    /**
     * We will test here that an exception is thrown if the user 
     * tries to kill a bee thats already dead
     * We do this by hitting it 9 times
     */
    public function testItThrowsExceptionIfHitWhenDead()
    {
        $worker = new Worker();

        for($i = 0; $i < 8; $i++) $worker->hit();

        $this->expectException('Exception');
        $this->expectExceptionMessage("Worker is already dead!");

        $worker->hit();
    }
}