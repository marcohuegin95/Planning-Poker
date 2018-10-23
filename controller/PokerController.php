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

    public function saveGame(){
        $vote = $this->createVoteFromParams();
        if ($vote != NULL){
            $voteDao = new VotingDAOMySQL();
            $voteDao->insert($vote);
            echo "hat geklappt";
            die();
        }else{
            echo 'fehler, TODO^^';
        }
    }


    private function createVoteFromParams(){
        if(isset($_POST['game_name']) && isset($_POST['users']) && isset($_POST['story_names']) && isset($_POST['story_descriptions'])){
            $vote = new Vote();
            $vote->setName($_POST['game_name']);
            //user story auslesen und dem vote hinzufügen
            $storys = [];
            if (count($_POST['story_names']) == count($_POST['story_descriptions'])){
                for($i=0; $i<count($_POST['story_names']); $i++) {
                    $userStory = new UserStory();
                    $userStory->setDescription($_POST['story_descriptions'][$i]);
                    $userStory->setTitle($_POST['story_names'][$i]);
                    $storys[] = $userStory;
                  }
            }
            $vote->setUserStorys($storys);

            //users auslesen
            $accDao = new AccountDAOMySQL();
            $users = [];
            foreach($_POST['users'] as $userid){
                $users[] = $accDao->getUserById($userid);
            }
            $vote->setUsers($users);

            $vote->setEnd(date('Y-m-d H:i:s'));
            return $vote;
        }
        return NULL;
    }

}