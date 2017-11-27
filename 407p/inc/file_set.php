<?php
session_start();
require_once 'db.php';
require_once 'function.php';

// Подключаемся к БД
$db = mysqli_connect($host, $user, $password, $database);
$sql = "SELECT * FROM SPR_FILES";
$result = mysqli_query($db,$sql);

//Выводим шапку таблицы
?>
<h1>Настройка путей обмена</h1>
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
    .               '<td>Директория для архивных файлов ЭС РФМ</td>'
    .               '<td><input class="form-control" type="text" value="'.$row['IN_AFRFM'].'" id="inafrfm"></input></td>'
    .               '</tr>'
    .          '<tr align=center>'
    .               '<td>Директория для зашифрованных файлов ЭС РФМ</td>'
    .               '<td><input class="form-control" type="text" value="'.$row['IN_ZFRFM'].'" id="inzfrfm"></input></td>'
    .               '</tr>'
    .          '<tr align=center>'
    .               '<td>Директория для расшифрованных файлов ЭС РФМ</td>'
    .               '<td><input class="form-control" type="text" value="'.$row['IN_RFRFM'].'" id="inrfrfm"></input></td>'
    .               '</tr>'       
    .          '<tr align=center>'
    .               '<td>Директория для исходящих файлов</td>'
    .               '<td><input class="form-control" type="text" value="'.$row['OUT_PATH'].'" id="outfiles"></input></td>'
    .               '</tr>'
    ; 
}

//Закрываем соединение с БД
mysqli_close($db);
//Закрываем таблицу
?>
</table>
<button class="ui-button ui-widget ui-corner-all" id="savepathbutton"><span class="ui-icon ui-icon-disk"></span>Сохранить</button>
<div id="dialog-message-info" title="Сообщение">
  <p id="info">
    <span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>
  </p>
</div>