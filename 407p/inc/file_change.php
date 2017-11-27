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
    <button class="ui-button ui-widget ui-corner-all" id="checkbutton"><span class="ui-icon ui-icon-gear"></span>Обработать файлы</button>
    <button class="ui-button ui-widget ui-corner-all ui-button-icon-only" id="renewbutton"><span class="ui-icon ui-icon-arrowrefresh-1-e"></span>Обновить</button>
    <!-- Основной блок -->
    <br><br>
    <?PHP
    //Выбираем архивные файлы ЭС РФМ
    $sql = "SELECT * FROM FILES_IN_ARH ORDER BY DATE DESC";
    $result = mysqli_query($db,$sql);
    mysqli_close($db);
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
            .   '<td><input type="checkbox" name="checkbox" id="checkbox'.$row['ID'].'"></td>'
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
    <p>2</p>
  </div>
  <div id="tabs-3">
    <p>3</p>
    
  </div>
</div>
<div id="dialog-files-message-info" title="Сообщение">
  <p id="info">
    <span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>
  </p>
</div>

