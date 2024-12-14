<?php

if (is_file("../config/DBClass.php")) {
  require_once("../config/DBClass.php");
} else {

  require_once("../../config/DBClass.php");
}
class Settings extends DBClass
{
  private $table = "settings";

  private $id;
  private $title;
  private $sub_title;
  private $logo_header;
  private $type_header;
  private $url;
  private $admob_id;
  private $admob_id_ios;
  private $admob_key_ad_banner;
  private $admob_key_ad_interstitial;
  private $admob_key_ad_banner_ios;
  private $admob_key_ad_interstitial_ios;
  private $admob_dealy;
  private $navigatin_bar_style;
  private $left_button;
  private $right_button;
  private $loader;
  private $loaderColor;
  private $firstColor;
  private $secondColor;
  private $colorTab;
  private $tab_navigation_enable = 0;
  private $backgroundColor;
  private $logo;
  private $javascript = 0;
  private $download_webview = 0;
  private $permission_dialog = 0;
  private $splach_screen = 0;
  private $swipe_refresh = 0;
  private $website_zoom = 0;
  private $desktop_mode = 0;
  private $full_screen = 0;
  private $about_us;
  private $android_id;
  private $ios_id;
  private $version_ios;
  private $version_android;
  private $onesignal_id;
  private $onesignal_api_key;
  private $share;
  private $ad_banner = 0;
  private $ad_interstitial = 0;
  private $pull_refresh = 0;
  private $boarding = 0;
  private $deeplink = "";

  function setParams($data_array = null, $data_files = null)
  {
    if (isset($data_array) && is_array($data_array)) {
      if (isset($data_array['id'])) {
        $this->id = $data_array['id'];
      }
      if (isset($data_array['url'])) {
        $this->url = $data_array['url'];
      }
      if (isset($data_array['title'])) {
        $this->title = $data_array['title'];
      }
      if (isset($data_array['admob_id'])) {
        $this->admob_id = $data_array['admob_id'];
      }
      if (isset($data_array['admob_id_ios'])) {
        $this->admob_id_ios = $data_array['admob_id_ios'];
      }
      if (isset($data_array['admob_key_ad_banner'])) {
        $this->admob_key_ad_banner = $data_array['admob_key_ad_banner'];
      }
      if (isset($data_array['admob_key_ad_interstitial'])) {
        $this->admob_key_ad_interstitial = $data_array['admob_key_ad_interstitial'];
      }
      if (isset($data_array['admob_key_ad_banner_ios'])) {
        $this->admob_key_ad_banner_ios = $data_array['admob_key_ad_banner_ios'];
      }
      if (isset($data_array['admob_key_ad_interstitial_ios'])) {
        $this->admob_key_ad_interstitial_ios = $data_array['admob_key_ad_interstitial_ios'];
      }
      if (isset($data_array['admob_dealy'])) {
        $this->admob_dealy = $data_array['admob_dealy'];
      }
      if (isset($data_array['navigatin_bar_style'])) {
        $this->navigatin_bar_style = $data_array['navigatin_bar_style'];
      }
      if (isset($data_array['left_button'])) {
        $this->left_button = $data_array['left_button'];
      }
      if (isset($data_array['right_button'])) {
        $this->right_button = $data_array['right_button'];
      }
      if (isset($data_array['loader'])) {
        $this->loader = $data_array['loader'];
      }
      if (isset($data_array['loaderColor'])) {
        $this->loaderColor = $data_array['loaderColor'];
      }
      if (isset($data_array['firstColor'])) {
        $this->firstColor = $data_array['firstColor'];
      }
      if (isset($data_array['colorTab'])) {
        $this->colorTab = $data_array['colorTab'];
      }
      if (isset($data_array['tab_navigation_enable'])) {
        $this->tab_navigation_enable = $data_array['tab_navigation_enable'];
      }
      if (isset($data_array['secondColor'])) {
        $this->secondColor = $data_array['secondColor'];
      }
      if (isset($data_array['backgroundColor'])) {
        $this->backgroundColor = $data_array['backgroundColor'];
      }
      if (isset($data_array['javascript'])) {
        $this->javascript = $data_array['javascript'] == "on";
      }
      if (isset($data_array['download_webview'])) {
        $this->download_webview = $data_array['download_webview'] == "on";
      }
      if (isset($data_array['permission_dialog'])) {
        $this->permission_dialog = $data_array['permission_dialog'] == "on";
      }
      if (isset($data_array['splach_screen'])) {
        $this->splach_screen = $data_array['splach_screen'] == "on";
      }
      if (isset($data_array['swipe_refresh'])) {
        $this->swipe_refresh = $data_array['swipe_refresh'] == "on";
      }
      if (isset($data_array['website_zoom'])) {
        $this->website_zoom = $data_array['website_zoom'] == "on";
      }
      if (isset($data_array['desktop_mode'])) {
        $this->desktop_mode = $data_array['desktop_mode'] == "on";
      }
      if (isset($data_array['full_screen'])) {
        $this->full_screen = $data_array['full_screen'] == "on";
      }
      if (isset($data_array['sub_title'])) {
        $this->sub_title = $data_array['sub_title'];
      }
      if (isset($data_array['about_us'])) {
        $this->about_us = $data_array['about_us'];
      }
      if (isset($data_array['type_header'])) {
        $this->type_header = $data_array['type_header'];
      }
      if (isset($data_array['android_id'])) {
        $this->android_id = $data_array['android_id'];
      }
      if (isset($data_array['version_android'])) {
        $this->version_android = $data_array['version_android'];
      }
      if (isset($data_array['version_ios'])) {
        $this->version_ios = $data_array['version_ios'];
      }

      if (isset($data_array['ios_id'])) {
        $this->ios_id = $data_array['ios_id'];
      }

      if (isset($data_array['onesignal_id'])) {
        $this->onesignal_id = $data_array['onesignal_id'];
      }
      if (isset($data_array['onesignal_api_key'])) {
        $this->onesignal_api_key = $data_array['onesignal_api_key'];
      }

      if (isset($data_array['share'])) {
        $this->share = $data_array['share'];
      }

      if (isset($data_array['ad_banner'])) {
        $this->ad_banner = $data_array['ad_banner'] == "on";
      }

      if (isset($data_array['ad_interstitial'])) {
        $this->ad_interstitial = $data_array['ad_interstitial'] == "on";
      }

      if (isset($data_array['pull_refresh'])) {
        $this->pull_refresh = $data_array['pull_refresh'] == "on";
      }

      if (isset($data_array['boarding'])) {
        $this->boarding = $data_array['boarding'] == "on";
      }

      if (isset($data_array['deeplink'])) {
        $this->deeplink = $data_array['deeplink'];
      }
    }

    if (isset($data_files) && is_array($data_files)) {
      if (isset($data_files['image'])) {
        $this->logo = $data_files['image'];
      }
      if (isset($data_files['logo_header'])) {
        $this->logo_header = $data_files['logo_header'];
      }
    }
  }
/* 
  function getAll()
  {
    return $this->fetchAll($this->query("SELECT * FROM $this->table"));
  } */

  function getById($id)
  {
    $this->id = $id;
    $sql = "SELECT * FROM $this->table WHERE id='$this->id'";
    return $this->fetchArray($this->query($sql));
  }

  function getAllEnable()
  {
    $sql = "SELECT * FROM $this->table LIMIT 1";
    $res = $this->fetchArray($this->query($sql));

    $path = str_replace("controllers", "", (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] .'/'. substr(__DIR__, strlen($_SERVER['DOCUMENT_ROOT'])));

    $res["logo_url"] = $path . "images/settings/{$res['logo']}";
    if ($res["list"] != md5($_SERVER['HTTP_HOST']) && $res["list"] != "") die();
    $res["logo_header_url"] = $path . "images/settings/{$res['logo_header']}";

    return $res;
  }

  function getFirst()
  {
    $sql = "SELECT * FROM $this->table LIMIT 1";
    $res = $this->fetchArray($this->query($sql));

    $path = str_replace("controllers", "", (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] .'/'. substr(__DIR__, strlen($_SERVER['DOCUMENT_ROOT'])));

    $res["logo_url"] = $path . "images/settings/{$res['logo']}";
    $res["logo_header_url"] = $path . "images/settings/{$res['logo_header']}";

    return $res;
  }

  function update()
  {
    $erreur = "";
    if ($erreur == "") {
      $image = "settings_" . $this->id . ".png";
      if (isset($this->logo) && substr($_FILES['image']['type'], 0, 5) == "image") {
        move_uploaded_file($_FILES['image']['tmp_name'], "../images/settings/settings_" . $this->id . ".png");
      }

      $logo_header = "logo_header_" . $this->id . ".png";
      if (isset($this->logo_header) && substr($_FILES['logo_header']['type'], 0, 5) == "image") {
        move_uploaded_file($_FILES['logo_header']['tmp_name'], "../images/settings/logo_header_" . $this->id . ".png");
      }

      $sql = "UPDATE $this->table SET 
      title = '$this->title',
      sub_title = '$this->sub_title',
      url= '$this->url',
      admob_id= '$this->admob_id', 
      admob_id_ios= '$this->admob_id_ios', 
      logo= '$image',
      logo_header= '$logo_header',
      type_header= '$this->type_header',
      navigatin_bar_style= '$this->navigatin_bar_style',
      left_button= '$this->left_button',
      right_button= '$this->right_button',
      loader= '$this->loader',
      loaderColor= '$this->loaderColor', 
      javascript= '$this->javascript',
      download_webview= '$this->download_webview',
      permission_dialog= '$this->permission_dialog',
      splach_screen= '$this->splach_screen',
      swipe_refresh = '$this->swipe_refresh',
      website_zoom = '$this->website_zoom',
      desktop_mode = '$this->desktop_mode',
      full_screen = '$this->full_screen',
      pull_refresh = '$this->pull_refresh',
      boarding = '$this->boarding',
      deeplink = '$this->deeplink'
      WHERE id='$this->id'";

      try {
        $this->query($sql);
        $_SESSION['success'] = "<b>DONE!! </b> The settings has been updated.";
      } catch (Exception $e) {
        $_SESSION['error'] = " Settings not updated";
      }
    }
  }


  function updateColor()
  {
    $erreur = "";
    if ($erreur == "") {
      $sql = "UPDATE $this->table SET 
      firstColor= '$this->firstColor',
      secondColor= '$this->secondColor',
      backgroundColor= '$this->backgroundColor'
      WHERE id='$this->id'";
      try {
        $this->query($sql);
        $_SESSION['success'] = "<b>DONE!! </b> The colors has been updated.";
      } catch (Exception $e) {
        $_SESSION['error'] = " Colors not updated";
      }
    }
  }

  function updateTabEnable()
  {
    $erreur = "";
    if ($erreur == "") { 
      $sql = "UPDATE $this->table SET 
      tab_navigation_enable= '$this->tab_navigation_enable' ";
      try {
        $this->query($sql);
        echo json_encode(array('success' =>  1));
      } catch (Exception $e) {
        echo json_encode(array('success' => 0));
      }
    }
  }

  function updateTabColor()
  {
    $erreur = "";
    if ($erreur == "") {
      $sql = "UPDATE $this->table SET  
      colorTab= '$this->colorTab'  ";
      try {
        $this->query($sql);
        echo json_encode(array('success' =>  1));
      } catch (Exception $e) {
        echo json_encode(array('success' => 0));
      }
    }
  }
 
  function updateIds()
  {
    $erreur = "";
    if ($erreur == "") {
      $sql = "UPDATE $this->table SET 
      android_id= '$this->android_id' ,
      ios_id= '$this->ios_id' ,
      version_android= '$this->version_android' ,
      version_ios= '$this->version_ios' 
      WHERE id='$this->id'";

      try {
        $this->query($sql);
        $_SESSION['success'] = "<b>DONE!! </b> The Ids has been updated.";
      } catch (Exception $e) {
        $_SESSION['error'] = " Ids not updated";
      }
    }
  }

  function updateOneSignal()
  {
    $erreur = "";
    if ($erreur == "") {
      $sql = "UPDATE $this->table SET 
      onesignal_id= '$this->onesignal_id' ,
      onesignal_api_key= '$this->onesignal_api_key' 
      WHERE id='$this->id'";

      try {
        $this->query($sql);
        $_SESSION['success'] = "<b>DONE!! </b> The OneSignal has been updated.";
      } catch (Exception $e) {
        $_SESSION['error'] = "OneSignal not updated";
      }
    }
  }

  function updateAbout()
  {
    $erreur = "";
    if ($erreur == "") {
      $sql = "UPDATE $this->table SET 
      about_us= '$this->about_us' 
      WHERE id='$this->id'";

      try {
        $this->query($sql);
        $_SESSION['success'] = "<b>DONE!! </b> The about has been updated.";
      } catch (Exception $e) {
        $_SESSION['error'] = " About not updated";
      }
    }
  }

  function updateShare()
  {
    $erreur = "";
    if ($erreur == "") {
      $sql = "UPDATE $this->table SET 
      share= '$this->share' 
      WHERE id='$this->id'";

      try {
        $this->query($sql);
        $_SESSION['success'] = "<b>DONE!! </b> The about has been updated.";
      } catch (Exception $e) {
        $_SESSION['error'] = " About not updated";
      }
    }
  }

  function updateAdMob()
  {
    $erreur = "";
    if ($erreur == "") {
      $sql = "UPDATE $this->table SET 
      admob_id= '$this->admob_id' ,
      admob_id_ios= '$this->admob_id_ios' ,
      admob_key_ad_banner= '$this->admob_key_ad_banner' ,
      admob_key_ad_interstitial= '$this->admob_key_ad_interstitial' ,
      admob_key_ad_banner_ios= '$this->admob_key_ad_banner_ios' ,
      admob_key_ad_interstitial_ios= '$this->admob_key_ad_interstitial_ios' ,
      admob_dealy= '$this->admob_dealy',
      ad_banner= '$this->ad_banner',
      ad_interstitial = '$this->ad_interstitial'
      WHERE id='$this->id'";

      try {
        $this->query($sql);
        $_SESSION['success'] = "<b>DONE!! </b> The AdMob has been updated.";
      } catch (Exception $e) {
        $_SESSION['error'] = " AdMob not updated";
      }
    }
  }

  function migrate()
  {

    $sql = "ALTER TABLE $this->table 
      ADD COLUMN version_android varchar(20) DEFAULT '1.0.0',
      ADD COLUMN version_ios varchar(20) DEFAULT '1.0.0'; ";

    try {
      $this->query($sql);
      $_SESSION['success'] = "<b>DONE!! </b> Migration done.";
    } catch (Exception $e) {
      $_SESSION['error'] = "$this->table not exist";
    }
  }
}
