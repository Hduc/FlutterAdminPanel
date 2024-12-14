<?php
if (is_file("../config/DBClass.php")) {
  require_once("../config/DBClass.php");
} else {
  require_once("../../config/DBClass.php");
} 

class NativeSocial extends DBClass
{

  private $table = "native_social";
  private $id;
  private $title;   
  private $status;

  function setParams($data_array = null, $data_files = null)
  {
    if (isset($data_array) && is_array($data_array)) {
      if (isset($data_array['id']))
        $this->id = $data_array['id'];
      if (isset($data_array['title']))
        $this->title = $data_array['title']; 
      if (isset($data_array['status'])) {
        $this->status = $data_array['status'] == "on";
      } else {
        $this->status = 0;
      }
    } 
  }

  function getLast()
  {  
    $res = array();
    $result =  $this->getAllQuery("SELECT * FROM $this->table ORDER BY id desc");
    while($m = $result->fetch_array(MYSQLI_ASSOC)){ 
      $res[]=$m;
    } 
    return $res;
  }

  function getAllQuery($req){ 
    return $this->query($req);
  } 
  
  function getAll()
  { 
    $res = array();
    $result =  $this->getAllQuery("SELECT * FROM $this->table");
    while($m = $result->fetch_array(MYSQLI_ASSOC)){ 
      $res[]=$m;
    } 
    return $res;
  }
 
  function getAllEnable()
  { 
    $res = array();
    $result =  $this->getAllQuery("SELECT * FROM $this->table WHERE status=1");
    while($m = $result->fetch_array(MYSQLI_ASSOC)){ 
      $res[]=$m["title"];
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
      $sql = "INSERT INTO $this->table (id,title,status) 
      VALUES 
      ('$id','$this->title',$this->status)";
      try {
        $this->query($sql);
        $_SESSION['success'] = "<b>DONE!! </b> The new native social has been added.";
        echo '<script> window.location.href = "index.php?page=nativesocial&success"; </script>';
      } catch (Exception $e) {
        $_SESSION['error'] = "Page not add";
      }
    }
  }

  function update()
  { 
    $erreur = ""; 
    if ($erreur == "") {  
      $sql = "UPDATE $this->table SET title = '$this->title', status= '$this->status'  WHERE id='$this->id'";
      try {
        $this->query($sql);
        $_SESSION['success'] = "<b>DONE!! </b> The native social has been updated.";
        echo '<script> window.location.href = "index.php?page=nativesocial&success"; </script>';
      } catch (Exception $e) {
        $_SESSION['error'] = "Native Social not updated";
      }
    }
  }

  function delete()
  {
    $sql = "DELETE FROM $this->table WHERE id='$this->id'";
    try {
      $this->query($sql);
      $_SESSION['success'] = "<b>DELETED!! </b> The native social has been deleted.";
    } catch (Exception $e) {
      $_SESSION['error'] = " Native social not deleted";
    }
  }
}
