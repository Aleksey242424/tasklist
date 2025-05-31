<?php session_start();
if (!isset($_SESSION["userId"])){
    header("Location: views/auth.php");
    exit();
}?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Task List</title>
</head>
<body>
    <?php 
    require_once __DIR__."/../src/controllers/userController.php";
    require_once __DIR__."/../src/controllers/taskController.php";
    $userController = new UserController();
    $taskController = new TaskController();
    if ($_SERVER["REQUEST_METHOD"] === "POST"){
        if (isset($_POST["logout"])){
            $userController->logout();
        }else if(isset($_POST["add-task"])){
            $taskController->create($_SESSION["userId"],$_POST["task"]);
            header("Location: /");
        }else if(isset($_POST["complete"]) or isset($_POST["delete"])){
            $taskController->delete($_POST["task_id"]);
            header("Location: /");
        }
    }
    ?>
    <div class="container">
        <div class="task-list">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                <button class="logout-btn" type="submit" name="logout">Выйти</button>
            </form>
            
            <h2>Мои задачи</h2>
            
            <form class="add-task-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                <div class="form-group">
                    <input type="text" name="task" placeholder="Новая задача" required>
                </div>
                <button type="submit" name="add-task">Добавить задачу</button>
            </form>

            <div class="tasks">
                <?php
                $allTasks = $taskController->getTasks($_SESSION["userId"]);
                foreach($allTasks as $task){
                    echo"
                        <div class=\"task-item\">
                            <div class=\"task-content\">
                            $task[2]
                            </div>
                            <div class=\"task-actions\">
                                <form action=\"".htmlspecialchars($_SERVER['PHP_SELF'])."\" method=\"POST\">
                                    <input type=\"hidden\" name=\"task_id\" value=\"$task[0]\">
                                    <button type=\"submit\" name=\"complete\">✓</button>
                                </form>
                                <form action=\"".htmlspecialchars($_SERVER['PHP_SELF'])."\" method=\"POST\">
                                    <input type=\"hidden\" name=\"task_id\" value=\"$task[0]\">
                                    <button type=\"submit\" name=\"delete\">×</button>
                                </form>
                            </div>
                        </div>
                    ";
                }?>
                
            </div>
        </div>
    </div>
</body>
</html>