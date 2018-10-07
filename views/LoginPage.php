<?php
require 'Page.php';

/**
 * LoginPage
 *
 * Login Page which renders the Login Site and given messages or errors
 */
class LoginPage implements Page{

    private $message;

    private $error;

    public function render(){
        include ("templates/login.html");
    }


    /**
     * Set the value of message
     *
     * @return  self
     */ 
    public function setMessage($message)
    {
        
        $this->message = "<div class=\"alert alert-success\" role=\"alert\">
                            $message
                        </div>";

        return $this;
    }

    /**
     * Set the value of error
     *
     * @return  self
     */ 
    public function setError($error)
    {
        $this->$error = "<div class=\"alert alert-danger\" role=\"alert\">
                            $error
                        </div>";

        return $this;
    }
}