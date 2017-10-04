<?php
function clearStr($data, $cnn){
  
  $dara = trim(strip_tags($data));
  return mysqli_real_escape_string($cnn, $data);
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

