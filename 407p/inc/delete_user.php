<?php
require_once 'db.php';
//require_once 'inc/function.php';

// Подключаемся к БД
$db = mysqli_connect($host, $user, $password, $database);

if (!$db) {
        printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error());
        exit;
    }

//Проверка запроса на удаление
if (isset($_REQUEST['id_delete'])) {
    $id = $_REQUEST['id_delete'];
    $sql = "DELETE FROM SPR_USERS WHERE ID = '$id'";
    mysqli_query($db, $sql);
}

//Закрываем соединение с БД
mysqli_close($db);
//echo $id;