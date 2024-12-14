<?php
if (is_file("../config/DBClass.php")) {
  require_once("../config/DBClass.php");
} else {
  require_once("../../config/DBClass.php");
}

require_once "app_settings.php";
require_once "languages.php";

class Translations extends DBClass
{

  private $table = "translations";
  private $id;
  private $lang;
  private $lang_key;
  private $lang_value;
  private $created_at;
  private $updated_at;

  function setParams($data_array = null, $data_files = null)
  {
    if (isset($data_array) && is_array($data_array)) {
      if (isset($data_array['id']))
        $this->id = $data_array['id'];
      if (isset($data_array['lang']))
        $this->lang = $data_array['lang'];
      if (isset($data_array['lang_key']))
        $this->lang_key = $data_array['lang_key'];
      if (isset($data_array['lang_value']))
        $this->lang_value = $data_array['lang_value'];
    }
  }

  function getLast()
  {
    $res = array();
    $result =  $this->getAllQuery("SELECT * FROM $this->table ORDER BY id desc limit 5");
    while ($m = $result->fetch_array(MYSQLI_ASSOC)) {
      $res[] = $m;
    }
    return $result;
  }

  function getAllQuery($req)
  {
    return $this->query($req);
  }

  function getAllTranslation()
  {
    $res = array();
    $result =  $this->getAllQuery("SELECT * FROM $this->table");
    while ($m = $result->fetch_array(MYSQLI_ASSOC)) {
      $res[] = $m;
    }
    return $res;
  }

  function getAll()
  {
    $res = array();
    $result =  $this->getAllQuery("SELECT * FROM $this->table");
    while ($m = $result->fetch_array(MYSQLI_ASSOC)) {

      $res[] = $m;
    }
    return $res;
  }

  function getAllEnable()
  {
    $res = array();
    $result =  $this->getAllQuery("SELECT * FROM $this->table WHERE status=1");
    while ($m = $result->fetch_array(MYSQLI_ASSOC)) {
      $res[] = $m;
    }
    return $res;
  }

  function getById($id)
  {
    $this->id = $id;
    $sql = "SELECT * FROM $this->table WHERE id='$this->id'";
    return $this->fetchArray($this->query($sql));
  }

  function findObjectByKey($key, $array)
  {

    if (isset($array->{$key})) {
      return $array->{$key};
    }
    return false;
  }

  function getByLang($lang)
  {
    $appsettings = new AppSettings();
    $languages = new Languages();
    $default_id = $appsettings->getValueData('default_language');
    $data =  $languages->getById($default_id);
    $default_lang =  $data["app_lang_code"];

    $result_default =  $this->getAllQuery("SELECT * FROM $this->table WHERE lang='$default_lang'");
    $object_default = new stdClass();
    while ($m = $result_default->fetch_array()) {
      $key = $m["lang_key"];
      $object_default->{$key} = $m["lang_value"];
    }

    $res = array();
    $result =  $this->getAllQuery("SELECT * FROM $this->table WHERE lang='$lang'");

    while ($m = $result->fetch_array(MYSQLI_ASSOC)) {
      $value = $this->findObjectByKey($m['lang_key'], $object_default);
      $m["lang_value_default"] = $value;
      $res[] = $m;
    }
    return $res;
  }

  function getTranslationByLang($lang)
  {
    $res = array();
    $result =  $this->getAllQuery("SELECT * FROM $this->table WHERE lang='$lang'");
    while ($m = $result->fetch_array(MYSQLI_ASSOC)) {
      $res[] = $m;
    }
    //print_r(count($res)." / ");
    return $res;
  }

  function insert()
  {
    $sql = "INSERT INTO $this->table ( title,code, title_native, app_lang_code,rtl,status) 
      VALUES 
      ( '$this->title','$this->code' ,'$this->title_native','$this->app_lang_code', $this->rtl ,$this->status)";

    try {
      $this->query($sql);
      $_SESSION['success'] = "<b>DONE!! </b> The new language has been added.";
      echo '<script> window.location.href = "index.php?page=languages&success"; </script>';
    } catch (Exception $e) {
      $_SESSION['error'] = "Page not add";
    }
  }

  function update()
  {
    $sql = "UPDATE $this->table SET title = '$this->title', code = '$this->code' , app_lang_code = '$this->app_lang_code' , rtl = $this->rtl  , status = $this->status WHERE id='$this->id'";
    try {
      $this->query($sql);
      $_SESSION['success'] = "<b>DONE!! </b> The language has been updated.";
      echo '<script> window.location.href = "index.php?page=languages&success"; </script>';
    } catch (Exception $e) {
      $_SESSION['error'] = "Page not updated";
    }
  }

  function delete()
  {
    $sql = "DELETE FROM $this->table WHERE id='$this->id'";
    try {
      $this->query($sql);
      $_SESSION['success'] = "<b>DELETED!! </b> The language has been deleted.";
    } catch (Exception $e) {
      $_SESSION['error'] = " Page not deleted";
    }
  }


  function enable()
  {
    try {
      $item = $this->getById($this->id);
      $val = '1';
      if ($item["rtl"] == '1') {
        $val = '0';
      }
      $sql = "UPDATE $this->table SET  rtl='$val'  WHERE id='$this->id'";
      $this->query($sql);
      $_SESSION['success'] = "<b>DONE!! </b> The RTL has been enable.";
    } catch (Exception $e) {
      $_SESSION['error'] = " Language not enable";
    }
  }

  function save($key, $value, $lang)
  {
    $sql = "UPDATE $this->table SET 
    lang_value = '$value'
    WHERE lang_key='$key' and lang='$lang' ";
    $this->query($sql);
  }

  function updateTranslation($request = null)
  {
    try {
      foreach ($request as $key => $value) {
        $this->save($key, $value, $_GET['lang']);
      }
      $_SESSION['success'] = "<b>DONE!! </b> The Translation has been updated.";
    } catch (Exception $e) {
      $_SESSION['error'] = " Traslations not updated";
    }
  }


  function saveTranslationByLang($lang, $type = 'insert')
  {
    $appsettings = new AppSettings();
    $languages = new Languages();
    $default_id = $appsettings->getValueData('default_language');
    $data =  $languages->getById($default_id);
    $default_lang =  $data["app_lang_code"];

    $result_default =  $this->getAllQuery("SELECT * FROM $this->table WHERE lang='$default_lang'");

    while ($m = $result_default->fetch_array()) {

      if ($type == 'insert') {
        $sql = "INSERT INTO $this->table ( lang, lang_key, lang_value ) 
        VALUES 
        ( '$lang', '" . $m['lang_key'] . "', '" . $m['lang_value'] . "' )";
      } else {
        $sql = "UPDATE $this->table SET 
         lang_value = '" . $m['lang_value'] . "' 
         WHERE lang_key='" . $m['lang_key'] . "' and lang='$lang' ";
      }

      try {
        $this->query($sql);
      } catch (Exception $e) {
      }
    }
  }
}
