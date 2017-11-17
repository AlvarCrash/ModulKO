  
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
echo '<table class="table" id="users">'
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
.   'Удаление пользователя'
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
    .               '<td>'
    .               '</td>'
    .               '</tr>';
    }
    else {
       echo        '<tr align="center" id="tr'.$row['ID'].'">'
    .               '<td>'.$row['ID']
    .               '</td>'
    .               '<td><a href="#"class="user-editable" data-name="EMAIL" data-type="text" data-title="E-Mail" data-pk="' . $row['ID'] . '" data-url="inc/ajax.php" >' . $row['EMAIL'] . '</a>'
    .               '</td>'
    .               '<td><a href="#" class="user-editable" data-name="NAME" data-type="text" data-title="Имя" data-pk="' . $row['ID'] . '" data-url="inc/ajax.php" >' . $row['NAME'] . '</a>'
    .               '</td>'
    .               '<td><a href="#" class="user-editable" data-name="SECOND_NAME" data-type="text" data-title="Отчество" data-pk="' . $row['ID'] . '" data-url="inc/ajax.php" >' . $row['SECOND_NAME'] . '</a>'
    .               '</td>'
    .               '<td><a href="#" class="user-editable" data-name="LAST_NAME" data-type="text" data-title="Фамилия" data-pk="' . $row['ID'] . '" data-url="inc/ajax.php" >' . $row['LAST_NAME'] . '</a>'
    .               '</td>'
    .               '<td><a href="#" class="user-editable" data-name="JOB" data-type="text" data-title="Должность" data-pk="' . $row['ID'] . '" data-url="inc/ajax.php" >' . $row['JOB'] . '</a>'
    .               '</td>'
    .               '<td><a href="#" class="user-editable" data-name="TYPE" data-type="text" data-title="Тип" data-pk="' . $row['ID'] . '" data-url="inc/ajax.php" >' . $row['TYPE'] . '</a>'
    .               '</td>'
    .               '<td><button class="ui-button ui-widget ui-corner-all ui-button-icon-only deleteuser" id="'.$row['ID'].'"><span class="ui-icon ui-icon-trash"></span></button>'           
    .               '</td>'
    .           '</tr>'; 
    }
}

//Закрываем таблицу    
echo '</table>';

?>
<button class="ui-button ui-widget ui-corner-all" id="newuserbutton"><span class="ui-icon ui-icon-gear"></span>Новый пользователь</button>
<div id="dialog-message-new" title="Пользователь добавлен">
  <p>
    <span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>
    Пользователь успешно добавлен!
  </p>
</div>
<div id="dialog-message-delete" title="Пользователь удален">
  <p>
    <span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>
    Пользователь успешно удален!
  </p>
</div>
<br><br>
<script>
    
</script>
<div id="newuser">
    <form>
    <table  class="table">
    <tr align=left>
       <td>
       Логин
       </td>
       <td><input type="email" class="form-control" id="inputemail" placeholder="Введите email"></td>
    </tr>
    <tr align=left>   
       <td>
       Пароль
       </td>
       <td><input type="email" class="form-control" id="inputpass1" placeholder="Введите пароль"></td>
    </tr>
    <tr align=left>
       <td>
       Подтверждение пароля
       </td>
       <td><input type="email" class="form-control" id="inputpass2" placeholder="Введите подтвердите пароль"></td>
    </tr>
    <tr align=left>   
       <td>
       Имя
       </td>
       <td><input type="email" class="form-control" id="inputname" placeholder="Введите имя"></td>
    </tr>
    <tr align=left>
       <td>
       Отчество
       </td>
       <td><input type="email" class="form-control" id="inputsecondname" placeholder="Введите отчество"></td>
    </tr>
    <tr align=left>
       <td>
       Фамилия
       </td>
       <td><input type="email" class="form-control" id="inputlastname" placeholder="Введите фамилию"></td>
    </tr>
    <tr align=left>
       <td>
       Должность
       </td>
       <td><input type="email" class="form-control" id="inputjob" placeholder="Введите должность"></td>
    </tr>
    <tr align=left>
       <td>
       Тип пользователя
       </td>
       <td><input type="email" class="form-control" id="inputtype" placeholder="Введите тип пользователя"></td>
    </tr>
    
   </table>
    </form>
   <button class="ui-button ui-widget ui-corner-all" id="savebutton"><span class="ui-icon ui-icon-disk"></span>Сохранить</button>
   <button class="ui-button ui-widget ui-corner-all" id="resetbutton"><span class="ui-icon ui-icon-trash"></span>Сброс</button> 
</div>
