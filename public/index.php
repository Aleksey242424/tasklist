<?php session_start();
if (!isset($_SESSION["auth"])){
    header("Location: views/auth.php");
    exit();
}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main</title>
</head>
<body>
    
</body>
</html>