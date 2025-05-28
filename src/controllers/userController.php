<?php 
require_once __DIR__ . '/../models/user.php';
require_once __DIR__ . '/../config/config.php';

class UserController{
    protected $userModel;
    function __construct(){
        $this->userModel = new UserModel(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME,DB_PORT);
    }
    public function create($name,$password,$email){
        $this->validateCredentials($name,$email,$password);
        $hash_password = password_hash($password,PASSWORD_DEFAULT);
        $this->userModel->createUser($name,$hash_password,$email);
    }
    private function validateCredentials($name,$email,$password){
        $this->validateName($name);
        $this->validateEmail($email);
        $this->validatePassword($password);
        if ($this->emailExists($email)){
            throw new Exception("Такая почта уже зарегестрирована");
        }
    }
    private function validateName($name){
        if(!isset($name) or strlen($name)<4){
            throw new InvalidArgumentException("Имя пользователя должно быть не менее 4 символов");
        }
        return true;
    }
    private function validateEmail($email){
        if (!isset($email) or !filter_var($email,FILTER_VALIDATE_EMAIL)){
            throw new InvalidArgumentException("Некорректный email");
        }
        return true;
    }
    private function validatePassword($password){
        if (!isset($password) or strlen($password)<8){
            throw new InvalidArgumentException("Пароль должен быть не менее 8 символов");
        }
        return true;
    }
    private function emailExists(string $email){
        return $this->userModel->checkEmail($email);
    }
}