<?php
require_once 'inc/function.php';
require_once 'inc/db.php';

$db = mysqli_connect($host, $user, $password, $database);

//Проверка на ошибку соединения с базой
if (!$db) {
        printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error());
        exit;
    }
echo (loadFiles($db));   

mysqli_close($db);
?>



