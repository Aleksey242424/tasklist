<?php
session_start();
if (isset($_SESSION["auth"])){
    header("Location:http://localhost:7777/","true","301");
    exit();
}?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task List</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .auth-forms {
            display: flex;
            justify-content: space-around;
            margin: 50px 0;
        }

        .form-box {
            background: white;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 600px;
        }

        .form-box h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
            font-size:40px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        input[type="text"],
        input[type="password"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #5cb85c;
            border: none;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #4cae4c;
        }

        .task-list {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .task-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #eee;
        }

        .task-content {
            flex-grow: 1;
            margin: 0 15px;
        }

        .task-actions form {
            display: inline-block;
        }

        .add-task-form {
            margin-bottom: 20px;
        }

        .logout-btn {
            background: #d9534f;
            width: auto;
            padding: 8px 15px;
            float: right;
        }

        .logout-btn:hover {
            background: #c9302c;
        }

        @media (max-width: 600px) {
            .auth-forms {
                flex-direction: column;
                align-items: center;
            }
            
            .form-box {
                margin-bottom: 20px;
            }
        }
    </style>
</head>
<body>
    <!-- Форма регистрации -->
    <div class="container">
        <div class="auth-forms">
            <div class="form-box" id="registration">
                <h2>Регистрация</h2>
                <form action="register.php" method="POST">
                    <div class="form-group">
                        <input type="text" name="username" placeholder="Имя пользователя" required>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" placeholder="Пароль" required>
                    </div>
                    <button type="submit">Зарегистрироваться</button>
                </form>
                <p id="sign-in" style="cursor: pointer;">Войти</p>
            </div>
            <div class="form-box" id="login" style="display: none;">
                <h2>Вход</h2>
                <form action="login.php" method="POST">
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" placeholder="Пароль" required>
                    </div>
                    <button type="submit">Войти</button>
                </form>
                <p id="sign-up" style="cursor: pointer;">Зарегистрироваться</p>
            </div>
        </div>
    </div>
    <script>
        const loginForm = document.querySelector("#login");
        const registrationForm = document.querySelector("#registration");
        const loginButton = document.querySelector("#sign-in");
        const registrationButton = document.querySelector("#sign-up");
        loginButton.addEventListener('click',(e)=>{
            registrationForm.style.display = "none";
            loginForm.style.display = "block";
        });
        registrationButton.addEventListener('click',(e)=>{
            loginForm.style.display = "none";
            registrationForm.style.display = "block";
        });
    </script>
</body>
</html>