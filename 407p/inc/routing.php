<?php
switch($id){
	case 'contact': include 'inc/contact.inc.php'; break;
	case 'about': include 'inc/about.inc.php'; break;
	case 'info': include 'inc/info.inc.php'; break;
	case 'log': include 'inc/view-log.inc.php'; break;
	case 'gbook': include 'inc/gbook.inc.php'; break;
	default: include 'inc/login.php';
}	
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

