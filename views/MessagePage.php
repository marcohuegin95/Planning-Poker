<?php

abstract class MessagePage{

    protected $message;

    protected $err;


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

?>

 