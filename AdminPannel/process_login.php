<?php
require_once("config/session.php"); 
require_once("config/helper.php");
require_once("controllers/users.php"); 

$email = validate_input(isset($_POST['email']) ? $_POST['email'] : '');
$password = validate_input(isset($_POST['password']) ? $_POST['password'] : '');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && is_array($_POST) && !empty($email) && !empty($password)) {

    $users = new Users();
    $users->setParams($_POST);
    $user = $users->login();
    if ($user) {
        $_SESSION['user'] = $user;
        header("Location: index.php"); 
        die();
    } else {
        header("Location: login.php?error=bG9naW4gZXJyb3I=");
        die();
    } 
} else {
    header("Location: login.php");
    die();
}
