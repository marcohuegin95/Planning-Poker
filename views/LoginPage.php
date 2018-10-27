<?php
require 'Page.php';
require 'MessagePage.php';

/**
 * LoginPage
 *
 * Login Page which renders the Login Site and given messages or errors
 */
class LoginPage extends MessagePage implements Page{

    public function render(){
        include ("templates/login.php");
    }



}