<?php
session_start();
echo '<h1 align=center>Модуль 407-П</h1>';
require 'menu407p.html'; 
require_once 'db.php'; // подключаем скрипт
 
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
    if (empty($_SESSION['login']) or empty($_SESSION['id']))
    {
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
        }
        mysqli_free_result($result);
}
mysqli_close($connect);                 
echo "
<h3 align=center><font color='green' align=center>Здравствуйте: "."<font color='red'>".$name." ".$second_name."</font>!</font></h3>
<br/>
<br/>
<a href='exit.php'>выйти</a> 
<br/>
</div>";
    }
    ?>
<?php
require 'menu407p.html';
?>
 
</body>
</html>

