<?php 
class TaskModel{
    const TABLE = "tasks";
    public $conn;
    function __construct($host,$user,$password,$database,$port){
        $this->conn = new mysqli($host,$user,$password,$database,$port);
        if ($this->conn->connect_error){
            die("Ошибка подключения ".$this->conn->connect_error);
        }
    }
    public function create(int $userId,string $task):int {
        $stmt = $this->conn->prepare("INSERT INTO ".self::TABLE." (user_id,task) VALUES(?,?);");
        $stmt->bind_param("is",$userId,$task);
        $stmt->execute();
        $stmt->close();
        return $this->conn->insert_id;
    } 
    public function getTasks(int $userId):array{
        $stmt = $this->conn->prepare("SELECT * FROM ".self::TABLE." WHERE user_id = ? ORDER BY id DESC;");
        $stmt->bind_param("i",$userId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all();
    }
    public function updateTask(int $taskId,string $task):void{
        $stmt = $this->conn->prepare("UPDATE ".self::TABLE." SET task = ? WHERE id = ?;");
        $stmt->bind_param("si",$task,$taskId);
        $stmt->execute();
        $stmt->close();
    }
    public function deleteTask(int $taskId):void{
        $stmt = $this->conn->prepare("DELETE FROM ".self::TABLE." WHERE id = ?;");
        $stmt->bind_param("i",$taskId);
        $stmt->execute();
        $stmt->close();
    }
    function __destruct()
    {
        $this->conn->close();
    }
}