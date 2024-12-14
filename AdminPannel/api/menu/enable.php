<?php


require_once("../../config/DBClass.php");
$menus = new Menus();
 
$menus_arr=array();
$menus_arr["data"]=$menus->getAllEnable(); 

http_response_code(200);
echo json_encode($menus_arr);
 