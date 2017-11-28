<?php
session_start();
require_once 'db.php';
require_once 'function.php';

// Подключаемся к БД
$db = mysqli_connect($host, $user, $password, $database);
$sql = "SELECT * FROM SPR_KEYS";
$result = mysqli_query($db,$sql);

//Выводим шапку таблицы
?>
<h1>Настройка криптографии</h1>
<table class="table">
    <tr align=center>
        <td>Поле</td>
        <td>Значение</td>
    </tr>
<?PHP
//Выводим список настроек
while ($row = mysqli_fetch_assoc($result)){
   echo        '<tr align=center>'
    .               '<td>ID</td>'
    .               '<td>'.$row['ID'].'</td>'
    .               '</tr>'
    .          '<tr align=center>'
    .               '<td>Директория для ключей ПОДПИСИ</td>'
    .               '<td><input class="form-control" type="text" value="'.$row['KEY_SIGN'].'" id="keysign"></input></td>'
    .               '</tr>'
    .          '<tr align=center>'
    .               '<td>Директория для ключей ШИФРОВАНИЯ</td>'
    .               '<td><input class="form-control" type="text" value="'.$row['KEY_CRYPT'].'" id="keycrypt"></input></td>'
    .               '</tr>'
    .          '<tr align=center>'
    .               '<td>Директория для ключей РАСШИФРОВАНИЯ И СНЯТИЯ ПОДПИСИ</td>'
    .               '<td><input class="form-control" type="text" value="'.$row['KEY_UNCRYPT'].'" id="keyuncrypt"></input></td>'
    .               '</tr>'
    .          '<tr align=center>'
    .               '<td>Директория для программы SCSIGNEX</td>'
    .               '<td><input class="form-control" type="text" value="'.$row['SCSIGN'].'" id="keyscsign"></input></td>'
    .               '</tr>'
    .          '<tr align=center>'
    .               '<td>Директория для BAT файлов</td>'
    .               '<td><input class="form-control" type="text" value="'.$row['BAT'].'" id="keybat"></input></td>'
    .               '</tr>'
    ; 
}

//Закрываем соединение с БД
mysqli_close($db);
//Закрываем таблицу
?>
</table>
<button class="ui-button ui-widget ui-corner-all" id="savecryptbutton"><span class="ui-icon ui-icon-disk"></span>Сохранить</button>
<div id="dialog-message-info" title="Сообщение">
  <p id="info">
    <span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>
  </p>
</div>