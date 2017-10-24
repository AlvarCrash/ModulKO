<?php
require_once 'inc/db.php';
require_once 'inc/function.php';
ob_start();
session_start();
$id = strtolower(strip_tags(trim($_GET['id'])));

?>
<!DOCTYPE html>
<html>

<head>
  <title>
    <?=$title?>
  </title>
  <meta charset="utf-8" />
  <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>

<body>

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
    123
    </blockquote>
    <!-- Заголовок -->
    <!-- Область основного контента -->
    <?php 
      include 'inc/routing.php';
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
</body>

</html>