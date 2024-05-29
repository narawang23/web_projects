<!--
Filters and displays tasks based on user-selected criteria like priority, due date, and status.
Only accessible to logged-in users, redirecting to login if necessary. 
-->

<?php
require_once ('../database/taskService.php');
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../pages/logIn.html");
    exit;
}

// Retrieve filter parameters
$priority = isset($_GET['priority']) ? $_GET['priority'] : null;
$dueDate = isset($_GET['dueDate']) ? $_GET['dueDate'] : null;
$status = isset($_GET['status']) ? $_GET['status'] : null;

// Use TaskService to get filtered tasks
$taskService = new TaskService();
$userId = $_SESSION['user_id'];
$filteredTasks = $taskService->filterTasks($priority, $dueDate, $status, $userId);

// Output the list of tasks in HTML
echo '<div class="tasks">';
foreach ($filteredTasks as $task) {
    echo '<div class="task">';
    echo '<div class="task-title">' . htmlspecialchars($task['taskName']) . '</div>';
    echo '<div>Description: ' . htmlspecialchars($task['description']) . '</div>';
    echo '<div>Priority: ' . htmlspecialchars($task['priority']) . '</div>';
    echo '<div>Status: ' . htmlspecialchars($task['status']) . '</div>';
    echo '<div>Due Date: ' . htmlspecialchars($task['dueDate']) . '</div>';
    echo '<div class="task-buttons">';
    echo '<button class="edit" data-task-id="' . htmlspecialchars($task['taskId']) . '">Edit</button>';
    echo '<button class="delete" data-task-id="' . htmlspecialchars($task['taskId']) . '">Delete</button>';
    echo '</div>';
    echo '</div>';
}
echo '</div>';

// If no tasks are found, output a message
if (empty($filteredTasks)) {
    echo "<p>Oops, no task found.</p>";
}

?>