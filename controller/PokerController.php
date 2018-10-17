<?php

require 'database/VotingDAOMySQL.php';
require 'model/UserStory.php';

/**
 * Route
 *
 * Handels all the register and login events 
 */
class PokerController{

    /**
    * Displays the login dialoge 
    */
    public function index(){
        $dao = new VotingDAOMySQL();
        $dao->getVotings(7);  
        echo 'asd';
    }



    public function dashboard(){
        $dao = new VotingDAOMySQL();

    }

}