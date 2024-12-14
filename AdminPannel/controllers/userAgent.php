<?php
if (is_file("../config/DBClass.php")) {
  require_once("../config/DBClass.php");
} else {

  require_once("../../config/DBClass.php");
}

class UserAgent extends DBClass
{
  private $table = "useragent";

  private $id;
  private $title;
  private $value_android;
  private $value_ios;
  private $status; 

  function setParams($data_array = null, $data_files = null)
  {
    if (isset($data_array) && is_array($data_array)) {
      if (isset($data_array['id']))
        $this->id = $data_array['id'];
      if (isset($data_array['title']))
        $this->title = $data_array['title'];
      if (isset($data_array['value_android']))
        $this->value_android = $data_array['value_android'];
      if (isset($data_array['value_ios']))
        $this->value_ios = $data_array['value_ios'];
      if (isset($data_array['status'])) {
        $this->status = $data_array['status'] == "on";
      } else {
        $this->status = 0;
      } 
      if (isset($data_array['created_at'])) {
        $this->created_at = $data_array['created_at'] ;
      }
      if (isset($data_array['updated_at'])) {
        $this->updated_at = $data_array['updated_at']  ;
      }
      
    }
  }

  function getAllQuery($req)
  {
    return $this->query($req);
  }

  function getAll()
  {
    $path = str_replace("controllers", "", (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] .'/'. substr(__DIR__, strlen($_SERVER['DOCUMENT_ROOT'])));
    $res = array();
    $result =  $this->getAllQuery("SELECT * FROM $this->table");
    while ($s = $result->fetch_array(MYSQLI_ASSOC)) {
      //$m["icon_url"] = "{$path}images/right_navigation_icon/{$s['icon']}";
      $res[] = $s;
    }
    return $res;
  }

  function getAllEnable()
  {
    $path = str_replace("controllers", "", (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] .'/'. substr(__DIR__, strlen($_SERVER['DOCUMENT_ROOT'])));
    $res = array();
    $result =  $this->getAllQuery("SELECT * FROM $this->table WHERE status=1");
    while ($s = $result->fetch_array(MYSQLI_ASSOC)) {
      //$s["icon_url"] = "{$path}images/right_navigation_icon/{$s['icon']}";
      $res[] = $s;
    }
    return $res[0];
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
      //$image = "default.png"; 
      $sql = "INSERT INTO $this->table (id,title,value_android, value_ios,status) 
      VALUES 
      ('$id','$this->title','$this->value_android','$this->value_ios',$this->status)"; 
      try {
        $this->query($sql); 
        $_SESSION['success'] = "<b>DONE!! </b> The new User-Agent has been added.";
        echo '<script> window.location.href = "index.php?page=useragent&success"; </script>';
      } catch (Exception $e) { 
        $_SESSION['error'] = " User-Agent not add";
      }
    }
  }

  function update()
  {
    $erreur = "";
    if ($erreur == "") {
      $sql = "UPDATE $this->table SET title = '$this->title', value_android= '$this->value_android', value_ios= '$this->value_ios'  WHERE id='$this->id'";
      try {
        $this->query($sql);
        $_SESSION['success'] = "<b>DONE!! </b> The User-Agent has been updated.";
        echo '<script> window.location.href = "index.php?page=useragent&success"; </script>';
      } catch (Exception $e) {
        $_SESSION['error'] = " User-Agent not updated";
      }
    }
  }

  function delete()
  {
    $sql = "DELETE FROM $this->table WHERE id='$this->id'";
    try {
      $this->query($sql);
      $_SESSION['success'] = "<b>DELETED!! </b> The User-Agent has been deleted.";
    } catch (Exception $e) {
      $_SESSION['error'] = " User-Agent not deleted";
    }
  }

  function enable()
  {
    try {
      $sql = "UPDATE $this->table SET  status= '0' ";
      $this->query($sql);
      $sql = "UPDATE $this->table SET  status= '1'  WHERE id='$this->id'";
      $this->query($sql);
      $_SESSION['success'] = "<b>DONE!! </b> User-Agent has been enable.";
    } catch (Exception $e) {
      $_SESSION['error'] = " User-Agent not enable";
    }
  }
}
