<?php
session_start();
require_once 'db.php';
require_once 'function.php';

// Подключаемся к БД
$db = mysqli_connect($host, $user, $password, $database);
//echo $_SESSION['id'];
$email = $_POST["email"];
//echo $email;
$password = $_POST["password"];
              
$sql = "SELECT * FROM SPR_USERS WHERE EMAIL='$email'";
$result = mysqli_query($db,$sql);
mysqli_close($db);
while ($row = mysqli_fetch_assoc($result)){
    // Проверяем авторизацию
    if ($row["PASSWORD"] == $password){
    $id = $row["ID"];
    $_SESSION['id'] = $id;
    header("location: ../index.php");
    }
    header("location: ../index.php");        

}



if (empty($_SESSION['id'])){
//Если пользователь не авторизован, то выводим форму авторизации
    ?>
<br>
<p>Авторизация:</p>
    <form action="inc/login.php" method="POST">
        <label for="name">Логин:</label><br>
        <input type="text" name="email" id="email" required></input><br><br>
        <label for="password">Пароль:</label><br>
        <input type="password" name="password" required></input><br><br>
        <input type="submit" value="Войти"></input>
    </form>
    <?php
}
// Если пользователь авторизован, выводим приветствие
else{
    echo "<br><p>Охуеть!</p>";
    
    
}



/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

