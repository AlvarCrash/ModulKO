<?php
require_once 'db.php';
//require_once 'inc/function.php';

// Подключаемся к БД
$db = mysqli_connect($host, $user, $password, $database);

if (!$db) {
        printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error());
        exit;
    }


//Проверка запроса на изменение записи
if (isset($_POST['name'])) {
    $column = $_POST['name'];
    $newValue = $_POST['value'];    
    $id = $_POST['pk'];
    $sql = "UPDATE SPR_USERS SET $column = '$newValue' where ID = '$id'";
    mysqli_query($db, $sql);
}

//Закрываем соединение с БД
mysqli_close($db);


