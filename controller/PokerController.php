<?php

require 'database/VotingDAOMySQL.php';
require 'database/AccountDAOMySQL.php';
require 'model/UserStory.php';
require 'views/DashboardPage.php';
require 'views/NewGamePage.php';
require 'views/GamePage.php';

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

    public function gamePage(){
        
        if (isset($_GET['id'])){
            print($_GET['id']);
            $dao = new VotingDAOMySQL();
            $vote = $dao->getVote($_SESSION['userid'], $_GET['id']);
            $page = new GamePage($vote);
            $page->render();         
        }
        
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

    public function saveVoteResultForCurrentUser(){
        if (isset($_POST['points']) && isset($_POST['user_story'])){
            $voteDao = new VotingDAOMySQL();
            if ($voteDao->setVotePoints($_SESSION["userid"], $_POST['user_story'], $_POST['points'])){
                http_response_code(200);
            }else{
                http_response_code(500);
            }
            
        }else{
            http_response_code(400);
        }
    }

    private function createVoteFromParams(){
        if(isset($_POST['game_name']) && isset($_POST['users']) && isset($_POST['story_names']) && isset($_POST['story_descriptions']) && isset($_POST['enddatum'])){
            $vote = new Vote();
            $vote->setName($_POST['game_name']);
            $vote->setEnd($_POST['enddatum']);
            
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
            return $vote;
        }
        return NULL;
    }

    public function loadPoints(){
        if (isset($_GET['userid']) && isset($_GET['storyid'])){
            $dao = new VotingDAOMySQL();
            $points = $dao->getVotePoints($_GET['userid'], $_GET['storyid'], $_SESSION["userid"]);
            if ($points != NULL){
                echo $points;
            }else{
                http_response_code(500);
            }
        }else{
            http_response_code(400);
        }
    }

    

}