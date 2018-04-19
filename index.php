<?php
require_once 'functions.php';
if (isAuth())
{
    location('admin');
}
if (!empty($_GET['user_name'])) {
    setcookie('user_name', $_GET['user_name']);
    location('list');
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Авторизация</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="alert alert-success" role="alert">
        <h4 class="alert-heading">Добро пожаловать в тесты</h4>
        <form method="get">
            <div class="form-group">
                <label>Введите ваше имя: </label>
                <input type="text" name="user_name">
                <input type="submit" value="Войти">
            </div>
        </form>
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="login.php">Вход для администратора</a>
            </li>
        </ul>
    </div>
</body>
</html>
