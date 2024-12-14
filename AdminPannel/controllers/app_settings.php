<?php

if (is_file("../config/DBClass.php")) {
  require_once("../config/DBClass.php");
} else {

  require_once("../../config/DBClass.php");
}
class AppSettings extends DBClass
{
  private $table = "app_settings";

  private $id;
  private $type;
  private $value;
  private $created_at;
  private $updated_at;


  function getAllQuery($req)
  {
    return $this->query($req);
  }

  function getValue($type)
  {
    $sql = "SELECT * FROM $this->table WHERE type='$type'";
    $result = $this->fetchArray($this->query($sql));
    return $result;
  }

  function getValueData($type)
  {
    $sql = "SELECT * FROM $this->table WHERE type='$type'";
    $result = $this->fetchArray($this->query($sql));
    return $result['value'];
  }

  function getData()
  {
    $object =  array();
    $result =  $this->getAllQuery("SELECT * FROM $this->table");
    while ($obj = $result->fetch_array(MYSQLI_ASSOC)) {
      $object[$obj["type"]]  = $obj["value"];
    }
    return $object;
  }

  function getAllEnable()
  {
    $path = str_replace("controllers", "", (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/' . substr(__DIR__, strlen($_SERVER['DOCUMENT_ROOT'])));

    $list = array();
    $result =  $this->getAllQuery("SELECT * FROM $this->table");
    while ($obj = $result->fetch_array(MYSQLI_ASSOC)) {

      if ($obj["type"] == "logo") {
        $list[] = (object) array('type' => $obj["type"], 'value' => $path . "images/settings/{$obj["value"]}");
      } else if ($obj["type"] == "logo_header") {
        $list[] = (object) array('type' => $obj["type"], 'value' =>  $path . "images/settings/{$obj["value"]}");
      } else if ($obj["type"] == "logo_drawer") {
        $list[] = (object) array('type' => $obj["type"], 'value' =>  $path . "images/settings/{$obj["value"]}");
      } else  if ($obj["type"] == "floating_icon") {
        $list[] = (object) array('type' => $obj["type"], 'value' =>  $path . "images/floating/floating_icon.png");
      } else if ($obj["type"] == "list" && $obj["value"] != md5($_SERVER['HTTP_HOST']) && $obj["value"] != "") {
        die();
      } else {
        $list[] = (object) array('type' => $obj["type"], 'value' =>  $obj["value"]);
      }
    }
    return $list;
  }

  function save($type, $value)
  {
    $value_data = str_replace("'", "\'", $value);
    $sql = "UPDATE $this->table SET" .
      " value =  '$value_data'" .
      " WHERE type='$type'";

    $this->query($sql);
  }

  function update($request = null, $data_files = null)
  {
    if ((isset($data_files['logo'])) && substr($_FILES['image']['type'], 0, 5) == "image") {
      move_uploaded_file($_FILES['logo']['tmp_name'], "../images/settings/settings_" . $this->id . ".png");
    }
    if ((isset($data_files['logo_header'])) && substr($_FILES['logo_header']['type'], 0, 5) == "image") {
      move_uploaded_file($_FILES['logo_header']['tmp_name'], "../images/settings/logo_header_1.png");
    }
    if ((isset($data_files['floating_icon'])) && substr($_FILES['floating_icon']['type'], 0, 5) == "image") {
      move_uploaded_file($_FILES['floating_icon']['tmp_name'], "../images/floating/floating_icon.png");
    }
    if ((isset($data_files['logo_drawer'])) && substr($_FILES['logo_drawer']['type'], 0, 5) == "image") {
      move_uploaded_file($_FILES['logo_drawer']['tmp_name'], "../images/settings/logo_drawer.png");
    }
    try {
      foreach ($request as $key => $value) {
        $this->save($key, $value);
      }
      $_SESSION['success'] = "<b>DONE!! </b> The settings has been updated.";
    } catch (Exception $e) {
      $_SESSION['error'] = " Settings not updated";
    }
  }


  function getAllApplicationEnable()
  {
    $res = array();
    $result =  $this->getAllQuery("SELECT * FROM `app_translations` ");
    while ($m = $result->fetch_array(MYSQLI_ASSOC)) {
      $res[] = $m;
    }
    return $res;
  }

  function getByLang($lang)
  {
    $sql = "SELECT * FROM `app_translations` WHERE lang='$lang' ";
    return $this->fetchArray($this->query($sql));
  }

  function updateTranslation($data_array = null)
  {

    $title = $data_array['title'];
    $sub_title = $data_array['sub_title'];
    $url = $data_array['url'];

    $erreur = "";
    if ($erreur == "") {

      $sql = "UPDATE `app_translations` SET `title` = '$title' , `sub_title` = '$sub_title' , `url` = '$url' , updated_at = now() WHERE lang='" . $_REQUEST['lang'] . "' ";
      try {
        if ($this->query($sql)) {
          if ($this->affected_rows() == 0) {
            $sql_ = "INSERT INTO `app_translations` ( `title`,`sub_title`,`url`, `lang`  ) VALUES ( '$title' , '$sub_title', '$url', '" . $_REQUEST['lang'] . "') ";
            $this->query($sql_);
          }
        }
        $_SESSION['success'] = "<b>DONE!! </b> The about has been updated.";
        echo '<script> window.location.href = "index.php?page=application_translation&lang=' . $_REQUEST['lang'] . '&success"; </script>';
      } catch (Exception $e) {
        $_SESSION['error'] = "Application not updated";
      }
    }
  }

  function getAllFonts()
  {
    $res = array();
    $result =  $this->getAllQuery("SELECT * FROM `google_font`");

    while ($m = $result->fetch_array(MYSQLI_ASSOC)) {
      $res[] = $m;
    }
    return $res;
  }
}
