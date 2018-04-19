<?php
require_once 'functions.php';
if (isAuth())
{
    location('admin');
}
$errors = [];
if (isPost())
{
    if (login($_POST['login'], $_POST['password']))
    {
        location('admin');
    }else{
        $errors[] = 'Неверный логин и пароль';
    }
}
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Вход</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="alert alert-success" role="alert">
        <form method="POST">
            <div class="form-group">
                <label for="login">Логин</label>
                <input name="login" id="login">
                <label for="password">Пароль</label>
                <input name="password" id="password">
                <input type="submit" value="Войти">
            </div>
        </form>
        <ul class="nav">
        <?php foreach ($errors as $error) : ?>
            <li class="nav-item"><?=$error;?></li>
        <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>