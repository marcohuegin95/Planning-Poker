<?php

require 'database/VotingDAOMySQL.php';
require 'database/AccountDAOMySQL.php';
require 'model/UserStory.php';
require 'views/DashboardPage.php';
require 'views/NewGamePage.php';


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

    public function newGamePage(){
        $accDao = new AccountDAOMySQL();
        $users = $accDao->getAllUsers();

        $page = new NewGamePage($users);
        $page->render();
    }


    private function createUserFromParams(){
        if(isset($_POST['game_name']) && isset($_POST['users'])){

        }
    }

}