<?php
ini_set('display_errors', 1);
require_once("../../controllers/settings.php");
require_once("../../controllers/menus.php");
require_once("../../controllers/socials.php");
require_once("../../controllers/LeftNavigationIcon.php");
require_once("../../controllers/RightNavigationIcon.php");
require_once("../../controllers/splash.php");
require_once("../../controllers/userAgent.php");
require_once("../../controllers/tab.php");
require_once("../../controllers/pages.php");
require_once("../../controllers/boarding.php");
require_once("../../controllers/floatings.php");

$settings = new Settings();
$menus = new Menus();
$floatings = new Floatings();
$socials = new Socials();
$leftNavigationIcon = new LeftNavigationIcon();
$rightNavigationIcon = new RightNavigationIcon();
$splash = new Splash();
$userAgent = new UserAgent();
$tab = new Tab();
$pages = new Pages();
$boarding = new Boarding();

$settings_arr = array();
$settings_arr["data"] = $settings->getFirst();
$settings_arr["data"]["list"] = $settings->getAllEnable();
$settings_arr["data"]["menus"] = $menus->getAllEnable();
$settings_arr["data"]["socials"] = $socials->getAllEnable();
$settings_arr["data"]["leftNavigationIcon"] = $leftNavigationIcon->getAllEnable();
$settings_arr["data"]["rightNavigationIcon"] = $rightNavigationIcon->getAllEnable();
$settings_arr["data"]["rightNavigationIconList"] = $rightNavigationIcon->getAllEnableList();
$settings_arr["data"]["splash"] = $splash->getFirst();
$settings_arr["data"]["userAgent"] = $userAgent->getAllEnable();
$settings_arr["data"]["tab"] = $tab->getAllEnable();
$settings_arr["data"]["pages"] = $pages->getAllEnable();
$settings_arr["data"]["sliders"] = $boarding->getAllEnable();
$settings_arr["data"]["floating"] = $floatings->getAllEnable();


http_response_code(200);

header('Content-type:application/json;charset=utf-8');
echo json_encode($settings_arr);
