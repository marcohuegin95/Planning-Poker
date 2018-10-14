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
        print_r( $dao->getVotings(1));;
        
    }

}