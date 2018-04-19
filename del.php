<?php
require_once 'functions.php';
if (!isAuth())
{
    location('index');
}
$fileList = glob('uploads/*.json');
foreach ($fileList as $key => $file) {
    if ($key == $_GET['test']) {
        unlink($file);
        location('list');
    }
}