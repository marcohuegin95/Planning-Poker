<?php
require 'Page.php';

class LoginPage implements Page{


    public function render(){
        include ("templates/login.html");
    }


}