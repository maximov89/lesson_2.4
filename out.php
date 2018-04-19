<?php
require_once 'functions.php';
if (!isAuth())
{
    location('index');
}
logout();