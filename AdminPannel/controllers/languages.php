<?php
if (is_file("../config/DBClass.php")) {
  require_once("../config/DBClass.php");
} else {
  require_once("../../config/DBClass.php");
}
require_once "translations.php";

class Languages extends DBClass
{

  private $table = "languages";
  private $id;
  private $title;
  private $title_native;
  private $code;
  private $app_lang_code;
  private $rtl;
  private $status;
  private $created_at;
  private $updated_at;

  function setParams($data_array = null, $data_files = null)
  {
    if (isset($data_array) && is_array($data_array)) {
      if (isset($data_array['id']))
        $this->id = $data_array['id'];
      if (isset($data_array['title']))
        $this->title = $data_array['title'];
      if (isset($data_array['title_native']))
        $this->title_native = $data_array['title_native'];
      if (isset($data_array['code']))
        $this->code = $data_array['code'];
      if (isset($data_array['app_lang_code']))
        $this->app_lang_code = $data_array['app_lang_code'];
      if (isset($data_array['rtl']))
        $this->rtl = $data_array['rtl'];
      if (isset($data_array['status'])) {
        $this->status = $data_array['status'];
      } else {
        $this->status = 0;
      }
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

  function getAll()
  {
    $res = array();
    $result =  $this->getAllQuery("SELECT * FROM $this->table");
    while ($m = $result->fetch_array(MYSQLI_ASSOC)) {
      $res[] = $m;
    }
    return $res;
  }
  
  function getTranslationByLang($lang)
  {
    $res = array();
    $result =  $this->getAllQuery("SELECT * FROM translations WHERE lang='$lang'");
    while ($m = $result->fetch_array(MYSQLI_ASSOC)) {
      $res[] = $m;
    }
    //print_r(count($res)." / ");
    return $res;
  }

  function getAllEnable()
  {

    // $translations = new Translations();
    $res = array();
    $result =  $this->getAllQuery("SELECT * FROM $this->table WHERE status=1");
    while ($m = $result->fetch_array(MYSQLI_ASSOC)) {
      $m["translations"] = $this->getTranslationByLang($m["app_lang_code"]);
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

  function insert()
  {
    $translations = new Translations();
    $sql = "INSERT INTO $this->table ( title,code, title_native, app_lang_code,rtl,status) 
      VALUES ( '$this->title','$this->code' ,'$this->title_native','$this->app_lang_code', $this->rtl ,$this->status)";

    try {
      $this->query($sql);
      $translations->saveTranslationByLang($this->app_lang_code, 'insert');
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
}
