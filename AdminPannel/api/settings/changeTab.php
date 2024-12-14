<?php
require_once("../../controllers/app_settings.php");
$app_settings = new AppSettings();

if (isset($_POST['tab_navigation_enable'])) { 
    $app_settings->save("tab_navigation_enable", $_POST['tab_navigation_enable'] );
}

if (isset($_POST['colorTab'])) {
    $app_settings->save("colorTab", $_POST['colorTab'] );
}

if (isset($_POST['tab_refresh'])) {
    $app_settings->save("tab_refresh", $_POST['tab_refresh'] );
}