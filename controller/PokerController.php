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
        $vote = new Vote();
        $vote->setName('test');

        $story = new UserStory();
        $story->setDescription('das ist eine beschreibung');
        $story->setEnd(date(DATE_RFC822));

        $vote->setUserStorys(array($story));

        $dao->insert($vote);
    }

}