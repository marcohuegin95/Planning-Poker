<?php
require 'Page.php';

/**
 * GamePage
 *
 * Game Page which renders the Game Site
 */
class GamePage implements Page{

    public function render(){
        include ("templates/game.html");
    }
}