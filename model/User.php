<?php 

/**
 * User
 *
 * User Objekt, welches einen Nutzer repräsentiert
 */
class User implements JsonSerializable{

    private $id;

    private $username;

    private $email;

    private $password;

    private $validate_error;


    /**
     * Prüft ob der Nutzer gültige Daten hat
     * Falls nicht wird das attribute validate_error gesetzt
     */
    public function validate(){
        if ($this->username && $this->email && $this->password){
            if (strlen($this->username) < 5){
                $this->validate_error = 'Nutzername muss mindestens 5 Zeichen beinhalten';
                return false;    
            }
            if (strlen($this->password) < 5){
                $this->validate_error = 'Nutzername muss mindestens 5 Zeichen beinhalten';
                return false;    
            }

        }else{
            $this->validate_error = 'Nicht gesetzte Nutzerwerte';
            return false;
        }
        return true;
    }

    /**
     * Gibt den letzen aufgetretenen Fehler zurück.
     */
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

    
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}


?>