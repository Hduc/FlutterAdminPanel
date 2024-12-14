<?php

if (is_file("../config/DBClass.php")) {
  require_once("../config/DBClass.php");
} else {

  require_once("../../config/DBClass.php");
}
class Splash extends DBClass
{
  private $table = "splash";

  private $id;
  private $firstColor;
  private $secondColor;
  private $logo_splash;
  private $img_splash;
  private $enable_logo;
  private $enable_img;
  private $splash_logo_width;
  private $splash_logo_height;

  function setParams($data_array = null, $data_files = null)
  {
    if (isset($data_array) && is_array($data_array)) {
      if (isset($data_array['id'])) {
        $this->id = $data_array['id'];
      }
      if (isset($data_array['firstColor'])) {
        $this->firstColor = $data_array['firstColor'];
      }
      if (isset($data_array['secondColor'])) {
        $this->secondColor = $data_array['secondColor'];
      }
      if (isset($data_array['enable_logo'])) {
        $this->enable_logo = $data_array['enable_logo'] == "on";
      } else {
        $this->enable_logo = 0;
      }
      if (isset($data_array['enable_img'])) {
        $this->enable_img = $data_array['enable_img'] == "on";
      } else {
        $this->enable_img = 0;
      }

      if (isset($data_array['splash_logo_width'])) {
        $this->splash_logo_width = $data_array['splash_logo_width'];
      }

      if (isset($data_array['splash_logo_height'])) {
        $this->splash_logo_height = $data_array['splash_logo_height'];
      }
    }

    if (isset($data_files) && is_array($data_files)) {
      if (isset($data_files['logo_splash'])) {
        $this->logo_splash = $data_files['logo_splash'];
      }
      if (isset($data_files['img_splash'])) {
        $this->img_splash = $data_files['img_splash'];
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

  function getFirst()
  {
    $sql = "SELECT * FROM $this->table LIMIT 1";
    $res = $this->fetchArray($this->query($sql));

    $path = str_replace("controllers", "", (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/' . substr(__DIR__, strlen($_SERVER['DOCUMENT_ROOT'])));

    $res["logo_splash_url"] = $path . "images/splash/{$res['logo_splash']}";
    $res["img_splash_url"] = $path . "images/splash/{$res['img_splash']}";
    //$res["logo_splash_base64"] = base64_encode(file_get_contents($res["logo_splash_url"] ));
    //$res["img_splash_base64"] = base64_encode(file_get_contents($res["img_splash_url"] ));

    return $res;
  }

  function update()
  {

    $logo_splash = "logo_splash.png";
    if (isset($this->logo_splash) && substr($_FILES['logo_splash']['type'], 0, 5) == "image") {
      move_uploaded_file($_FILES['logo_splash']['tmp_name'], "../images/splash/logo_splash.png");
    }

    $img_splash = "img_splash.png";
    if (isset($this->img_splash) && substr($_FILES['img_splash']['type'], 0, 5) == "image") {
      move_uploaded_file($_FILES['img_splash']['tmp_name'], "../images/splash/img_splash.png");
    }

    $sql = "UPDATE $this->table SET 
      firstColor = '$this->firstColor',
      secondColor = '$this->secondColor',
      logo_splash = '$logo_splash',
      img_splash = '$img_splash',
      enable_logo = '$this->enable_logo',
      enable_img = '$this->enable_img',
      splash_logo_width = '$this->splash_logo_width',
      splash_logo_height = '$this->splash_logo_height'
      WHERE id ='$this->id'";

    try {
      $this->query($sql);
      $_SESSION['success'] = "<b>DONE!! </b> The settings has been updated.";
    } catch (Exception $e) {
      $_SESSION['error'] = " Settings not updated";
    }
  }
}
