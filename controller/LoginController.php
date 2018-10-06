<?php

require 'views/LoginPage.php';

class LoginController{

    
    public function index(){
        $page = new LoginPage();
        $page->render();

    }

    public function login(){
    }

    public function register(){

    }

}