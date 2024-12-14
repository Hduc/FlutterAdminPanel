<?php

if (is_file("../config/DBClass.php")) {
  require_once("../config/DBClass.php");
} else {

  require_once("./config/DBClass.php");
}

class Users extends DBClass
{
  private $table = "users";

  private $first_name;
  private $last_name;
  private $email;
  private $password;
  private $picture;
  function setParams($data_array = null, $data_files = null)
  {
    if (isset($data_array) && is_array($data_array)) {
      if (isset($data_array['id'])) {
        $this->id = $data_array['id'];
      }
    }
    if (isset($data_array) && is_array($data_array)) {
      if (isset($data_array['email'])) {
        $this->email = $data_array['email'];
      }
    }
    if (isset($data_array) && is_array($data_array)) {
      if (isset($data_array['password'])) {
        $this->password = $data_array['password'];
      }
    }
    if (isset($data_array) && is_array($data_array)) {
      if (isset($data_array['first_name'])) {
        $this->first_name = $data_array['first_name'];
      }
    }
    if (isset($data_array) && is_array($data_array)) {
      if (isset($data_array['last_name'])) {
        $this->last_name = $data_array['last_name'];
      }
    }

    if (isset($data_files) && is_array($data_files)) {
      if (isset($data_files['image']))
        $this->picture = $data_files['image'];
    }
  }

  function login()
  {
    $sql = "SELECT * FROM $this->table WHERE email='$this->email' ";

    if ($this->numRows($this->query($sql)) > 0) {
      $user = $this->fetchArray($this->query($sql));
      $pass  = crypt($this->password, 'crypthash');
      $verif = $user["password"];

      if ($this->hash_equals($pass, $verif)) {
        return $user;
      } else
        return false;
    } else {
      return false;
    }
  }

  function getById($id)
  {
    $this->id = $id;
    $sql = "SELECT * FROM $this->table WHERE id='$this->id'";
    return $this->fetchArray($this->query($sql));
  }

  function getFirst()
  {
    $sql = "SELECT * FROM $this->table LIMIT 1";
    return $this->fetchArray($this->query($sql));
  }

  function update()
  {

    $erreur = "";


    if ($erreur == "") {

      $image = "user_" . $this->id . ".png";
      if (isset($this->picture) && substr($_FILES['image']['type'], 0, 5) == "image") {
        move_uploaded_file($_FILES['image']['tmp_name'], "../images/users/user_" . $this->id . ".png");
      }
      $sql = "UPDATE $this->table SET email = '$this->email', first_name= '$this->first_name', last_name= '$this->last_name', picture= '$image' WHERE id='$this->id'";
      try {
        $this->query($sql);
        echo '<script> window.location.href = "index.php?page=profile&success"; </script>';
        $_SESSION['success'] = "<b>DONE!! </b> Profile has been updated.";
      } catch (Exception $e) {
        $_SESSION['error'] = " Profile not updated";
      }
    }
  }

  function changePassword()
  {

    $erreur = "";

    if ($erreur == "") {
      $pass  = crypt($this->password, 'crypthash');

      $sql = "UPDATE $this->table SET password = '$pass' WHERE id='$this->id'";
      try {
        $this->query($sql);
        echo '<script> window.location.href = "index.php?page=profile&success"; </script>';
        $_SESSION['success'] = "<b>DONE!! </b> Profile has been updated.";
      } catch (Exception $e) {
        $_SESSION['error'] = " Profile not updated";
      }
    }
  }

  function hash_equals($str1, $str2)
    {
        if(strlen($str1) != strlen($str2))
        {
            return false;
        }
        else
        {
            $res = $str1 ^ $str2;
            $ret = 0;
            for($i = strlen($res) - 1; $i >= 0; $i--)
            {
                $ret |= ord($res[$i]);
            }
            return !$ret;
        }
    }

}
