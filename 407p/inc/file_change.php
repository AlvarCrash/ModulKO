<?PHP
session_start();
require_once 'db.php';
require_once 'function.php';

// Подключаемся к БД
$db = mysqli_connect($host, $user, $password, $database);

//Проверка на ошибку соединения с базой
if (!$db) {
        printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error());
        exit;
    }
?>

<h1>Файловый обмен</h1>
<div id="tabs">
  <ul>
    <li><a href="#tabs-1">Архивные файлы ЭС РФМ</a></li>
    <li><a href="#tabs-2">Зашифрованные Файлы ЭС РФМ</a></li>
    <li><a href="#tabs-3">Расшифрованные Файлы ЭС РФМ</a></li>
  </ul>
  <div id="tabs-1">
    <!-- Управление -->
    <button class="ui-button ui-widget ui-corner-all" id="loadbutton"><span class="ui-icon ui-icon-folder-open"></span>Загрузить файлы</button>
    <button class="ui-button ui-widget ui-corner-all" id="checkbuttona"><span class="ui-icon ui-icon-gear"></span>Обработать файлы</button>
    <button class="ui-button ui-widget ui-corner-all" id="deletebuttona"><span class="ui-icon ui-icon-trash"></span>Удалить файлы</button>
    <button class="ui-button ui-widget ui-corner-all ui-button-icon-only" id="renewbuttona"><span class="ui-icon ui-icon-arrowrefresh-1-e"></span>Обновить</button>
    <!-- Основной блок -->
    <br><br>
    <?PHP
    //Выбираем архивные файлы ЭС РФМ
    $sql = "SELECT * FROM FILES_IN_ARH ORDER BY DATE DESC";
    $result = mysqli_query($db,$sql);
    //mysqli_close($db);
    //Открываем таблицу
    ?>
    <table class="table" id="arhfiles">
        <tr>
            <td></td>
            <td>ID</td>
            <td>Файл</td>
            <td>Статус</td>
            <td>Дата принятия</td>
        </tr>
    <?PHP
    while ($row = mysqli_fetch_assoc($result)){
        switch ($row['STATUS']){
            case 'Новый':
                $color = 'blue';
                break;
            case 'Обработан':
                $color = 'green';
                break;
            case 'Ошибка':
                $color = 'red';
                break;
        }
        echo '<tr>'
            .   '<td><input type="checkbox" name="checkboxa" id="'.$row['ID'].'"></td>'
            .   '<td>'.$row['ID'].'</td>'
            .   '<td style = "color: '.$color.'">'.$row['NAME'].'</td>'
            .   '<td>'.$row['STATUS'].'</td>'
            .   '<td>'.$row['DATE'].'</td>'    
            .   '</tr>';    
    }
    
    //Закрываем таблицу
    ?>
    </table>
       
  </div>
  <div id="tabs-2">
    <button class="ui-button ui-widget ui-corner-all" id="checkbuttonz"><span class="ui-icon ui-icon-gear"></span>Расшифровать файлы</button>
    <button class="ui-button ui-widget ui-corner-all ui-button-icon-only" id="renewbuttonz"><span class="ui-icon ui-icon-arrowrefresh-1-e"></span>Обновить</button>
    <br><br>
    <?PHP
    //Выбираем архивные файлы ЭС РФМ
    $sql = "SELECT * FROM FILES_IN_Z ORDER BY DATE DESC";
    $result = mysqli_query($db,$sql);
    //mysqli_close($db);
    //Открываем таблицу
    ?>  
    <table class="table" id="zfiles">
        <tr>
            <td></td>
            <td>ID</td>
            <td>ID Архивного файла</td>
            <td>Файл</td>
            <td>Статус</td>
            <td>Дата принятия</td>
        </tr>
    <?PHP
    while ($row = mysqli_fetch_assoc($result)){
        switch ($row['STATUS']){
            case 'Новый':
                $color = 'blue';
                break;
            case 'Расшифрован':
                $color = 'green';
                break;
            case 'Ошибка':
                $color = 'red';
                break;
        }
        echo '<tr>'
            .   '<td><input type="checkbox" name="checkboxz" id="'.$row['ID'].'"></td>'
            .   '<td>'.$row['ID'].'</td>'
            .   '<td align = center>'.$row['ID_A'].'</td>'    
            .   '<td style = "color: '.$color.'">'.$row['NAME'].'</td>'
            .   '<td>'.$row['STATUS'].'</td>'
            .   '<td>'.$row['DATE'].'</td>'    
            .   '</tr>';    
    }
    
    //Закрываем таблицу
    ?>
    </table>  
  </div>
  <div id="tabs-3">
    <button class="ui-button ui-widget ui-corner-all" id="checkbuttonr"><span class="ui-icon ui-icon-gear"></span>Обработать файлы</button>
    <button class="ui-button ui-widget ui-corner-all ui-button-icon-only" id="renewbuttonr"><span class="ui-icon ui-icon-arrowrefresh-1-e"></span>Обновить</button>
    <br><br>
    <?PHP
    //Выбираем архивные файлы ЭС РФМ
    $sql = "SELECT * FROM FILES_IN_R ORDER BY DATE DESC";
    $result = mysqli_query($db,$sql);
    //mysqli_close($db);
    //Открываем таблицу
    ?>  
    <table class="table" id="rfiles">
        <tr>
            <td></td>
            <td>ID</td>
            <td>ID Зашифрованного файла</td>
            <td>Файл</td>
            <td>Статус</td>
            <td>Дата принятия</td>
        </tr>
    <?PHP
    while ($row = mysqli_fetch_assoc($result)){
        switch ($row['STATUS']){
            case 'Новый':
                $color = 'blue';
                break;
            case 'Обработан':
                $color = 'green';
                break;
            case 'Ошибка':
                $color = 'red';
                break;
        }
        echo '<tr>'
            .   '<td><input type="checkbox" name="checkboxr" id="'.$row['ID'].'"></td>'
            .   '<td>'.$row['ID'].'</td>'
            .   '<td align = center>'.$row['ID_Z'].'</td>'    
            .   '<td style = "color: '.$color.'">'.$row['NAME'].'</td>'
            .   '<td>'.$row['STATUS'].'</td>'
            .   '<td>'.$row['DATE'].'</td>'    
            .   '</tr>';    
    }
    mysqli_close($db);
    //Закрываем таблицу
    ?>
    </table>
  </div>
</div>
<div id="dialog-files-message-info" title="Сообщение">
  <p id="info">
    <span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>
  </p>
</div>

