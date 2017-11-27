<?php
session_start();
require_once 'db.php';
require_once 'function.php';

// Подключаемся к БД
$db = mysqli_connect($host, $user, $password, $database);

if (!$db) {
        printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error());
        exit;
    }

$email = $_POST["email"];

$password = $_POST["password"];
              
$sql = "SELECT * FROM SPR_USERS WHERE EMAIL='$email'";
$result = mysqli_query($db,$sql);
mysqli_close($db);
while ($row = mysqli_fetch_assoc($result)){
    // Проверяем авторизацию
    if ($row["PASSWORD"] == $password){
        $id = $row["ID"];
        $type = $row["TYPE"];
        $name = $row["NAME"];
        $second_name = $row["SECOND_NAME"];
        $last_name = $row["LAST_NAME"];
        $_SESSION['id'] = $id;
        $_SESSION['type'] = $type;
        $_SESSION['name'] = $name;
        $_SESSION['second_name'] = $second_name;
        $_SESSION['last_name'] = $last_name;
        //echo 'OK';
        //header("location: ../index.php");
    }
    //else {
        //echo 'ERROR';
    //}
    //header("location: ../index.php");        

}





/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

