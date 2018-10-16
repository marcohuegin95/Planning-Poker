<?php
require 'Page.php';

/**
 * LoginPage
 *
 * Login Page which renders the Login Site and given messages or errors
 */
class LoginPage implements Page{

    private $message;

    private $err;

    public function render(){
        include ("templates/login.php");
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
    public function setError($err)
    {
        $this->err = "<div class=\"alert alert-danger\" role=\"alert\">
                            $err
                        </div>";
        return $this;
    }
}