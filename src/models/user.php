<?php
class UserController{
    private $conn;
    const TABLE = "users";
    public function __construct(string $host,string $user,string $password,string $database,int $port){
        $this->conn = new mysqli($host,$user,$password,$database,$port);
        if ($this->conn->connect_error){
            die("Ошибка подключения: ".$this->conn->connect_error);
        }
    }
    public function createUser(string $name,string $password,string $email){
        $stmt = $this->conn->prepare("INSERT INTO ".self::TABLE." (name,hash_password,email) VALUES(?,?,?)");
        $hash_password = password_hash($password,PASSWORD_DEFAULT);
        $stmt->bind_param("sss",$name,$hash_password,$email);
        $stmt->execute();
        $stmt->close();
    }
    public function getUser(int $id): array{
        $stmt = $this->conn->prepare("SELECT id,name,email FROM ".self::TABLE." WHERE id = ?;");
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    public function updateUser(int $id,string $name,string $email,string $password){
        $stmt = $this->conn->prepare("UPDATE  ".self::TABLE." SET name = ? , email = ?, hash_password = ? WHERE id = ?;");
        $hash_password = password_hash($password,PASSWORD_DEFAULT);
        $stmt->bind_param("sssi",$name,$email,$hash_password,$id);
        $stmt->execute();
        $stmt->close();
    }
    public function deleteUser(int $id){
        $stmt = $this->conn->prepare("DELETE FROM ".self::TABLE." WHERE id = ?;");
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $stmt->close();
    }
    function __destruct(){
        $this->conn->close();
    }
}