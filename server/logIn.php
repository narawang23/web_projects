
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once ('../database/userServices.php');
session_start();


$service = new UserServices();
$errorMessages = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userName = trim($_POST['userName']);
    $password = trim($_POST['password']);

    if (empty($userName) || empty($password)) {
        $errorMessages['loginError'] = "Please fill in both username and password.";
    } else {
        if ($service->loginUser($userName, $password)) {
            // successfully login and redirect to taskManagement page
            $_SESSION['user_name'] = $userName;
            // Retrieve the userId and store it in the session
            $_SESSION['user_id'] = $service->getUserIdByUsername($userName);
            header("Location: ../pages/taskManagement.php");
            exit();
        } else {
            $errorMessages['loginError'] = "Login failed, please retry";
        }
    }
}
