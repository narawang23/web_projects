
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Task</title>
    <link rel="stylesheet" href="../styles/style.css" type="text/css">
</head>

<body>

    <form action="addTask.php" method="POST">

        <!--  <p id="user">
            <?php echo htmlspecialchars($_SESSION['user_name']); ?>
        </p> -->
        <div>
            <label for="taskName">Task Name:</label>
            <input type="text" id="taskName" name="taskName">
        </div>
        <div>
            <label for="description">Description:</label>
            <textarea id="description" name="description"></textarea>
        </div>
        <div>
            <label for="priority">Priority:</label>
            <select id="priority" name="priority">
                <option value="High">High</option>
                <option value="Medium">Medium</option>
                <option value="Low">Low</option>
            </select>
        </div>
        <div>
            <label for="status">Status</label>
            <select id="status" name="status">
                <option value="In Progress">In Progress</option>
                <option value="Over Due">Over Due</option>
                <option value="Completed">Completed</option>
            </select>
        </div>


        <div>
            <label for="dueDate">Due Date:</label>
            <input type="date" id="dueDate" name="dueDate">
        </div>
        <div>
            <button type="submit" id="taskAdd-btn">+ Add</button>
        </div>

        <p id="message"></p>

    </form>
    </div>
</body>

</html>

<?php

session_start();
require_once ('../database/taskService.php');

$userId = $_SESSION['user_id'] ?? null;

if ($userId) { // Check if $userId is not null
    $taskService = new TaskService();

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $taskName = $_POST['taskName'] ?? '';
        $description = $_POST['description'] ?? '';
        $priority = $_POST['priority'] ?? 'Low';
        $dueDate = $_POST['dueDate'];
        $status = $_POST['status'];

        // Call the addTask method of the TaskService class to add the task
        $result = $taskService->addTask($userId, $taskName, $description, $priority, $dueDate, $status);

        // Check if the task was successfully added
        if ($result) {
            echo "<script>
            document.querySelector('#message').innerText = 'Great, You Created A New Task! 👽';
            setTimeout(function() {
                window.location.href = 'taskManagement.php';
            }, 2000);
          </script>";
            exit();
        }

    }
} else {
    echo "User ID is not set. Please log in.";
}

?>