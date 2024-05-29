<?php
/**
 * Provides user management services including 
 * authentication, registration, and checks for user existence.
 * Leverages usersDAO for database interactions, 
 * offering methods like loginUser, userExists, addUser, 
 * and getUserIdByUsername for user operations.
 * 
 */
require_once ('usersDAO.php');
require_once ('../server/users.php');

class UserServices
{
    private $usersDAO;
    public function __construct()
    {
        $this->usersDAO = new usersDAO();
    }

    // userName and password match validate
    public function loginUser($userName, $password)
    {
        $user = $this->usersDAO->getUserByUserName($userName);
        if ($user) {
            if ($password === $user->getPassword()) {
                return true; // login successes
            }
        }
        return false; // login fails
    }

    public function userExists($userName, $email)
    {
        return $this->usersDAO->userExists($userName, $email);
    }

    // register
    public function addUser($userName, $password, $email)
    {
        // add the user using the usersDAO
        $result = $this->usersDAO->addUser($userName, $password, $email);
        // Check if the addition was successful
        if ($result) {
            return true;
        } else {
            error_log($result);
            return false;
        }
    }


    // Inside UserService class
    public function getUserIdByUsername($userName)
    {
        $user = $this->usersDAO->getUserByUsername($userName);
        if ($user) {
            return $user->getUserId(); //getUserIdByUserName
        } else {
            return null;
        }
    }

}