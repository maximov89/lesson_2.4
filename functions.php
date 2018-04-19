<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

function login($login, $password)
{
    $users = getUsers();
    foreach ($users as $user)
    {
        if ($user['login'] == $login && $user['password'] == $password)
        {
            unset($user['password']);
            $_SESSION['user'] = $user;
            return true;
        }
    }
    return false;
}
 
// Данные сессии

function getLoggedUserData()
{
    if (empty($_SESSION['user']))
    {
        return null;
    }
    return $_SESSION['user'];
}

// Проверяем авторизацию пользователя

function isAuth()
{
    return getLoggedUserData() !== null;
}

// Проверяем какое имя писать

function userName()
{
    if (isAuth())
    {
        return getLoggedUserData()['name'];
    }
    return $_COOKIE['user_name'];
}

// Получаем массив users.json

function getUsers()
{
    $path = 'users.json';
    $fileData = file_get_contents($path);
    $data = json_decode($fileData, true);
    if (!$data)
    {
        return [];
    }
    return $data;
}

// Проверяем метод

function isPost()
{
    return $_SERVER['REQUEST_METHOD'] == 'POST';
}
function gerParam($name)
{
    filter_input(INPUT_POST, $name);
}
function location($path)
{
    header("Location: $path.php");
    die;
}
function logout()
{
    session_destroy();
    location('index');
}