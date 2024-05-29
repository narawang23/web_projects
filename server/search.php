
<?php
session_start();
require_once ('../database/taskService.php');
require_once ('../server/tasks.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: ./pages/logIn.php");
    exit;
}
if (!isset($_POST['query'])) {
    header("Location: ./pages/taskManagement.php");
    exit;
}

$taskService = new TaskService();
$searchTerm = $_POST['query'];//document.querySelector("#searchTerm").value;
$tasks = $taskService->searchTasks($searchTerm);

// Check if there are tasks returned
if ($tasks) {
    foreach ($tasks as $task) {
        // Here, echo out the HTML structure for each task
        echo '<div class="task">';
        echo '<div class="task-title">' . htmlspecialchars($task['taskName']) . '</div>';
        echo '<div>Description: ' . htmlspecialchars($task['description']) . '</div>';
        echo '<div>Priority: ' . htmlspecialchars($task['priority']) . '</div>';
        echo '<div>Status:' . htmlspecialchars($task['status']) . '</div>';
        echo '<div>Due Date: ' . htmlspecialchars($task['dueDate']) . '</div>';
        echo '<div class="task-buttons">';
        echo '<button class="edit" onclick="editTask(' . htmlspecialchars($task['taskId']) . ')">Edit</button>';
        echo '<button class="delete" onclick="deleteTask(' . htmlspecialchars($task['taskId']) . ')">Delete</button>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo "<p>No task found for your search term.</p>";
}
?>