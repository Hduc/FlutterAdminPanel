<?php
if (is_file("../config/DBClass.php")) {
  require_once("../config/DBClass.php");
} else {

  require_once("../../config/DBClass.php");
}

class Tab extends DBClass
{
  private $table = "tab";

  private $id;
  private $title;
  private $icon;
  private $url;
  private $created_at;
  private $updated_at;
  private $status;

  function setParams($data_array = null, $data_files = null)
  {
    if (isset($data_array) && is_array($data_array)) {
      if (isset($data_array['id']))
        $this->id = $data_array['id'];
      if (isset($data_array['title']))
        $this->title = $data_array['title'];
      if (isset($data_array['url']))
        $this->url = $data_array['url'];
      if (isset($data_array['created_at'])) {
        $this->created_at = $data_array['created_at'];
      }
      if (isset($data_array['status'])) {
        $this->status = $data_array['status'] == "on";
      } else {
        $this->status = 0;
      }

      if (isset($data_array['updated_at'])) {
        $this->updated_at = $data_array['updated_at'];
      }
    }


    if (isset($data_files) && is_array($data_files)) {
      if (isset($data_files['image']))
        $this->icon = $data_files['image'];
    }
  }

  function getAllQuery($req)
  {
    return $this->query($req);
  }

  function getAll()
  {
    $path = str_replace("controllers", "", (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/' . substr(__DIR__, strlen($_SERVER['DOCUMENT_ROOT'])));

    $res = array();
    $result =  $this->getAllQuery("SELECT * FROM $this->table");
    while ($t = $result->fetch_array(MYSQLI_ASSOC)) {
      $t["icon_url"] = "{$path}images/tab/{$t['icon']}";
      $res[] = $t;
    }
    return $res;
  }


  function getAllEnable()
  {
    $path = str_replace("controllers", "", (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/' . substr(__DIR__, strlen($_SERVER['DOCUMENT_ROOT'])));

    $res = array();
    $result =  $this->getAllQuery("SELECT * FROM $this->table WHERE status=1");
    while ($t = $result->fetch_array(MYSQLI_ASSOC)) {
      $t["icon_url"] = "{$path}images/tab/{$t['icon']}";
      $t["translation"] = $this->getTranslationByLang($t["id"]);
      $res[] = $t;
    }
    return $res;
  }



  function getById($id)
  {
    $this->id = $id;
    $sql = "SELECT * FROM $this->table WHERE id='$this->id'";
    return $this->fetchArray($this->query($sql));
  }


  function update()
  {

    $erreur = "";

    if ($erreur == "") {
      $image = "tab_item_" . $this->id . ".png";
      if (isset($this->icon) && substr($_FILES['image']['type'], 0, 5) == "image") {
        move_uploaded_file($_FILES['image']['tmp_name'], "../images/tab/tab_item_" . $this->id . ".png");
      }

      $sql = "UPDATE $this->table SET icon= '$image',status= '$this->status' , updated_at = now() WHERE id='$this->id'"; 
      try {
        $this->query($sql);
        $_SESSION['success'] = "<b>DONE!! </b> The tab has been updated.";
        echo '<script> window.location.href = "index.php?page=tab_edit&id=' . $this->id . '&lang=' . $_REQUEST['lang'] . '&success"; </script>';
      } catch (Exception $e) {
        $_SESSION['error'] = " Tab not updated";
      }
    }
  }

  function updateTranslation()
  {
    $erreur = "";
    if ($erreur == "") {
      $sql = "UPDATE `tab_translations` SET `title` = '$this->title', `url` = '$this->url' , updated_at = now() WHERE lang='" . $_REQUEST['lang'] . "' and tab_id='" . $_REQUEST['id'] . "'   ";
      try {
        if ($this->query($sql)) {
          if ($this->affected_rows() == 0) {
            $sql_ = "INSERT INTO `tab_translations` ( `tab_id`, `title`, `url`, `lang`  ) VALUES ( '" . $_REQUEST['id'] . "', '$this->title', '$this->url', '" . $_REQUEST['lang'] . "') ";
            $this->query($sql_);
          }
        }
        $_SESSION['success'] = "<b>DONE!! </b> The tab has been updated.";
        echo '<script> window.location.href = "index.php?page=tab_edit&id=' . $this->id . '&lang=' . $_REQUEST['lang'] . '&success"; </script>';
      } catch (Exception $e) {
        $_SESSION['error'] = " Tab not updated";
      }
    }
  }

  function getByLang($lang)
  {
    $sql = "SELECT * FROM `tab_translations` WHERE lang='$lang' and tab_id='" . $_REQUEST['id'] . "'";
    return $this->fetchArray($this->query($sql));
  }

  function getTranslationByLang($tab_id)
  {
    $res = array();
    $result =  $this->getAllQuery("SELECT * FROM `tab_translations`  WHERE tab_id='$tab_id'");
    while ($m = $result->fetch_array(MYSQLI_ASSOC)) {
      $res[] = $m;
      //$res[$m['lang']] = $m; 
    }
    return $res;
  }
}
