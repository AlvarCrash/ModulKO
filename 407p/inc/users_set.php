<?php
session_start();
require_once 'db.php';
require_once 'function.php';

// Подключаемся к БД
$db = mysqli_connect($host, $user, $password, $database);
$sql = "SELECT * FROM SPR_USERS";
$result = mysqli_query($db,$sql);
mysqli_close($db);

//Выводим шапку списка пользователей
echo '<table border=1 rules=all cellpadding=5 class=userlist>'
.'<tr align=center>'
.   '<td>'
.   'ID'
.   '</td>'        
.   '<td>'
.   'Логин'
.   '</td>'
.   '<td>'
.   'Имя'
.   '</td>'
.   '<td>'
.   'Отчество'
.   '</td>'
.   '<td>'
.   'Фамилия'
.   '</td>'
.   '<td>'
.   'Должность'
.   '</td>'
.   '<td>'
.   'Тип пользователя'
.   '</td>'
.   '<td>'
.   'Действия с аккаунтом'
.   '</td>'        
.'</tr>';

//Выводим список пользователей
while ($row = mysqli_fetch_assoc($result)){
    //while ($row["NAME"]){
        echo        '<tr align=center>'
    .               '<td>'.$row['ID']
    .               '</td>'
    .               '<td>'.$row['EMAIL']
    .               '</td>'
    .               '<td>'.$row['NAME']
    .               '</td>'
    .               '<td>'.$row['SECOND_NAME']
    .               '</td>'
    .               '<td>'.$row['LAST_NAME']
    .               '</td>'
    .               '<td>'.$row['JOB']
    .               '</td>'
    .               '<td>'.$row['TYPE']
    .               '</td>'
    .               '</td>'
    .               '<td>'
    .               '</td>'            
    .           '</tr>';
    //}
    }

//Закрываем таблицу    
echo '</table>';    
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

