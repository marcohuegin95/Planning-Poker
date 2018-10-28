<?php

require 'database/VotingDAOMySQL.php';
require 'database/UserDAOMySQL.php';
require 'model/UserStory.php';
require 'views/DashboardPage.php';
require 'views/NewGamePage.php';
require 'views/GamePage.php';

/**
 * PokerController
 *
 * Kontroller für alle Spielrelevanten funktionen 
 */
class PokerController{

    /**
    * Displays the login dialoge 
    */
    public function index(){
        $this->showDashboard(null, null);
    }

    /**
     * Zeigt das Dashbaord an
     * Optinal können Meldungen mitgegeben werden
     */
    private function showDashboard($msg, $err){
        $dao = new VotingDAOMySQL();
        $votes = $dao->getVotings($_SESSION["userid"]);  
        
        $page = new DashboardPage($votes);
        if ($msg != NULL && !empty($msg)){
            $page->setMessage($msg);
        }
        if ($err != NULL && !empty($err)){
            $page->setError($err);
        }
        $page->render();
        
    }

    /**
     * Zeigt die Spieleseite zu einer übergebenen id an
     */
    public function gamePage(){
        if (isset($_GET['id'])){
            $dao = new VotingDAOMySQL();
            $vote = $dao->getVote($_SESSION['userid'], $_GET['id']);
            if($vote != null){
                $page = new GamePage($vote);
                $page->render();
            }else{
                $this->showDashboard(null, 'Datensatz kann zum aktuellen Nutzer nicht geladen werden');    
            }
        }else{
            $this->showDashboard(null, 'Fehlerhafter Aufruf');
        }
        
    }

    /**
     * Zeigt die seite für die Erstellung einer neuen Abstimmung an
     */
    public function newGamePage(){
        $accDao = new UserDAOMySQL();
        $users = $accDao->getAllUsers();

        $page = new NewGamePage($users);
        $page->render();
    }

    
    /**
     * Lädt die abgestimmten Punkte für den momentan angemdeten Benutzer
     */
    public function loadPointsForCurrentUser(){
        if (isset($_GET['storyid'])){
            $dao = new VotingDAOMySQL();
            $points = $dao->getVotePoints($_SESSION["userid"], $_GET['storyid'], $_SESSION["userid"]);
            if ($points != NULL){
                echo $points;
            }else{
                http_response_code(500);
            }
        }else{
            http_response_code(400);
        }
    }

     /**
     * Versucht eine Abstimmung aus den POST parametern zu laden 
     * und zu speichern
     */
    public function saveGame(){
        $vote = $this->createVoteFromParams();
        if ($vote != NULL){
            $voteDao = new VotingDAOMySQL();
            if ($voteDao->insert($vote)){
                $this->showDashboard($vote->getName().' erfolgreich gespeichert', null);
            }else{
                $this->showDashboard(null, 'Fehler beim Speichern');
            }
        }else{
            $this->showDashboard(null, 'Fehlerhafter Aufruf beim Speichern');
        }
    }

    /**
     * Speichert die abgestimmten Punkte für den momentan angemeldeten Benutzer.
     * 
     */
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

    /**
     * Versucht anhand der POST Paramtern ein Vote Objekt zu erstellen
     */
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
            $accDao = new UserDAOMySQL();
            $users = [];
            foreach($_POST['users'] as $userid){
                $users[] = $accDao->getUserById($userid);
            }
            $vote->setUsers($users);
            return $vote;
        }
        return NULL;
    }

    /**
     * Lädt die abgestimmten Punkte für bestimmte Benutzer
     */
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