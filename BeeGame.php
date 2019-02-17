<?php

/* Get the autoloader */
require_once 'vendor/Autoload.php';

/* Use the hive class */
use App\Hive as Hive;

/* Instiate the Hive for the game */
$hive = new Hive();

/* Welcome message for the game */
echo "Welcome to Bees In The Trap  Type 'hit' for each turn or 'game over' to end the game: ";

/* The game will continue until game Playing */

$gamePlaying = true;

while($gamePlaying === true)
{
    /* Take in the input */
    $handle = fopen ("php://stdin","r");

    $input = fgets($handle);

    if(trim($input) === 'hit'){
        echo $hive->hit();

        /* If there are no remaining hits we end the game */
        if($hive->getRemainingHits() === 0) 
        {
            echo "\n You have succesfully destroyed the hive!";
            $gamePlaying = false;
        }
    }elseif(trim($input) === 'game over' ){
        echo "You needed {$hive->getRemainingHits()} more hits to destroy the hive.";
        $gamePlaying = false;
    }else{
        echo "Sorry did you mean 'hit' or 'game over'?";
    }

    echo "\n"; 
}

fclose($handle);