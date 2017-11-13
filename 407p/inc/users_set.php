  
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
echo '<table class=table>'
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
.'</tr>';

//Выводим список пользователей
while ($row = mysqli_fetch_assoc($result)){
    if ($row['ID'] == 1){
    
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
    .           '</tr>';
    }
    else {
       echo        '<tr align=center>'
    .               '<td>'.$row['ID']
    .               '</td>'
    .               '<td><a href="#"class="people-editable" data-name="EMAIL" data-type="text" data-title="E-Mail" data-pk="' . $row['ID'] . '" data-url="inc/ajax.php" >' . $row['EMAIL'] . '</a>'
    .               '</td>'
    .               '<td><a href="#" class="people-editable" data-name="NAME" data-type="text" data-title="Имя" data-pk="' . $row['ID'] . '" data-url="inc/ajax.php" >' . $row['NAME'] . '</a>'
    .               '</td>'
    .               '<td><a href="#" class="people-editable" data-name="SECOND_NAME" data-type="text" data-title="Отчество" data-pk="' . $row['ID'] . '" data-url="inc/ajax.php" >' . $row['SECOND_NAME'] . '</a>'
    .               '</td>'
    .               '<td><a href="#" class="people-editable" data-name="LAST_NAME" data-type="text" data-title="Фамилия" data-pk="' . $row['ID'] . '" data-url="inc/ajax.php" >' . $row['LAST_NAME'] . '</a>'
    .               '</td>'
    .               '<td><a href="#" class="people-editable" data-name="JOB" data-type="text" data-title="Должность" data-pk="' . $row['ID'] . '" data-url="inc/ajax.php" >' . $row['JOB'] . '</a>'
    .               '</td>'
    .               '<td><a href="#" class="people-editable" data-name="TYPE" data-type="text" data-title="Тип" data-pk="' . $row['ID'] . '" data-url="inc/ajax.php" >' . $row['TYPE'] . '</a>'
    .               '</td>'    
    .           '</tr>'; 
    }
}

//Закрываем таблицу    
echo '</table>';
echo $_POST['name'];
?>

