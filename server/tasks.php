<!-- Defines the Tasks class with properties and methods for task management

<?php
class Tasks
{
    private $taskId;
    private $userId;
    private $taskName;
    private $description;
    private $priority;
    private $dueDate;
    private $createdDate;
    private $status;

    public function __construct($taskId, $userId, $taskName, $description, $priority, $dueDate, $createdDate, $status)
    {
        $this->taskId = $taskId;
        $this->userId = $userId;
        $this->taskName = $taskName;
        $this->description = $description;
        $this->priority = $priority;
        $this->dueDate = $dueDate;
        $this->createdDate = $createdDate;
        $this->status = $status;
    }

    //  getters and setters
    public function getTaskId()
    {
        return $this->taskId;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getTaskName()
    {
        return $this->taskName;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getPriority()
    {
        return $this->priority;
    }

    public function getDueDate()
    {
        return $this->dueDate;
    }
    public function getCreatedDate()
    {
        return $this->createdDate;
    }
    public function getStatus()
    {
        return $this->status;
    }

}
?>