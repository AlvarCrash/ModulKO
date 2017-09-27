<?php
session_start();
unset($_SESSION['login']);
unset($_SESSION['id']);
session_destroy();
header("Location:index.php");
// Тестирование удаленной разработки =) =)
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

