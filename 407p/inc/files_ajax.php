<?php
require_once 'db.php';

// Подключаемся к БД
$db = mysqli_connect($host, $user, $password, $database);

if (!$db) {
        printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error());
        exit;
    }
//Загрузка новых архивных файлов ЭМ РФМ      
if (isset($_POST['files_lfrfm'])) {
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
if (isset($_POST['files_afrfm'])) {
    $i = 0;
    
    //Принимаем массив элементов
    $checkboxx = $_POST['checkbox'];
    $checkbox = explode(",", $checkboxx);
    
    //Получаем директорию для архивных и зашифрованных файлов
    $sql = "SELECT * FROM SPR_FILES WHERE ID = '1'";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_assoc($result);
    $path_afrfm = $row['IN_AFRFM'];
    $path_zfrfm = $row['IN_ZFRFM'];
    $path_arj = $row['ARJ_PATH'];
    
    //Разархивируем каждый файл
    foreach ($checkbox as $checkboxid){
        $sql = "SELECT * FROM FILES_IN_ARH WHERE ID = '$checkboxid'";
        $result = mysqli_query($db,$sql);
        $row = mysqli_fetch_assoc($result);
        $name = $row['NAME'];
        
        //Формируем команду на разархивацию ARJ X -Y А:\ТХТ.ARJ C:\ТХТ
        $comarj = $path_arj.'ARJ.EXE X -Y '.$path_afrfm.$name.' '.$path_zfrfm;
        
        //разархивируем
        exec($comarj);
        
        //Проверка на невыбранность файлов
        if ($checkbox[0] <> '') {
            $i++;
        }
        else {
            $i=0;
        }
        
        //Изменяем статус записи
        $sql = "UPDATE FILES_IN_ARH SET STATUS = 'Обработан' WHERE ID = '$checkboxid'";
        $result = mysqli_query($db,$sql);
        
        //Сканируем директорию зашифрованных файлов
        $files_zfrfm = scandir($path_zfrfm);
        unset($files_zfrfm[0],$files_zfrfm[1]);
        
        //Если файл не внесен в БД, то добавляем его
        foreach ($files_zfrfm as $filename){
            $sql = "SELECT * FROM FILES_IN_Z WHERE NAME = '$filename'";
            $result = mysqli_query($db,$sql);
            if ($result->num_rows == 0) {
                $sql = "INSERT INTO FILES_IN_Z (ID_A, NAME, STATUS) values ('$checkboxid', '$filename', 'Новый')";
                mysqli_query($db, $sql);
            }
        }
    }
    //Закрываем соединение с БД       
    mysqli_close($db);
    //Выводим результат
    echo ($i);
}
//Расшифровка файлов
if (isset($_POST['files_zfrfm'])) {
    $i = 0;
    
    //Монтируем диск
    $commount = 'D:\PHP\407p\BAT\MountDisk.bat';
    exec($commount);
    
    //Принимаем массив элементов
    $checkboxx = $_POST['checkbox'];
    $checkbox = explode(",", $checkboxx);
    
    //Получаем директорию для архивных и зашифрованных файлов
    $sql = "SELECT * FROM SPR_FILES WHERE ID = '1'";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_assoc($result);
    $path_zfrfm = $row['IN_ZFRFM'];
    $path_rfrfm = $row['IN_RFRFM'];
    
    
    
    //Копируем файлы в директорию расшифрованных файлов и расшифровываем их
    foreach ($checkbox as $checkboxid){
        $sql = "SELECT * FROM FILES_IN_Z WHERE ID = '$checkboxid'";
        $result = mysqli_query($db,$sql);
        $row = mysqli_fetch_assoc($result);
        $comline = 'copy /Y '.$path_zfrfm.$row['NAME'].' '.$path_rfrfm;
        exec($comline);
        
        $comuncrypt = 'D:\PHP\407p\SCSignEx\SCSignEx.exe -d -f'.$path_rfrfm.$row['NAME'];
        exec($comuncrypt);    
        
        //Проверка на невыбранность файлов
        if ($checkbox[0] <> '') {
            $i++;
        }
        else {
            $i=0;
        }
        
        //Изменяем статус записи
        $sql = "UPDATE FILES_IN_Z SET STATUS = 'Расшифрован' WHERE ID = '$checkboxid'";
        $result = mysqli_query($db,$sql);
        
        //Сканируем директорию зашифрованных файлов
        $files_rfrfm = scandir($path_rfrfm);
        unset($files_rfrfm[0],$files_rfrfm[1]);
        
        //Если файл не внесен в БД, то добавляем его
        foreach ($files_rfrfm as $filename){
            $sql = "SELECT * FROM FILES_IN_R WHERE NAME = '$filename'";
            $result = mysqli_query($db,$sql);
            if ($result->num_rows == 0) {
                $sql = "INSERT INTO FILES_IN_R (ID_Z, NAME, STATUS) values ('$checkboxid', '$filename', 'Новый')";
                mysqli_query($db, $sql);
            }
        }
    }
    //Закрываем соединение с БД       
    mysqli_close($db);
    
    //Размонтируем диск
    $commount = 'D:\PHP\407p\BAT\UnMountDisk.bat';
    exec($commount);
    
    //Выводим результат
    echo $i;
}




