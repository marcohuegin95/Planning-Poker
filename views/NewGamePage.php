<?php

/**
 * NewGamePage
 *
 * New Game Page which renders the Game Site
 */
class NewGamePage extends MessagePage implements Page{

    private $users;

    function __construct($users) {
        $this->users = $users;
    }

    public function render(){
        include ("templates/addgame.php");
    }

    private function displayUserList(){
        $result = '';
        foreach($this->users as $user){
            $result .= "<option value=".$user->getId().">".$user->getUsername()."</option>";
        }
        return $result;
    }
}