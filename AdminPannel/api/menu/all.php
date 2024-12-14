<?php

require("../../controllers/menus.php");
$menus = new Menus();
 
$menus_arr=array();
$menus_arr["data"]=$menus->getAll(); 

http_response_code(200);
echo json_encode($menus_arr);
 