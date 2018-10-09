<?php 


class Vote{
    

    private $id;

    private $name;

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
     * Get the value of members
     */ 
    public function getMembers()
    {
        return $this->members;
    }

    /**
     * Set the value of members
     *
     * @return  self
     */ 
    public function setMembers($members)
    {
        $this->members = $members;

        return $this;
    }

    /**
     * Get the value of user_storys
     */ 
    public function getUser_storys()
    {
        return $this->user_storys;
    }

    /**
     * Set the value of user_storys
     *
     * @return  self
     */ 
    public function setUser_storys($user_storys)
    {
        $this->user_storys = $user_storys;

        return $this;
    }

    public function validate(){
        
    }

}



?>