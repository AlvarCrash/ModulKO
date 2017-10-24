<?php
session_start();
unset($_SESSION['id']);
unset($_SESSION['type']);
unset($_SESSION['name']);
unset($_SESSION['second_name']);
unset($_SESSION['last_name']);
//unset($_SESIION['type']);
session_destroy();
header("Location: ../index.php");
// Тестирование удаленной разработки =) =)
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

