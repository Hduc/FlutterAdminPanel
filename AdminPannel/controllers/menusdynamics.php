<?php
if (is_file("../config/DBClass.php")) {
  require_once("../config/DBClass.php");
} else {

  require_once("../../config/DBClass.php");
}

class MenuDynamics extends DBClass
{
  private $table = "menu_dynamics";

  private $id;
  private $title;
  private $name;
  private $label;
  private $type = "url";
  private $type_menu = "url";
  private $icon;
  private $url;
  private $status;
  private $parent_id;

  function setParams($data_array = null, $data_files = null)
  {
    if (isset($data_array) && is_array($data_array)) {
      if (isset($data_array['id']))
        $this->id = $data_array['id'];
      if (isset($data_array['label']))
        $this->label = $data_array['label'];
      if (isset($data_array['name']))
        $this->name = $data_array['name'];
      if (isset($data_array['title']))
        $this->title = $data_array['title'];
      if (isset($data_array['type']))
        $this->type = $data_array['type'];
      if (isset($data_array['type_menu']))
        $this->type_menu = $data_array['type_menu'];
      if (isset($data_array['url']))
        $this->url = $data_array['url'];
      if (isset($data_array['status'])) {
        $this->status = $data_array['status'] == "on";
      } else {
        $this->status = 0;
      }
      if (isset($data_array['parent_id']))
        $this->id = $data_array['parent_id'];
    }

    if (isset($data_files) && is_array($data_files)) {
      if (isset($data_files['image']))
        $this->icon = $data_files['image'];
    }
  }

  function getLast()
  {
    $path = str_replace("controllers", "", (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/' . substr(__DIR__, strlen($_SERVER['DOCUMENT_ROOT'])));

    $res = array();
    $result =  $this->getAllQuery("SELECT * FROM $this->table ORDER BY id desc limit 5");
    while ($m = $result->fetch_array(MYSQLI_ASSOC)) {
      $m["icon_url"] = "{$path}images/menu/{$m['icon']}";
      $res[] = $m;
    }

    return $res;
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
    while ($m = $result->fetch_array(MYSQLI_ASSOC)) {
      $m["icon_url"] = "{$path}images/menu/{$m['icon']}";
      $res[] = $m;
    }

    return $res;
  }

  function getAllEnable()
  {
    $path = str_replace("controllers", "", (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/' . substr(__DIR__, strlen($_SERVER['DOCUMENT_ROOT'])));

    $res = array();
    $result =  $this->getAllQuery("SELECT * FROM $this->table WHERE status=1 ORDER BY position ASC ");
    while ($s = $result->fetch_array(MYSQLI_ASSOC)) {
      $s["icon_url"] = "{$path}images/menu/{$s['icon']}";
      $s["translation"] = $this->getTranslationByLang($s["id"]);
      $res[] = $s;
    }

    return $res;
  }

  function getAllMenuDynamic($parent_id)
  {
    $path = str_replace("controllers", "", (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/' . substr(__DIR__, strlen($_SERVER['DOCUMENT_ROOT'])));

    $res = array();
    $result =  $this->getAllQuery("SELECT * FROM $this->table WHERE parent_id=$parent_id ORDER BY id ASC");
    while ($s = $result->fetch_array(MYSQLI_ASSOC)) {
      $s["icon_url"] = "{$path}images/menu/{$s['icon']}";
      $res[] = $s;
    }

    return $res;
  }
 

  function getAllMenuDynamicByPosition()
  {
    $path = str_replace("controllers", "", (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/' . substr(__DIR__, strlen($_SERVER['DOCUMENT_ROOT'])));

    $res = array();
    $result =  $this->getAllQuery("SELECT * FROM $this->table ORDER BY position ASC");
    while ($s = $result->fetch_array(MYSQLI_ASSOC)) {
      $s["icon_url"] = "{$path}images/menu/{$s['icon']}";
      $res[] = $s;
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
    $erreur = "";
    if ($erreur == "") {
      $max = $this->fetchRow($this->query("SELECT max(id) as max FROM $this->table"));
      $id = $max[0] + 1;
      $image = "default.png";

      if (isset($this->icon) && substr($_FILES['image']['type'], 0, 5) == "image") {
        $image = "menu_item_" . $id . ".png";
        move_uploaded_file($_FILES['image']['tmp_name'], "../images/menu/menu_item_" . $id . ".png");
      }
      $sql = "INSERT INTO $this->table (id,label,type, icon,url,status) 
      VALUES 
      ('$id','$this->name','$this->type_menu','$image','$this->url','1')";
      try {
        $this->query($sql);
        $_SESSION['success'] = "<b>DONE!! </b> The new menu has been added.";
        echo '<script> window.location.href = "index.php?page=menudynamics&success"; </script>';
      } catch (Exception $e) {
        $_SESSION['error'] = " Menu not add";
      }
    }
  }

  function update()
  {

    $erreur = "";


    if ($erreur == "") {

      $image = "menu_item_" . $this->id . ".png";
      if (isset($this->icon) && substr($_FILES['image']['type'], 0, 5) == "image") {
        move_uploaded_file($_FILES['image']['tmp_name'], "../images/menu/menu_item_" . $this->id . ".png");
      }
      $sql = "UPDATE $this->table SET label = '$this->title', icon= '$image', url= '$this->url',status= '$this->status'  WHERE id='$this->id'";
      //print_r($sql);
      try {
        $this->query($sql);
        $_SESSION['success'] = "<b>DONE!! </b> The menu has been updated.";
        echo '<script> window.location.href = "index.php?page=menudynamics&success"; </script>';
      } catch (Exception $e) {
        $_SESSION['error'] = " Menu not updated";
      }
    }
  }

  function delete()
  {
    $sql = "DELETE FROM $this->table WHERE id='$this->id'";
    try {
      $this->query($sql);
      $_SESSION['success'] = "<b>DELETED!! </b> The menu has been deleted.";
    } catch (Exception $e) {
      $_SESSION['error'] = " Menu not deleted";
    }
  }

  function save($menu, $files)
  {
    $array_menu = json_decode($menu, true);
    //$this->query("TRUNCATE TABLE $this->table ");

    foreach ($array_menu as $index => $value) {
      $id = $value['id'];
      $sql = "UPDATE $this->table SET position = '$index' WHERE id='$id'";
      $this->query($sql);
    }
    //$this->updateMenu($array_menu);
  }

  function updateMenu($menu, $parent = 0)
  {
    print_r($menu);
    try {
      //print_r($_FILES["answers_images"]);
      if (!empty($menu)) {


        foreach ($menu as $value) {

          $label = $value['label'];
          $url = (empty($value['url'])) ? '' : $value['url'];
          $type = $value['type'];
          $old = $value['old'];
          $icon = $value['icon'];

          $imagebase64 = $value['imagebase64'];
          $image = $value['icon'];

          $max = $this->fetchRow($this->query("SELECT max(id) as max FROM $this->table"));
          $last_id = $max[0] + 0;

          //print_r($value);
          //echo ($icon);
          if ($type == "url" &&  substr($_FILES['answers_images']['type'][$last_id], 0, 5) == "image") {
            $image = "menu_item_" . $last_id . ".png";
            move_uploaded_file($_FILES['answers_images']['tmp_name'][$last_id], "../images/menu/menu_item_" . $last_id . ".png");
          }
          //$sql = "INSERT INTO $this->table (label, url, type, base64,parent_id) VALUES ('$label', '$url', '$type', '$icon', $parent)";
          $sql = "INSERT INTO $this->table (label, url, type, base64,  parent_id) VALUES ('$label', '$url', '$type', '$imagebase64', $parent)";

          //echo ($sql);
          $this->query($sql);
          $id = $this->lastInsertedID();

          if (array_key_exists('children', $value))
            $this->updateMenu($value['children'], $id);
        }
      }
    } catch (Exception $e) {
      echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
  }


  function getByLang($lang)
  {
    $sql = "SELECT * FROM `menu_translations` WHERE lang='$lang' and menu_id='" . $_REQUEST['id'] . "'";
    return $this->fetchArray($this->query($sql));
  }

  function updateTranslation()
  {
    $erreur = "";
    if ($erreur == "") {
      $sql = "UPDATE `menu_translations` SET `title` = '$this->title', `url` = '$this->url' , updated_at = now() WHERE lang='" . $_REQUEST['lang'] . "' and menu_id='" . $_REQUEST['id'] . "'   ";
      try {
        if ($this->query($sql)) {
          if ($this->affected_rows() == 0) {
            $sql_ = "INSERT INTO `menu_translations` ( `menu_id`, `title`, `url`, `lang`  ) VALUES ( '" . $_REQUEST['id'] . "', '$this->title', '$this->url', '" . $_REQUEST['lang'] . "') ";
            $this->query($sql_);
          }
        }
        $_SESSION['success'] = "<b>DONE!! </b> The tab has been updated.";
        echo '<script> window.location.href = "index.php?page=menudynamics_translation&id=' . $this->id . '&lang=' . $_REQUEST['lang'] . '&success"; </script>';
      } catch (Exception $e) {
        $_SESSION['error'] = " Tab not updated";
      }
    }
  }

  function getTranslationByLang($menu_id)
  {
    $res = array();
    $result =  $this->getAllQuery("SELECT * FROM `menu_translations`  WHERE menu_id='$menu_id'");
    while ($m = $result->fetch_array(MYSQLI_ASSOC)) {
      $res[] = $m;
    }
    return $res;
  }
}
