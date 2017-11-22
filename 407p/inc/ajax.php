<?php
require_once 'db.php';

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
    //изменение пользователей
    $sql = "UPDATE SPR_USERS SET $column = '$newValue' where ID = '$id'";
    mysqli_query($db, $sql);
    //Изменение настроек КО
    $sql = "UPDATE SPR_BANK SET $column = '$newValue' where ID = '$id'";
    mysqli_query($db, $sql);
}

//Проверка запроса на удаление пользователя
if (isset($_POST['id_delete'])) {
    $id = $_POST['id_delete'];
    $sql = "DELETE FROM SPR_USERS WHERE ID = '$id'";
    mysqli_query($db, $sql);
}

//Проверка запроса на добавление пользователя
if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $secondname = $_POST['secondname'];
    $lastname = $_POST['lastname'];
    $job = $_POST['job'];
    $type = $_POST['type'];
    
    $sql = "INSERT INTO SPR_USERS (EMAIL, PASSWORD, NAME, SECOND_NAME, LAST_NAME, JOB, TYPE) values('$email', '$password', '$name', '$secondname', '$lastname', '$job', '$type')";
    mysqli_query($db, $sql);
}

//Проверка запроса на смену пароля
if (isset($_POST['changepass'])) {
    $id = $_POST['id_change_pass'];
    $new_pass = $_POST['changepass'];
    $sql = "UPDATE SPR_USERS SET PASSWORD = '$new_pass' where ID = '$id'";
    mysqli_query($db, $sql);
}



//Закрываем соединение с БД
mysqli_close($db);


