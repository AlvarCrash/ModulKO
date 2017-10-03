<?php
session_start();

require_once 'db.php'; // Настройки подключения к БД
require_once 'functions.php'; // Подключение модуля функций

//Подключаемся к Базе данных
$connect = mysqli_connect($host, $user, $password, $database);

//формируем таблицу
echo "<table border='1' align='center'><tr align='center'><td>Номер</td><td>Логин</td><td>Фамилия</td><td>Имя</td><td>Отчество</td><td>Должность</td><td>Тип</td><td>Действия</td></tr>";

//Вытаскиваем список всех пользователей
if ($result = mysqli_query($connect, "SELECT * FROM SPR_USERS")) {
    while ($row = mysqli_fetch_assoc($result)){
        $id = $row['ID'];
        $email = $row['EMAIL'];
        $name = $row['NAME'];
        $second_name = $row['SECOND_NAME'];
        $last_name = $row['LAST_NAME'];
        $job = $row['JOB'];
        $type = $row['TYPE'];
        //Вывод результатов
        echo "<tr align='center'><td>".$id."</td><td>".$email."</td><td>".$last_name."</td><td>".$name."</td><td>".$second_name."</td><td>".$job."</td><td>".$type."</td><td><a><img src='img/edit.png' width='20' height='20'></a> <a><img src='img/delete.png' width='20' height='20'></a></td></tr>";
    }
    mysqli_free_result($result);
}
mysqli_close($connect);

//Закрываем таблицу
echo "</table>";
//Вывод результатов 
?>



