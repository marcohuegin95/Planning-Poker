<?php 


class Vote implements JsonSerializable{
    

    private $id;

    private $name;

    private $end;

    private $users = [];

    private $user_storys = [];




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
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Set the value of users
     *
     * @return  self
     */ 
    public function setUsers($users)
    {
        $this->users = $users;

        return $this;
    }


    /**
     * get the value of users
     *
     */ 
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Get the value of user_storys
     */ 
    public function getUserStorys()
    {
        return $this->user_storys;
    }

    /**
     * Set the value of user_storys
     *
     * @return  self
     */ 
    public function setUserStorys($user_storys)
    {
        $this->user_storys = $user_storys;

        return $this;
    }

    public function validate(){
        return true;
    }


    /**
     * Get the value of end
     */ 
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * Set the value of end
     *
     * @return  self
     */ 
    public function setEnd($end)
    {
        $this->end = $end;

        return $this;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

}



?>