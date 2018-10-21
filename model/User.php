<?php 

/**
 * User
 *
 * Simple User Object
 * Stores the points voted for a specific user story
 */
class User{

    private $id;

    private $username;

    private $email;

    private $password;

    private $validate_error;



    
    public function validate(){
        if ($this->username && $this->email && $this->password){
            if (strlen($this->username) < 5){
                $this->validate_error = 'Username needs to be at least 5 characters';
                return false;    
            }
            if (strlen($this->password) < 5){
                $this->validate_error = 'Password needs to be at least 5 characters';
                return false;    
            }

        }else{
            $this->validate_error = 'Empty account values';
            return false;
        }
        return true;
    }

    public function getLastValidateError(){
        return $this->validate_error;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of username
     */ 
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */ 
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password 
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }
}


?>