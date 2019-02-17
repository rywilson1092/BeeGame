<?php

use PHPUnit\Framework\TestCase;
use App\Hive as Hive;

class HiveTest extends TestCase
{
    /**
     * We will test here that the Hive Class exists and can instiate.
     * 
     */
    public function testItCanInstantiate()
    {
        $hive = new Hive();

        $this->assertInstanceOf('App\Hive' , $hive);
    }

    /**
     * Test that the hive starts off with 14 bees
     * We will check that all of these bees parent class is bee
    */

    public function testHiveStartsWith14Bees()
    {
        $hive = new Hive();
        $bees = $hive->getBees();

        $numBees = 0;

        foreach($bees as $bee)
        {
            if(get_parent_class($bee) === "App\Bee") $numBees += 1;
        }

        $this->assertEquals(14 , $numBees );
    }

    /**
     * Test that there is 1 queen Bee
     * We will loop over all bees to see that the number of queens are 1
    */

    public function testHiveStartsWith1Queen()
    {
        $hive = new Hive();
        $bees = $hive->getBees();

        $numQueens = 0;

        foreach($bees as $bee)
        {
            if(get_class($bee) === "App\Queen") $numQueens += 1;
        }

        $this->assertEquals(1 , $numQueens);
    }

    /**
     * Test that there is 5 worker bees
     * We will loop over all bees to see that the number of workers are 5
    */

    public function testHiveStartsWith5Workers()
    {
        $hive = new Hive();
        $bees = $hive->getBees();

        $numWorkers = 0;

        foreach($bees as $bee)
        {
            if(get_class($bee) === "App\Worker") $numWorkers += 1;
        }

        $this->assertEquals(5 , $numWorkers);
    }

    /**
     * Test that there is 8 drone bees
     * We will loop over all bees to see that the number of drones are 8
    */

    public function testHiveStartsWith8Drones()
    {
        $hive = new Hive();
        $bees = $hive->getBees();

        $numDrones = 0;

        foreach($bees as $bee)
        {
            if(get_class($bee) === "App\Drone") $numDrones += 1;
        }

        $this->assertEquals(8 , $numDrones);
    }

    /**
     * Test that we can hit the hive
    */

    public function testCanHitHive()
    {
        $hive = new Hive();

        $resultMessage = $hive->hit();

        if($resultMessage === "Direct Hit. You took 8 hit points from a Queen bee"
            ||
           $resultMessage === "Direct Hit. You took 10 hit points from a Worker bee"
            ||
           $resultMessage === "Direct Hit. You took 12 hit points from a Drone bee"
        )
        {
            $this->assertTrue(true);
        }else{
            $this->assertTrue(false);
        }
    }

    /**
     * Test can get the status of the hive
     * To win the game either the queen bee must be killed or all bees
     * At the beginning of the game. We calculate how many remaining hits:
     * This should equate to (Queen ceil(100 / 8) = 13 ) 
     * + (Worker 5 x ceil(75 / 10) = 8 = 40  )  
     * + (Drone 8 x ceil(50 / 12)  = 5 = 40)
     * It should start with a total of 93 hits 
    */

    public function testCanGetRemainingHits()
    {
        $hive = new Hive();

        $this->assertEquals(93 , $hive->getRemainingHits());
    }


    /**
     * Test can get at least win the game after 93 hits
    */

    public function testCanWinTheGame()
    {
        $hive = new Hive();

        $result = false;

        for($i = 0; $i < 93; $i++)
        {
            $hive->hit();
            
            if($hive->getRemainingHits() === 0)
            {
                $result = true;
                break;
            }
        }

        $this->assertTrue( $result );
    }
}