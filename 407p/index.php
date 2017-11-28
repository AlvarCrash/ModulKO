<?php

require_once 'inc/db.php';
require_once 'inc/function.php';
ob_start();

session_start();
$id = strtolower(strip_tags(trim($_GET['id'])));

?>
<!DOCTYPE html>


<head>
  <title>
    <?=$title?>
  </title>
  <meta charset="utf-8" />
  
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
  
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  
  <link rel="stylesheet" type="text/css" href="css/bootstrap-editable.css"/>
  
  <script type='text/javascript' src='script/jquery.js'></script>
  
  <script type='text/javascript' src='script/bootstrap.min.js'></script>
  
  <script type='text/javascript' src='script/bootstrap-editable.js'></script>
  
  <script type='text/javascript' src='script/script.js'></script>
  
  <script type='text/javascript' src='script/script_file_change.js'></script>
  
  <script src="script/jquery-ui.js"></script>

  <link rel="stylesheet" href="css/jquery-ui.css">

  </head>



  <div id="header">
    <!-- Верхняя часть страницы -->
    <?php
        if (($_SESSION['type'] == 0) AND (isset($_SESSION['type']))) {
            include 'inc/hello.php';
        }
    ?>
    <span class="slogan">Модуль 407-П</span>
    <!-- Верхняя часть страницы -->
  </div>

  <div id="content">
    <!-- Заголовок -->
    <h1><?= $header?></h1>
    <blockquote>
    Что-нить напишем потом!
    </blockquote>
    <!-- Заголовок -->
    <!-- Область основного контента -->
    <div id="auth">
        <p>Авторизация:</p>
        
            <label for="name">Логин:</label><br>
            <input type="text" name="email" id="emailauth" required></input><br><br>
            <label for="password">Пароль:</label><br>
            <input type="password" name="password" id="passauth" required></input><br><br>
            <button class="ui-button ui-widget ui-corner-all" id="loginbutton"><span class="ui-icon ui-icon-key"></span>Войти</button>
        
    </div>
     <?php
      
      include 'inc/routing.php';
      if (isset($_SESSION['type'])){
        echo "<script>$('#auth').hide();</script>";
        switch($id){ 
          case 'users_set': 
              include 'inc/users_set.php'; 
              break; 
          case 'main_set': 
              include 'inc/main_set.php'; 
              break;
          case 'file_set': 
              include 'inc/file_set.php'; 
              break;
          case 'file_change':
              include 'inc/file_change.php';
              break;
          case 'keys_set':
              include 'inc/keys_set.php';
              break;
        }
      }
    ?>
    <!-- Область основного контента -->
  </div>
    <?php 
        if (isset($_SESSION['type'])){
            switch ($_SESSION['type']){
                case 0:
                    include 'inc/menu_user.php';
                    break;
                case 1:
                    include 'inc/menu_admin.php';
                    break;
            }
        } else {
            include 'inc/menu_main.php';
        }
         
    ?>
  <div id="footer">
    <!-- Нижняя часть страницы -->
   
    <!-- Нижняя часть страницы -->
  </div>


