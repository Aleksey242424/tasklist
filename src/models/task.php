<?php 
class TaskModel{
    const TABLE = "tasks";
    public $conn;
    function __construct($host,$user,$password,$database,$port){
        $this->conn = new mysqli($host,$user,$password,$database,$port);
    }
    public function create($userId,$task){} 
}