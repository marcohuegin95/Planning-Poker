<?php

require 'views/LoginPage.php';
require 'database/AccountDAOMySQL.php';
require 'model/Account.php';

/**
 * Route
 *
 * Handels all the register and login events 
 */
class LoginController{

    /**
    * Displays the login dialoge 
    */
    public function index(){
        $page = new LoginPage();
        $page->render()
    }

    /**
    * trys to find an account given in the post parameters and to 
    * find a search query in the database for the given user 
    */
    public function login(){
    }

    /**
    * Registers the given Account in the Database or shows an error if the account
    * is invalid 
    */
    public function register(){
        $page = new LoginPage();
        
        $account = $this->createAccountFromParams(false);
        if ($account != NULL){
            $dao = new AccountDAOMySQL();
            $dao->register($account);
            $page->setMessage('Registered successfully');
        }else{
            $page->setError('Could not register');
        }

        $page->render();
    }

    /**
    * Trys to create an account from the given POST params
    * @return Account the given account or NULL if no matching entrys could be found in the POST array 
    */
    private function createAccountFromParams($onlyemail){
        if (($onlyemail  || isset($_POST['username'])) && isset($_POST['email']) && isset($_POST['password'])){
            $account = new Account();
            if (!$onlyemail){
                $account->setUsername($_POST['username']);
            }
            $account->setEmail($_POST['email']);
            $account->setPassword($_POST['password']);
            return $account;
        }
        return NULL;
    }

}