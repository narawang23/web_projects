<?php
/**
 * The TasksDAO class extends abstractDAO to manage task-related operations 
 * in the database. It supports creating, retrieving, updating, deleting, 
 * searching, and filtering tasks, ensuring secure interactions through prepared statements.
 * @author YaNan Wang & Qinghua Tang
 */
require_once ('abstractDAO.php');
require_once ('../server/tasks.php');

class TasksDAO extends abstractDAO
{
    public function __construct()
    {
        parent::__construct();// call parent class construct
    }

    // Retrieves all tasks sorted by creation time, newest first
    public function getTasksSortedByCreation($userId)
    {
        $query = "SELECT * FROM tasks WHERE userId = ? ORDER BY createdDate DESC";
        $stmt = $this->mysqli->prepare($query);
        if (!$stmt) {
            return false;
        }
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        if (!$result) {
            return false;
        }

        $tasks = [];
        while ($row = $result->fetch_assoc()) {
            $tasks[] = $row;
        }
        $stmt->close();
        return $tasks;
    }

    public function addTask($userId, $taskName, $description, $priority, $dueDate, $status)
    {
        $query = "INSERT INTO tasks (userId, taskName, description, priority, dueDate, status) VALUES (?, ?, ?, ?, ?,?)";
        $stmt = $this->mysqli->prepare($query);
        if (!$stmt) {
            return false;
        }
        $stmt->bind_param('isssss', $userId, $taskName, $description, $priority, $dueDate, $status);
        $success = $stmt->execute();
        //echo $success;
        $stmt->close();
        return $success;
    }

    public function getTaskById($taskId)
    {
        // Prepare the SQL query to fetch the task by its ID
        $query = "SELECT * FROM tasks WHERE taskId = ?";
        $stmt = $this->mysqli->prepare($query);

        if (!$stmt) {
            return false; // Indicate failure
        }
        // Bind the taskId parameter and execute the query
        $stmt->bind_param('i', $taskId);
        $stmt->execute();

        // Retrieve the query results
        $result = $stmt->get_result();
        if ($result) {
            $task = $result->fetch_assoc();
            $stmt->close();

            if ($task) {
                return $task;
            }
        }

        $stmt->close();
        return null; // Task not found or query failed
    }

    // Updates an existing task in the database
    public function editTask($taskName, $description, $priority, $dueDate, $status, $taskId)
    {
        // Prepare the query
        $query = "UPDATE tasks SET taskName=?, description=?, priority=?, dueDate=?, status=? WHERE taskId=?";
        $stmt = $this->mysqli->prepare($query);
        if (!$stmt) {
            // Handle statement preparation error
            return false;
        }
        // Bind parameters and execute the query
        $stmt->bind_param('sssssi', $taskName, $description, $priority, $dueDate, $status, $taskId);
        $success = $stmt->execute();

        $stmt->close();
        return $success;
    }

    // Deletes an existing task from the database
    public function deleteTask($taskId)
    {
        // Prepare the query
        $query = "DELETE FROM tasks WHERE taskId=?";
        $stmt = $this->mysqli->prepare($query);

        if (!$stmt) {
            // Handle statement preparation error
            return false;
        }

        // Bind parameters and execute the query
        $stmt->bind_param('i', $taskId);
        $success = $stmt->execute();

        $stmt->close();
        return $success;
    }

    public function searchTasks($searchTerm)
    {
        // Prepare the SQL query to search for tasks
        // Use placeholders (?) for variables to safely include user input in the SQL query
        $query = "SELECT * FROM tasks WHERE taskName LIKE CONCAT('%', ?, '%') OR description LIKE CONCAT('%', ?, '%')";

        // Prepare the statement
        $stmt = $this->mysqli->prepare($query);

        // Check if the statement was prepared successfully
        if (!$stmt) {
            // Handle error - perhaps log this error and then return
            error_log('Prepare failed: ' . $this->mysqli->error);
            return false;
        }

        // Bind the input parameters to the prepared statement
        $stmt->bind_param('ss', $searchTerm, $searchTerm);

        // Execute the prepared statement
        $stmt->execute();

        // Fetch the results
        $result = $stmt->get_result();
        $tasks = [];
        while ($row = $result->fetch_assoc()) {
            $tasks[] = $row;
        }

        // Close the statement
        $stmt->close();
        return $tasks;
    }


    // Filter tasks based on priority, due date, and status
    public function filterTasks($priority, $dueDate, $status, $userId)
    {
        $query = "SELECT * FROM tasks WHERE userId = {$userId}";
        $conditions = [];
        if ($priority !== 'all') {
            $conditions[] = "priority = '{$priority}'";
        }

        if ($dueDate) {
            $conditions[] = "dueDate = '{$dueDate}'";
        }

        if ($status !== 'all') {
            $conditions[] = "status = '{$status}'";
        }

        if (!empty($conditions)) {
            $query .= " AND " . implode(" AND ", $conditions);
        }

        error_log("Executing SQL query: " . $query);
        $result = $this->mysqli->query($query);

        if (!$result) {
            return false;
        }

        $tasks = [];
        while ($row = $result->fetch_assoc()) {
            $tasks[] = $row;
        }
        return $tasks;
    }

}

?>