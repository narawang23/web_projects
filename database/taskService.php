<?php

require_once ('../server/tasks.php');
require_once ('tasksDAO.php');
class TaskService
{
    private $tasksDAO;
    public function __construct()
    {
        $this->tasksDAO = new TasksDAO();
    }

    // Gets a specific users' list of all tasks sorted by creation time, newest first
    public function getTasksSortedByCreation($userId)
    {
        return $this->tasksDAO->getTasksSortedByCreation($userId);
    }

    // Adds a new task and return to the task list
    public function addTask($userId, $taskName, $description, $priority, $dueDate, $status)
    {
        // Call the addTask method of the tasksDAO and pass the individual parameters
        return $this->tasksDAO->addTask($userId, $taskName, $description, $priority, $dueDate, $status);
    }

    // Get a specific task info by taskId
    public function getTaskById($taskId)
    {
        return $this->tasksDAO->getTaskById($taskId);
    }

    // Edits an existing task
    public function editTask($taskName, $description, $priority, $dueDate, $status, $taskId)
    {
        return $this->tasksDAO->editTask($taskName, $description, $priority, $dueDate, $status, $taskId);
    }

    // Deletes an existing task
    public function deleteTask($taskId)
    {
        return $this->tasksDAO->deleteTask($taskId);
    }

    // Filters tasks based on priority, due date, and status
    public function filterTasks($priority, $dueDate, $status, $userId)
    {
        return $this->tasksDAO->filterTasks($priority, $dueDate, $status, $userId);
    }

    // Searches for tasks by a search term
    public function searchTasks($searchTerm)
    {
        return $this->tasksDAO->searchTasks($searchTerm);
    }

}