<?php
require_once 'db.php';
//Соединяемся с базой данных
$connect = mysqli_connect($host, $user, $password, $database);

header('Content-Type: text/html; charset=utf-8');
setlocale(LC_ALL,'ru_RU.65001','rus_RUS.65001','Russian_Russia.65001','russian');
session_start();//  вся процедура работает на сессиях. Именно в ней хранятся данные  пользователя, пока он находится на сайте. Очень важно запустить их в  самом начале странички!!!
if (isset($_POST['login'])) { $login = $_POST['login']; if ($login == '') { unset($login);} } //заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную
    if (isset($_POST['password'])) { $password=$_POST['password']; if ($password =='') { unset($password);} }
    //заносим введенный пользователем пароль в переменную $password, если он пустой, то уничтожаем переменную
if (empty($login) or empty($password)) //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
    {
    exit ("<body><div align='center'><br/><br/><br/><h3>Вы ввели не всю информацию, вернитесь назад и заполните все поля!" . "<a href='index.php'> <b>Назад</b> </a></h3></div></body>");
    }
    //если логин и пароль введены,то обрабатываем их, чтобы теги и скрипты не работали, мало ли что люди могут ввести
    $login = stripslashes($login);
    $login = htmlspecialchars($login);
    $password = stripslashes($password);
    $password = htmlspecialchars($password);
//удаляем лишние пробелы
    $login = trim($login);
    $password = trim($password);
	
 //Подключаемся к базе данных.
 //$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));
 //извлекаем из базы все данные о пользователе с введенным логином

    
    
    
    $result = mysqli_query($connect, "SELECT * FROM SPR_USERS WHERE EMAIL = '$login'");
    while ($row = mysqli_fetch_assoc($result)){
       $passsword = $row['PASSWORD'];
       $email = $row['EMAIL'];
       $id = $row['ID'];
    }

    //$myrow = mysqli_stmt_fetch($result);
    if (empty($email))
    {
    //если пользователя с введенным логином не существует
        exit ("<body><div align='center'><br/><br/><br/><h3>Извините, введённый вами login неверный." . "<a href='index.php'> <b>Назад</b> </a></h3></div></body>");
    }
    else {
    //если существует, то сверяем пароли
    if ($passsword==$password) {
    //если пароли совпадают, то запускаем пользователю сессию! Можете его поздравить, он вошел!
    $_SESSION['login']=$email; 
    $_SESSION['id']=$id;
    //эти данные очень часто используются, вот их и будет "носить с собой" вошедший пользователь
    header("Location:index.php"); 
    }
    else {
    //если пароли не сошлись
        //echo $_POST['login'];
        //echo $_POST['password'];
        //echo $password;
    exit ("<body><div align='center'><br/><br/><br/><h3>Извините, введённый вами пароль неверный." . "<a href='index.php'> <b>Назад</b> </a></h3></div></body>");
    }
    }
    
    mysqli_free_result($result);
    mysqli_close($connect); 
    ?>
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

