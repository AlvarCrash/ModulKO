<?php
session_start();
echo '<h1 align=center>Модуль 407-П</h1>';
require 'menu407p.html'; 
require_once 'db.php'; // подключаем скрипт
 
// подключаемся к базе данных
$connect = mysqli_connect($host, $user, $password, $database);
 
// выполняем операции с базой данных
     
// закрываем подключение
//mysqli_close($link);
//require 'reg.html';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Авторизация</title>
<meta http-equiv="Content-Style-Type" content="text/css">
<meta name="keywords" content="Ключевые слова для поисковиков">
<meta name="description" content="Описание сайта">
</head>
<body>
<?php
// Проверяем, пусты ли переменные логина и id пользователя
    if (empty($_SESSION['login']) or empty($_SESSION['id']))
    {
?>
 <!--Если пусты, то выводим форму входа.--> 
 <div style="border: 0px solid blue; 
 position:relative; top:100px; left:400px; height:200px; width:300px;">
		
<form action="login.php" method="post">
    <label>логин:</label><br/>
  <input name="login" type="text" size="15" maxlength="25"><br/>
    <label>пароль:</label><br/>
  <input name="password" type="password" size="15" maxlength="15"><br/><br/>
  <input type="submit" value="войти"><br/><br/>
</form>
Здравствуйте <font color="red">гость</font>! <br/>
Авторизуйтесь и пройдите по ссылке! 
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
	<h2 align=center><font color='green' align=center>Здравствуйте: "."<font color='red'>".$name." ".$second_name."</font>!</font></h2>
	<br/>
	<br/>
      <a href='exit.php'>выйти</a> 
   <br/>

</div>";
    }
    ?> 
</body>
</html>

