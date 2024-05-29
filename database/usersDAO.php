<?php
/**
 * The usersDAO class, extending abstractDAO, 
 * manages database operations related to the 'users' table. 
 * It offers functionality to check user existence, 
 * add new users, and retrieve user details and IDs,
 * using secure prepared statements to mitigate SQL injection risks.
 */

require_once ('abstractDAO.php');
require_once ('../server/users.php');
class usersDAO extends abstractDAO
{
    public function __construct()
    {
        try {
            parent::__construct();
        } catch (mysqli_sql_exception $e) {
            throw $e;
        }
    }
    public function userExists($userName, $email)
    {
        $stmt = $this->mysqli->prepare("SELECT userId FROM users WHERE userName = ? OR email = ?");
        $stmt->bind_param("ss", $userName, $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }
    public function addUser($userName, $password, $email)
    {
        // Hashing the password before storing it
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->mysqli->prepare("INSERT INTO users (userName, password, email) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $userName, $hashedPassword, $email);
        $result = $stmt->execute();

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    public function getUserByUserName($userName)
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM users WHERE userName = ?");
        $stmt->bind_param("s", $userName);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            return new users($user['userId'], $user['userName'], $user['password'], $user['email']);
        } else {
            return null;
        }
    }

    public function getUserIdByUserName($userName)
    {
        $stmt = $this->mysqli->prepare("SELECT userId FROM users WHERE userName = ?");
        $stmt->bind_param("s", $userName);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            return $user['userId'];
        } else {
            return null;
        }
    }

}
