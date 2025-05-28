<?php
class UserController{
    private $conn;
    public function __construct($host,$user,$password,$database,$port){
        $this->conn = new mysqli($host,$user,$password,$database,$port);
        if ($this->conn->connect_error){
            die("Ошибка подключения: ".$this->conn->connect_error);
        }
    }
}