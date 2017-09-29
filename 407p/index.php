<?php
session_start();
echo '<h1 align=center>Модуль 407-П</h1>';
require 'menu407p.php'; 
require_once 'db.php'; // Настройки подключения к БД
require_once 'functions.php'; // Подключение модуля функций
 
// подключаемся к базе данных
$connect = mysqli_connect($host, $user, $password, $database);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Авторизация</title>
<meta http-equiv="Content-Style-Type" content="text/css">
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php
// Проверяем, пусты ли переменные логина и id пользователя
    if (CheckLogin() == FALSE){
?>
 <!--Если пусты, то выводим форму входа.--> 
  <div id="login">
  <h2 id="header">Авторизация</h2>
  <form action="login.php" method="post">
    <input type="text" placeholder="E-Mail" id="EMAIL" name="login"></input><br />
    <input type="password" placeholder="Пароль" name="password"></input><br />
    <input type="submit" value="Войти" id="button"></input>
  </form>
  </div>

<?php
    }
    else  //Иначе. 
    {
	$login=$_SESSION['login'];
	//Формирование оператора SQL SELECT 
        if ($result = mysqli_query($connect, "SELECT * FROM SPR_USERS WHERE EMAIL = '$login'")) {
            while ($row = mysqli_fetch_assoc($result)){
            $name = $row['NAME'];
            $second_name = $row['SECOND_NAME'];
            $last_name = $row['LAST_NAME'];
        }
        mysqli_free_result($result);
}
mysqli_close($connect);                 

if ($_SESSION['type'] == 0){
include 'files.php';
}
else {
include 'settings_main.php';    
}

    }
    ?>
<?php
require 'menu407p.php';
?>
 
</body>
</html>

