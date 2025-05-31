<?php
session_start();
if (isset($_SESSION["userId"])){
    header("Location:http://localhost:7777/","true","301");
    exit();
}?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/auth.js" defer></script>
    <title>Task List</title>
</head>
<body>
    <?php
    require_once __DIR__ . "/../../src/controllers/userController.php";
    $userController = new UserController();
    if ($_SERVER["REQUEST_METHOD"] === "POST"){
        if (isset($_POST["registration"])){
            $userController->create($_POST["username"],$_POST["password"],$_POST["email"]);
        }else if(isset($_POST["login"])){
            $userController->aunthenticate($_POST["name"],$_POST["password"]);
        }
        header("Location: auth.php");
    }
    ?>
    <div class="container">
        <div class="auth-forms">
            <div class="form-box" id="registration">
                <h2>Регистрация</h2>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                    <div class="form-group">
                        <input type="text" name="username" placeholder="Имя пользователя" required>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" id="password" placeholder="Пароль" required>
                        <span id="error-message"></span>
                    </div>
                    <button type="submit" name="registration" disabled id="register-button">Зарегистрироваться</button>
                </form>
                <p id="sign-in" style="cursor: pointer;">Войти</p>
            </div>
            <div class="form-box" id="login" style="display: none;">
                <h2>Вход</h2>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                    <div class="form-group">
                        <input type="text" name="name" placeholder="Имя пользователя" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" placeholder="Пароль" required>
                    </div>
                    <button type="submit" name="login">Войти</button>
                </form>
                <p id="sign-up" style="cursor: pointer;">Зарегистрироваться</p>
            </div>
        </div>
    </div>
</body>
</html>