<!-- 
Handles the display and processing of the task edit form, 
ensuring only logged-in users can edit tasks.-->
<?php
session_start();
require_once ('../database/taskService.php');
require_once ('../server/tasks.php');

// Redirect if not logged in or if taskId is not present
if (!isset($_SESSION['user_id']) || !isset($_GET['taskId'])) {
    header("Location: logIn.html");
    exit();
}

$taskService = new TaskService();
//$taskId = $_GET['taskId'];
$taskId = $_GET['taskId'];
$task = $taskService->getTaskById($taskId);
$_SESSION['taskId'] = $taskId;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $taskId = $_SESSION['taskId'];
    $taskName = $_POST['taskName'];
    $description = $_POST['description'];
    $priority = $_POST['priority'];
    $dueDate = $_POST['dueDate'];
    $status = $_POST['status'];


    $updateSuccess = $taskService->editTask($taskName, $description, $priority, $dueDate, $status, $taskId);

    if ($updateSuccess) {
        $_SESSION['flash_message'] = 'Task updated successfully!';
        header('Location: taskManagement.php');
        exit();
    } else {
        $_SESSION['error_message'] = 'Failed to update the task.';
        header('Location: taskManagement.php');
        exit();

    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit task</title>
    <link rel="stylesheet" href="../styles/style.css" type="text/css">
</head>

<body>
    <form action="editTask.php?taskId=<?php echo $taskId; ?>" method="post">

        <label for="taskName">Task Name:</label><br>
        <input type="text" id="taskName" name="taskName" value="<?php echo htmlspecialchars($task['taskName']); ?>"
            required><br>

        <label for="description">Description:</label><br>
        <textarea id="description"
            name="description"><?php echo htmlspecialchars($task['description']); ?></textarea><br>

        <label for="priority">Priority:</label>
        <select id="priority" name="priority" required>
            <option value="High" <?php echo $task['priority'] == 'High' ? 'selected' : ''; ?>>High</option>
            <option value="Medium" <?php echo $task['priority'] == 'Medium' ? 'selected' : ''; ?>>Medium</option>
            <option value="Low" <?php echo $task['priority'] == 'Low' ? 'selected' : ''; ?>>Low</option>
        </select><br>

        <label for="status">Status:</label>
        <select id="status" name="status" required>
            <option value="In Progress">
                <?php echo $task['status'] == 'In Progress' ? 'selected' : ''; ?>In Progress
            </option>
            <option value="Completed">
                <?php echo $task['status'] == 'Completed' ? 'selected' : ''; ?>Completed
            </option>
            <option value="Over Due" <?php echo $task['status'] == 'Over Due' ? 'selected' : ''; ?>>Over Due</option>
        </select><br>

        <label for="dueDate">Due Date:</label>
        <input type="date" id="dueDate" name="dueDate" value="<?php echo htmlspecialchars($task['dueDate']); ?>"
            required><br>

        <input id="eidt-sub" type="submit" value="Save Changes">
    </form>

</body>

</html>