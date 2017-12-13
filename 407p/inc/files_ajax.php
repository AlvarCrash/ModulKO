<?php
require_once 'db.php';

// Подключаемся к БД
$db = mysqli_connect($host, $user, $password, $database);

if (!$db) {
        printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error());
        exit;
    }

//Получаем БИК
    $sql = "SELECT * FROM SPR_BANK";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_assoc($result);
    $bik = $row['BIK'];

//Загрузка новых архивных файлов ЭМ РФМ      
if (isset($_POST['files_lfrfm'])) {
    //Получаем директорию для архивных файлов ЭМ РФМ
    $i = 0;
    $sql = "SELECT * FROM SPR_FILES";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_assoc($result);
    $path_afrfm = $row['IN_AFRFM'];
    
    
    //Получаем список файлов в директории и убираем точки
    $files_afrfm = scandir($path_afrfm);
    unset($files_afrfm[0],$files_afrfm[1]);    
    
    //Если файл не внесен в БД, то добавляем его
    foreach ($files_afrfm as $filename){
        //Проверка имени файла на соответствие
        $pattern = '/RRFM_'.$bik.'_[0-9]{8}_[0-9]{3}.ARJ/';
        if (preg_match($pattern, $filename)){
            $sql = "SELECT * FROM FILES_IN_ARH WHERE NAME = '$filename'";
            $result = mysqli_query($db,$sql);
            if ($result->num_rows == 0) {
                $sql = "INSERT INTO FILES_IN_ARH (NAME, STATUS) values ('$filename', 'Новый')";
                mysqli_query($db, $sql);
                $i++;
            }
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
    $sql = "SELECT * FROM SPR_FILES";
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
   
    //Принимаем массив элементов
    $checkboxx = $_POST['checkbox'];
    $checkbox = explode(",", $checkboxx);
    
    //Получаем директорию для архивных и зашифрованных файлов
    $sql = "SELECT * FROM SPR_FILES";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_assoc($result);
    $path_zfrfm = $row['IN_ZFRFM'];
    $path_rfrfm = $row['IN_RFRFM'];
    
    //Получаем директории SCSIGN и BAT файлов
    $sql = "SELECT * FROM SPR_KEYS";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_assoc($result);
    $path_bat = $row['BAT'];
    $path_scsign = $row['SCSIGN'];
    
    //Монтируем диск
    $commount = $path_bat.'MountDisk.bat';
    exec($commount);
    
    //Копируем файлы в директорию расшифрованных файлов и расшифровываем их
    foreach ($checkbox as $checkboxid){
        $sql = "SELECT * FROM FILES_IN_Z WHERE ID = '$checkboxid'";
        $result = mysqli_query($db,$sql);
        $row = mysqli_fetch_assoc($result);
        $comline = 'copy /Y '.$path_zfrfm.$row['NAME'].' '.$path_rfrfm;
        exec($comline);
        
        $comuncrypt = $path_scsign.'SCSignEx.exe -d -f'.$path_rfrfm.$row['NAME'];
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
    $commount = $path_bat.'UnMountDisk.bat';
    exec($commount);
    
    //Выводим результат
    echo $i;
}

//Разархивирование расшифрованных файлов
if (isset($_POST['files_rfm'])) {
    $i = 0;
    
    //Принимаем массив элементов
    $checkboxx = $_POST['checkbox'];
    $checkbox = explode(",", $checkboxx);
    
    //Получаем директорию для расшифрованных и конечных файлов
    $sql = "SELECT * FROM SPR_FILES";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_assoc($result);
    $path_rfm = $row['IN_RFM'];
    $path_rfrfm = $row['IN_RFRFM'];
    
    //Разархивируем файлы в конечную директорию
    foreach ($checkbox as $checkboxid){
        $sql = "SELECT * FROM FILES_IN_R WHERE ID = '$checkboxid'";
        $result = mysqli_query($db,$sql);
        $row = mysqli_fetch_assoc($result);
        
        //Собственно разархивация
        $zip = new ZipArchive;
        $res = $zip->open($path_rfrfm.$row['NAME']);
        if ($res === TRUE) {
          $zip->extractTo($path_rfm);
          $zip->close();
        }
        
        //Проверка на невыбранность файлов
        if ($checkbox[0] <> '') {
            $i++;
        }
        else {
            $i=0;
        }
        
        //Изменяем статус записи
        $sql = "UPDATE FILES_IN_R SET STATUS = 'Разархивирован' WHERE ID = '$checkboxid'";
        $result = mysqli_query($db,$sql);
        
        //Сканируем директорию зашифрованных файлов
        $files_rfm = scandir($path_rfm);
        unset($files_rfm[0],$files_rfm[1]);
        
        //Если файл не внесен в БД, то добавляем его
        foreach ($files_rfm as $filename){
            
            $sql = "SELECT * FROM FILES_IN_RFM WHERE NAME = '$filename'";
            $result = mysqli_query($db,$sql);
            if ($result->num_rows == 0) {
                $sql = "INSERT INTO FILES_IN_RFM (ID_R, NAME, STATUS) values ('$checkboxid', '$filename', 'Новый')";
                mysqli_query($db, $sql);
            }
            
        }
    }
    
    //Закрываем соединение с БД       
    //mysqli_close($db);
    
    //Выводим результат
    echo $i;
}

//логический контроль файлов
if (isset($_POST['files_log'])) {
    $i = 0;
    //$error = '';
    //Принимаем массив элементов
    $checkboxx = $_POST['checkbox'];
    $checkbox = explode(",", $checkboxx);
    
    //Получаем директорию для конечных файлов
    $sql = "SELECT * FROM SPR_FILES";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_assoc($result);
    $path_rfm = $row['IN_RFM'];
    
    //Проводим логический контроль для каждого файла
    foreach ($checkbox as $checkboxid){
        $sql = "SELECT * FROM FILES_IN_RFM WHERE ID = '$checkboxid'";
        $result = mysqli_query($db,$sql);
        $row = mysqli_fetch_assoc($result);
        
        $file = $path_rfm.$row['NAME'];
        $schema = 'D:\PHP\407p\XSD\RequestSchema.xsd';
        $ab = new DOMDocument;
        $ab->load($file);

        if ($ab->Schemavalidate($schema)) {
            //Обновляем статус файла в БД
            $sql = "UPDATE FILES_IN_RFM SET STATUS = 'Проверен' WHERE ID = '$checkboxid'";
            $result = mysqli_query($db,$sql);
            $i++;
        } else {
            //Обновляем статус файла в БД при ошибке
            $sql = "UPDATE FILES_IN_RFM SET STATUS = 'Ошибка синтаксиса в документе!' WHERE ID = '$checkboxid'";
            $result = mysqli_query($db,$sql);
        }

        
        
    }
    echo $i;
    mysqli_close($db);
}

//Закрываем соединение с БД
//mysqli_close($db);


