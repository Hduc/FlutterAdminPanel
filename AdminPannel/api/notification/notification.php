<?php

require("../../controllers/notification.php");
$notification = new Notification();

$page = 0;
$nb = 15;

if (isset($_GET['page']) && $_GET['page'] != "") {
    $page = $_GET['page'];
} else {
    $page = 0;
}
$offset = ($page) * $nb;

$notification_arr = array();
$notification_arr = $notification->getPagination($offset, $nb);

http_response_code(200);
echo json_encode($notification_arr);
