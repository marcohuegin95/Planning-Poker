<?php

/**
 * GamePage
 *
 * Zeigt die Spiel Seite an
 * @author Timon Müller-Wessling
 */
class GamePage implements Page{

    private $vote;

    function __construct($vote) {
        $this->vote = $vote;
    }

    public function render(){
        include ("templates/game.php");
    }

    function voteData(){
        return json_encode($this->vote);
    }
}