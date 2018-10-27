<?php
require 'Page.php';
require 'MessagePage.php';

/**
 * LoginPage
 *
 * Zeigt die Login Seite an
 * @author Timon Müller-Wessling
 */
class LoginPage extends MessagePage implements Page{

    public function render(){
        include ("templates/login.php");
    }



}