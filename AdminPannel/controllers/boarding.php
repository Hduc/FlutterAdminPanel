<?php
if (is_file("../config/DBClass.php")) {
  require_once("../config/DBClass.php");
} else {
  require_once("../../config/DBClass.php");
}

class Boarding extends DBClass
{

  private $table = "boarding";
  private $id;
  private $image;
  private $title;
  private $description;
  private $status;

  function setParams($data_array = null, $data_files = null)
  {
    if (isset($data_array) && is_array($data_array)) {
      if (isset($data_array['id']))
        $this->id = $data_array['id'];
      if (isset($data_array['title']))
        $this->title = $data_array['title'];
      if (isset($data_array['description']))
        $this->description = $data_array['description'];
      if (isset($data_array['status'])) {
        $this->status = $data_array['status'] == "on";
      } else {
        $this->status = 0;
      }
    }
    if (isset($data_files) && is_array($data_files)) {
      if (isset($data_files['image']))
        $this->image = $data_files['image'];
    }
  }

  function getLast()
  {
    $path = str_replace("controllers", "", (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/' . substr(__DIR__, strlen($_SERVER['DOCUMENT_ROOT'])));

    $res = array();
    $result =  $this->getAllQuery("SELECT * FROM $this->table ORDER BY id desc limit 5");
    while ($m = $result->fetch_array(MYSQLI_ASSOC)) {
      $m["image_url"] = "{$path}images/boarding/{$m['image']}";
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
      $m["image_url"] = "{$path}images/boarding/{$m['image']}";
      $res[] = $m;
    }
    return $res;
  }

  function getAllEnable()
  {
    $path = str_replace("controllers", "", (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/' . substr(__DIR__, strlen($_SERVER['DOCUMENT_ROOT'])));
    $res = array();
    $result =  $this->getAllQuery("SELECT * FROM $this->table WHERE status=1");
    while ($m = $result->fetch_array(MYSQLI_ASSOC)) {
      $m["image_url"] = "{$path}images/boarding/{$m['image']}";
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
    $erreur = "";
    if ($erreur == "") {
      $max = $this->fetchRow($this->query("SELECT max(id) as max FROM $this->table"));
      $id = $max[0] + 1;

      $image = "default.png";
      if (isset($this->image) && substr($_FILES['image']['type'], 0, 5) == "image") {
        $image = "boarding_item_" . $id . ".png";
        move_uploaded_file($_FILES['image']['tmp_name'], "../images/boarding/boarding_item_" . $id . ".png");
      }
      $sql = "INSERT INTO $this->table (id,title,description, image, status) 
      VALUES 
      ('$id','$this->title','$this->description','$image', $this->status)";

      try {
        $this->query($sql);
        $_SESSION['success'] = "<b>DONE!! </b> The new boarding has been added.";
        echo '<script> window.location.href = "index.php?page=boarding&success"; </script>';
      } catch (Exception $e) {
        $_SESSION['error'] = "Boarding not add";
        die;
      }
    }
  }

  function update()
  {
    $erreur = "";
    if ($erreur == "") {
      $image = "boarding_item_" . $this->id . ".png";
      if (isset($this->image) && substr($_FILES['image']['type'], 0, 5) == "image") {
        move_uploaded_file($_FILES['image']['tmp_name'], "../images/boarding/boarding_item_" . $this->id . ".png");
      }
      $sql = "UPDATE $this->table SET title = '$this->title', description= '$this->description', image= '$image' ,status= '$this->status'  WHERE id='$this->id'";
      try {
        $this->query($sql);
        $_SESSION['success'] = "<b>DONE!! </b> The boarding has been updated.";
        echo '<script> window.location.href = "index.php?page=boarding&success"; </script>';
      } catch (Exception $e) {
        $_SESSION['error'] = "Boarding not updated";
      }
    }
  }

  function delete()
  {
    $sql = "DELETE FROM $this->table WHERE id='$this->id'";
    try {
      $this->query($sql);
      $_SESSION['success'] = "<b>DELETED!! </b> The boarding has been deleted.";
    } catch (Exception $e) {
      $_SESSION['error'] = " Boarding not deleted";
    }
  }
}
