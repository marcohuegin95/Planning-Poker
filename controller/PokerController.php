<?php

require 'database/VotingDAOMySQL.php';
require 'model/UserStory.php';
require 'views/DashboardPage.php';

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
        $votes = $dao->getVotings($_SESSION["userid"]);  
        
        $page = new DashboardPage($votes);
        $page->render();
    }



    public function dashboard(){
        $dao = new VotingDAOMySQL();

    }

}