<?php
session_start();
require_once 'db.php';
require_once 'function.php';

// Подключаемся к БД
$db = mysqli_connect($host, $user, $password, $database);
$sql = "SELECT * FROM SPR_BANK";
$result = mysqli_query($db,$sql);

//Выводим шапку таблицы
?>
<h1>Настройка путей обмена</h1>
