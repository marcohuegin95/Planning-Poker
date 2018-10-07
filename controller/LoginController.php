<?php

require 'views/LoginPage.php';
require 'database/AccountDAOMySQL.php';
require 'model/Account.php';

class LoginController{

    
    public function index(){
        $page = new LoginPage();
        $page->render();
    }

    public function login(){
    }

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