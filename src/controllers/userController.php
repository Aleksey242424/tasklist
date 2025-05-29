<?php 
require_once __DIR__ . '/../models/user.php';
require_once __DIR__ . '/../config/config.php';

class UserController{
    protected UserModel $userModel;
    function __construct(){
        $this->userModel = new UserModel(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME,DB_PORT);
    }
    public function create(string $name,string $password,string $email):void{
        $this->validateCredentials($name,$email,$password);
        $hash_password = password_hash($password,PASSWORD_DEFAULT);
        $userId = $this->userModel->createUser($name,$hash_password,$email);
        $this->setSession($userId);
    }
    public function aunthenticate(string $name,string $password){
        $userData = $this->userModel->getUserByName($name);
        if (!password_verify($password,$userData["hash_password"])){
            throw new Exception("Пароль неверен");
        }
        $this->setSession($userData["id"]);
    }
    public function logout(){
        session_unset();
        header("Location: views/auth.php");
    }
    private function validateCredentials(string $name,string $email,string $password):void{
        $this->validateName($name);
        $this->validateEmail($email);
        $this->validatePassword($password);
        if ($this->emailExists($email)){
            throw new Exception("Такая почта уже зарегестрирована");
        }
    }
    private function validateName(string $name):bool{
        if(!isset($name) or strlen($name)<4){
            throw new InvalidArgumentException("Имя пользователя должно быть не менее 4 символов");
        }
        return true;
    }
    private function validateEmail(string $email):bool{
        if (!isset($email) or !filter_var($email,FILTER_VALIDATE_EMAIL)){
            throw new InvalidArgumentException("Некорректный email");
        }
        return true;
    }
    private function validatePassword(string $password):bool{
        if (!isset($password) or strlen($password)<8){
            throw new InvalidArgumentException("Пароль должен быть не менее 8 символов");
        }
        return true;
    }
    private function emailExists(string $email):bool{
        return $this->userModel->checkEmail($email);
    }
    private function setSession($id){
        $_SESSION["userId"] = $id;
    }
}