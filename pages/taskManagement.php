
<?php
require_once ('../database/taskService.php');
session_start();

// Check if the user is logged in
if (isset($_SESSION['user_name']) && isset($_SESSION['user_id'])) {
    $userName = $_SESSION['user_name']; // Retrieve the username from the session
    $userId = $_SESSION['user_id']; // Retrieve the userId from the session
} else {
    // Redirect to login page if user is not logged in
    header("Location: logIn.html");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>task management</title>
    <link rel="stylesheet" type="text/css" href="../styles/style.css">
</head>

<body>

    <div class="container">

        <div class="user_area">
            <p id="user">
                <?php echo htmlspecialchars($_SESSION['user_name']); ?>
            </p>

            <div class="logout-button">
                <button type="button" onclick="confirmLogout()">Log out</button>
                <script>
                    function confirmLogout() {
                        const logoutConfirm = confirm("Are you sure you want to logout? 👀");
                        if (logoutConfirm) {
                            window.location.href = '../server/logOut.php';
                        }
                    }
                </script>
            </div>
        </div>

        <div class="opContainer">
            <div class="search-area">
                <div class="search-box">
                    <input type="text" id="searchTerm" placeholder="Search Your Tasks">
                </div>
                <button id=search>Search</button>
            </div>
            <div class="filter-options">
                <div class="filter-group">
                    <label for="priority">Priority:</label>
                    <select id="priority" class="filter-select">
                        <option value="all">All</option>
                        <option value="high">High</option>
                        <option value="medium">Medium</option>
                        <option value="low">Low</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="dueDate">Due Date:</label>
                    <input type="date" id="dueDate" class="filter-input">
                </div>
                <div class="filter-group">
                    <label for="status">Status:</label>
                    <select id="status" class="filter-select">
                        <option value="all">All</option>
                        <option value="In Progress">In Progress</option>
                        <option value="Completed">Completed</option>
                        <option value="Over Due">Over Due</option>
                    </select>
                </div>
                <div class="filter-group">
                    <button id="apply-filter">Apply Filter</button>
                </div>
            </div>

        </div>
        <div class="tasks">
            <?php
            $taskService = new TaskService();
            if (isset($_SESSION['user_id'])) {
                $userId = $_SESSION['user_id'];
                // $userName = $_SESSION['user_name'];
                $tasks = $taskService->getTasksSortedByCreation($userId);
                foreach ($tasks as $task) {
                    $_SESSION['taskId'] = $task['taskId'];
                    echo '<div class="task">';
                    echo '<div class="task-title">' . htmlspecialchars($task['taskName']) . '</div>';
                    echo '<div>Description: ' . htmlspecialchars($task['description']) . '</div>';
                    echo '<div>Priority: ' . htmlspecialchars($task['priority']) . '</div>';
                    echo '<div>Status:' . htmlspecialchars($task['status']) . '</div>';
                    echo '<div>Due Date: ' . htmlspecialchars($task['dueDate']) . '</div>';
                    echo '<div class="task-buttons">';
                    echo '<button class="edit" data-task-id="' . $task['taskId'] . '"><a href="editTask.php?taskId=' . $task['taskId'] . '">Edit</a></button>';
                    echo '<button class="delete" data-task-id="' . $task['taskId'] . '">Delete</button>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                header("Location: logIn.php");
                exit;
            }
            ?>
        </div>
        <button type="submit" id="add-btn">+ Add Task</button>
    </div>


</body>
<script src="../scripts/editDelTask.js"></script>
<script src="../scripts/addTask.js"></script>
<script src="../scripts/search.js"></script>
<script src="../scripts/filterTask.js"></script>

</html>