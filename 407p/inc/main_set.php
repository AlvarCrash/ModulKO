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
<h1>Настройка основных параметров КО</h1>
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
    .               '<td>БИК</td>'
    .               '<td><a href="#"class="ko-editable" data-name="BIK" data-type="text" data-title="E-Mail" data-pk="' . $row['ID'] . '" data-url="inc/ajax.php" >'.$row['BIK'].'</a></td>'
    .               '</tr>'
    .          '<tr align=center>'
    .               '<td>Регистрационный номер</td>'
    .               '<td><a href="#"class="ko-editable" data-name="REG_NUMBER" data-type="text" data-title="E-Mail" data-pk="' . $row['ID'] . '" data-url="inc/ajax.php" >'.$row['REG_NUMBER'].'</a></td>'
    .               '</tr>'
    .          '<tr align=center>'
    .               '<td>Наименование</td>'
    .               '<td><a href="#"class="ko-editable" data-name="FULL_NAME" data-type="text" data-title="E-Mail" data-pk="' . $row['ID'] . '" data-url="inc/ajax.php" >'.$row['FULL_NAME'].'</a></td>'
    .               '</tr>'
    .          '<tr align=center>'
    .               '<td>Сокращенное наименование</td>'
    .               '<td><a href="#"class="ko-editable" data-name="NAME" data-type="text" data-title="E-Mail" data-pk="' . $row['ID'] . '" data-url="inc/ajax.php" >'.$row['NAME'].'</a></td>'
    .               '</tr>'
    .          '<tr align=center>'
    .               '<td>ИНН</td>'
    .               '<td><a href="#"class="ko-editable" data-name="INN" data-type="text" data-title="E-Mail" data-pk="' . $row['ID'] . '" data-url="inc/ajax.php" >'.$row['INN'].'</a></td>'
    .               '</tr>'
    .          '<tr align=center>'
    .               '<td>КПП</td>'
    .               '<td><a href="#"class="ko-editable" data-name="KPP" data-type="text" data-title="E-Mail" data-pk="' . $row['ID'] . '" data-url="inc/ajax.php" >'.$row['KPP'].'</a></td>'
    .               '</tr>'
    .          '<tr align=center>'
    .               '<td>ОКПО</td>'
    .               '<td><a href="#"class="ko-editable" data-name="OKPO" data-type="text" data-title="E-Mail" data-pk="' . $row['ID'] . '" data-url="inc/ajax.php" >'.$row['OKPO'].'</a></td>'
    .               '</tr>'
    .          '<tr align=center>'
    .               '<td>ОГРН</td>'
    .               '<td><a href="#"class="ko-editable" data-name="OGRN" data-type="text" data-title="E-Mail" data-pk="' . $row['ID'] . '" data-url="inc/ajax.php" >'.$row['OGRN'].'</a></td>'
    .               '</tr>'
    .          '<tr align=center>'
    .               '<td>Кор. Счет</td>'
    .               '<td><a href="#"class="ko-editable" data-name="KS" data-type="text" data-title="E-Mail" data-pk="' . $row['ID'] . '" data-url="inc/ajax.php" >'.$row['KS'].'</a></td>'
    .               '</tr>'
    .          '<tr align=center>'
    .               '<td>Адрес</td>'
    .               '<td><a href="#"class="ko-editable" data-name="ADDRESS" data-type="text" data-title="E-Mail" data-pk="' . $row['ID'] . '" data-url="inc/ajax.php" >'.$row['ADDRESS'].'</a></td>'
    .               '</tr>'
    .          '<tr align=center>'
    .               '<td>Телефон</td>'
    .               '<td><a href="#"class="ko-editable" data-name="PHONE" data-type="text" data-title="E-Mail" data-pk="' . $row['ID'] . '" data-url="inc/ajax.php" >'.$row['PHONE'].'</a></td>'
    .               '</tr>'
           ; 
}

//Закрываем соединение с БД
mysqli_close($db);
//Закрываем таблицу
?>
</table>
