<?php
require_once 'functions.php';

$fileList = glob('uploads/*.json');
$test = [];

foreach ($fileList as $key => $file) {
    if ($key == $_GET['test']) {
        $fileTest = file_get_contents($fileList[$key]);
        $decodeFile = json_decode($fileTest, true);
        $test = $decodeFile;
    }
}

if (empty($test)) {
    header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
    exit;
}

$question = $test[0]['question'];
$answers[] = $test[0]['answers'];

$resultTrue = 0;
foreach ($answers[0] as $item) {
    if ($item['result'] === true) {
        $resultTrue++;
    }
}

$postTrue = 0;
$postFalse = 0;
$testSuccess = 0;
if (!empty($_POST['formAnswer'])) {
    foreach ($_POST['formAnswer'] as $item) {
        if ($answers[0][$item]['result'] === true) {
            $postTrue++;
        }
        else {
            $postFalse++;
        }
    }

    if ($postTrue === $resultTrue && $postFalse === 0) {
        $testSuccess++;
    }
    else {
        echo 'Вы ошиблись';
    }
}

if (!empty($testSuccess)) {
    $name = userName();
    $img = imagecreatetruecolor(800, 565);
    $backColor = imagecolorallocate($img, 255, 224, 221);
    $textColor = imagecolorallocate($img, 0, 0, 0);
    $imgBox = imagecreatefromjpeg('img.jpg');
    imagefill($img, 0, 0, $backColor);
    imagecopy($img, $imgBox, 0, 0, 0, 0, 800, 565);
    imagettftext($img, 30, 0, 200, 285, $textColor, './font.ttf', $name);
    imagettftext($img, 30, 0, 200, 328, $textColor, './font.ttf', 'Зачёт');
    imagettftext($img, 20, 0, 150, 480, $textColor, './font.ttf', date("d.m.y"));
    header('Content-Type: image/jpg');
    imagejpeg($img);
    imagedestroy($img);
}

?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Тест: <?=$question?></title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="alert alert-success" role="alert">
        
        <form method="post">
            <fieldset>
                <legend><?=$question?></legend>
                <?php foreach ($answers[0] as $key => $item) : ?>
                <label>
                    <input type="radio" name="formAnswer[]" value="<?=$key;?>"> <?=$item['answer'];?>
                    </label>
                <?php endforeach; ?>
            </fieldset>
            <input type="submit" value="Отправить">
        </form>
        
        <?php if (!empty($testSuccess)): ?>
            <img src="diploma.jpg" alt="Ваш сертификат">
        <?php endif;?>
        
        <ul class="nav">
             <li class="nav-item">
                <a class="nav-link" href="index.php">Главная</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="list.php">Список тестов</a>
            </li>
            <?php if (isAuth()) : ?>
            <li class="nav-item">
                <a class="nav-link" href="admin.php">Загрузить тест</a>
            </li>
            <?php endif; ?>
        </ul>
    </div>
</body>
</html>
