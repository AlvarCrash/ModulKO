<?php
require_once 'db.php';

// Подключаемся к БД
$db = mysqli_connect($host, $user, $password, $database);

if (!$db) {
        printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error());
        exit;
    }
//Загрузка новых архивных файлов ЭМ РФМ      
if (isset($_POST['files_afrfm'])) {
    //Получаем директорию для архивных файлов ЭМ РФМ
    $i = 0;
    $sql = "SELECT * FROM SPR_FILES WHERE ID = '1'";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_assoc($result);
    $path_afrfm = $row['IN_AFRFM'];
    
    //Получаем список файлов в директории и убираем точки
    $files_afrfm = scandir($path_afrfm);
    unset($files_afrfm[0],$files_afrfm[1]);    
    
    //Если файл не внесен в БД, то добавляем его
    foreach ($files_afrfm as $filename){
        $sql = "SELECT * FROM FILES_IN_ARH WHERE NAME = '$filename'";
        $result = mysqli_query($db,$sql);
        if ($result->num_rows == 0) {
            $sql = "INSERT INTO FILES_IN_ARH (NAME, STATUS) values ('$filename', 'Новый')";
            mysqli_query($db, $sql);
            $i++;
            }
    }
    mysqli_close($db);
    echo $i;
}

//Разархивирование файлов
if (isset($_POST['files_zfrfm'])) {
    $i = 1;
    //Получаем директорию для архивных и зашифрованных файлов
    $sql = "SELECT * FROM SPR_FILES WHERE ID = '1'";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_assoc($result);
    $path_afrfm = $row['IN_AFRFM'];
    $path_zfrfm = $row['IN_ZFRFM'];
    
    //Формируем команду на разархивацию ARJ X -Y -g123: А:\ТХТ.ARJ C:\ТХТ
    $comarj = 'D:\PHP\407p\ARJ\ARJ.EXE X -Y '.$path_afrfm.'RRFM_044525298_20171124_001.ARJ '.$path_zfrfm;
    
    //разархивируем
    $resarh = system($comarj, $retval);
        
    mysqli_close($db);
    
    echo $i;
}
