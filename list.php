<?php
require_once 'functions.php';
$fileList = glob('uploads/*.json');
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Список тестов</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="alert alert-success" role="alert">
    <?php
        foreach ($fileList as $key => $file) 
        {
            $fileTest = file_get_contents($file);
            $decodeFile = json_decode($fileTest, true);
            foreach ($decodeFile as $test) 
            {
                $question = $test['question'];
                echo "<ul class=\"nav\">";
                echo "<li class=\"nav-item\">";
                echo "<a class=\"nav-link\" href=\"test.php?test=$key\">$question</a>";
                echo "</li>";
                echo "</ul>";
                 if (isAuth()) {
                     echo "<ul class=\"nav\">";
                     echo "<li class=\"nav-item\">";
                     echo "<a class=\"nav-link\" href=\"del.php?test=$key\">удалить</a>";
                     echo "</li>";
                     echo "</ul>";
                }
                echo '<br>';
            }
        }
    ?>

    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="admin.php">Загрузить тест</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="list.php">Список тестов</a>
        </li>
    </ul>
</div>
</body>
</html>