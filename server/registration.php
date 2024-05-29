<!--
This PHP script manages user registration, 
including validating user existence and processing new registrations. -->
<?php
session_start();
require_once ('../database/userServices.php');

$service = new UserServices();
$errorMessages = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Input processing
    $userName = trim($_POST['userName']);
    $password = trim($_POST['password']);
    $email = trim($_POST['email']);

    if ($service->userExists($userName, $email)) {
        $_SESSION['signupError'] = 'Username or email already taken, please choose another one.';
        header("Location: ../pages/index.php");
        exit();
    } else {
        if ($service->addUser($userName, $password, $email)) {
            // Successfully insert data to users table and redirect to taskManagement page
            $_SESSION['user_name'] = $userName;
            $_SESSION['user_id'] = $service->getUserIdByUsername($userName);
            header("Location: ../pages/taskManagement.php");
            exit();
        }
    }
}