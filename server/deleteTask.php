<!-- 
This class is used for deleting a task based on the taskId passed via GET, 
for logged-in users only. -->
<?php
require_once ('../database/taskService.php');
session_start();

// Check if the user is logged in and the taskId parameter exists
if (isset($_SESSION['user_id']) && isset($_GET['taskId'])) {
    $userId = $_SESSION['user_id']; // Retrieve the userId from the session
    $taskId = $_GET['taskId'];

    // Initialize the TaskService and delete the task
    $taskService = new TaskService();
    $taskService->deleteTask($taskId);

    // Redirect back to the tasks page (or wherever appropriate)
    header("Location: ../pages/taskManagement.php");
} else {
    // Redirect to login page if not logged in or taskId is missing
    header("Location: ../pages/logIn.html");
    exit();
}
?>