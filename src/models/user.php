<?php
class UserModel{
    private $conn;
    const TABLE = "users";
    public function __construct(string $host,string $user,string $password,string $database,int $port){
        $this->conn = new mysqli($host,$user,$password,$database,$port);
        if ($this->conn->connect_error){
            die("Ошибка подключения: ".$this->conn->connect_error);
        }
    }
    public function createUser(string $name,string $hash_password,string $email):int{
        $stmt = $this->conn->prepare("INSERT INTO ".self::TABLE." (name,hash_password,email) VALUES(?,?,?)");
        $stmt->bind_param("sss",$name,$hash_password,$email);
        $stmt->execute();
        $stmt->close();
        return $this->conn->insert_id;
    }
    public function getUser(int $id): array{
        $stmt = $this->conn->prepare("SELECT id,name,email FROM ".self::TABLE." WHERE id = ?;");
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    public function updateUser(int $id,string $name,string $email,string $password):void{
        $stmt = $this->conn->prepare("UPDATE  ".self::TABLE." SET name = ? , email = ?, hash_password = ? WHERE id = ?;");
        $hash_password = password_hash($password,PASSWORD_DEFAULT);
        $stmt->bind_param("sssi",$name,$email,$hash_password,$id);
        $stmt->execute();
        $stmt->close();
    }
    public function deleteUser(int $id):void{
        $stmt = $this->conn->prepare("DELETE FROM ".self::TABLE." WHERE id = ?;");
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $stmt->close();
    }
    public function getUserByName(string $name):array{
        $stmt = $this->conn->prepare("SELECT id,name,hash_password FROM ".self::TABLE." WHERE name = ?;");
        $stmt->bind_param("s",$name);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    } 
    public function checkEmail(string $email):bool{
        $stmt = $this->conn->prepare("SELECT id FROM ".self::TABLE." WHERE email = ?;");
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $result = $stmt->get_result();
        return (bool) $result->fetch_assoc();
    }
    function __destruct(){
        $this->conn->close();
    }
}