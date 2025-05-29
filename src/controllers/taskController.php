<?php

require_once __DIR__."/../models/task.php";
require_once __DIR__."/../config/config.php";

class TaskController{
    private $taskModel;
    function __construct()
    {
        $this->taskModel = new TaskModel(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME,DB_PORT);
    }
    public function create(int $userId,string $task):void{
        $this->taskModel->create($userId,$task);
    }
    public function getTasks(int $userId):array{
        return $this->taskModel->getTasks($userId);
    }
    public function delete(int $taskId):void{
        $this->taskModel->deleteTask($taskId);
    }
}