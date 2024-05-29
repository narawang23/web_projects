<!--
The users class encapsulates user data, 
providing getters and setters for user properties.
-->
<?php

class users
{
    private $userId;
    private $userName;
    private $password;
    private $email;

    // Constructor    
    public function __construct($userId, $userName, $password, $email)
    {
        $this->userId = $userId;
        $this->userName = $userName;
        $this->password = $password;
        $this->email = $email;
    }

    // Getters and Setters for userId
    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    // Getters and Setters for userName
    public function getUserName()
    {
        return $this->userName;
    }

    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    // Getters and Setters for password
    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    // Getters and Setters for email
    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }
}
