<?php
ob_start();
session_start();
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
    
    <span class="slogan">Модуль 407-П</span>
    <!-- Верхняя часть страницы -->
  </div>

  <div id="content">
    <!-- Заголовок -->
    <h1><?= $header?></h1>
    <blockquote>
    
    </blockquote>
    <!-- Заголовок -->
    <!-- Область основного контента -->
    <?php 
      include 'inc/routing.php'; 
    ?>
    <!-- Область основного контента -->
  </div>
    <?php 
      include 'inc/menu_admin.php'; 
    ?>
  <div id="footer">
    <!-- Нижняя часть страницы -->
   
    <!-- Нижняя часть страницы -->
  </div>
</body>

</html>