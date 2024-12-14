<?php
if (is_file("../config/DBClass.php")) {
  require_once("../config/DBClass.php");
} else {
  require_once("../../config/DBClass.php");
}

class Socials extends DBClass
{
  private $table = "social";

  private $id;
  private $title;
  private $link_url;
  private $id_app = "";
  private $icon;
  private $url;
  private $status;


  function checkTable()
  {
    try {
      $sql = "CREATE TABLE IF NOT EXISTS `social` (
        `id` int(11) NOT NULL,
        `title` varchar(255) NOT NULL,
        `link_url` varchar(255) NOT NULL,
        `id_app` varchar(255) NOT NULL,
        `icon` text NOT NULL,
        `url` text NOT NULL,
        `status` tinyint(1) NOT NULL DEFAULT 1,
        `date` datetime NOT NULL DEFAULT current_timestamp()
      ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
    ";

      if ($this->query($sql)) {

        $sql = "ALTER TABLE `social`
          ADD PRIMARY KEY (`id`);
        ";
        $this->query($sql);

        $sql = "ALTER TABLE `social`
          MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
          COMMIT;
        ";

        $this->query($sql);

        $sql = "INSERT INTO `social` (`id`, `title`, `link_url`, `id_app`, `icon`, `url`, `status`, `date`) VALUES
        (1, 'Facebook', 'fb://page/id_app', '590628830966605', 'social_item_1.png', 'https://www.facebook.com/id_app', 1, '2020-05-28 17:29:25'),
        (2, 'Youtube', 'https://www.youtube.com/channel/id_app', 'UCvHPU0LieqpqD8eKj2VypPg', 'social_item_2.png', 'https://www.youtube.com/channel/id_app', 1, '2020-05-28 17:46:15'),
        (3, 'Skype', 'skype:id_app?chat', '', 'social_item_3.png', 'skype:id_app?chat', 0, '2020-05-28 17:51:11'),
        (4, 'Twitter', 'https://twitter.com/id_app', '', 'social_item_4.png', 'https://twitter.com/id_app', 0, '2020-05-28 17:51:27'),
        (5, 'WhatsApp', 'whatsapp://send?phone=id_app', '', 'social_item_5.png', 'whatsapp://send?phone=id_app', 0, '2020-05-28 17:51:52'),
        (6, 'Snapchat', 'snapchat://add/id_app', '', 'social_item_6.png', 'https://www.snapchat.com/download', 0, '2020-05-28 17:52:40'),
        (7, 'Messanger', 'https://www.messenger.com/t/id_app', '', 'social_item_7.png', 'https://www.messenger.com/t/id_app', 0, '2020-05-28 17:53:04'),
        (8, 'Instagram', 'instagram://user?username=id_app', 'envato', 'social_item_8.png', 'https://www.instagram.com/id_app', 1, '2020-05-28 17:59:59');
        ";

        $this->query($sql);

      }
    } catch (Exception $e) {
      $_SESSION['error'] = "Social not exist";
    }
  }

  function getAllQuery($req){ 
    return $this->query($req);
  }

  function setParams($data_array = null, $data_files = null)
  {
    if (isset($data_array) && is_array($data_array)) {
      if (isset($data_array['id']))
        $this->id = $data_array['id'];
      if (isset($data_array['title']))
        $this->title = $data_array['title'];
      if (isset($data_array['link_url']))
        $this->link_url = $data_array['link_url'];
      if (isset($data_array['id_app']))
        $this->id_app = $data_array['id_app'];
      if (isset($data_array['url']))
        $this->url = $data_array['url'];
      if (isset($data_array['status'])) {
        $this->status = $data_array['status'] == "on";
      } else {
        $this->status = 0;
      }
    }


    if (isset($data_files) && is_array($data_files)) {
      if (isset($data_files['image']))
        $this->icon = $data_files['image'];
    }
  }


  function getLast()
  { 
    $path = str_replace("controllers", "", (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] .'/'. substr(__DIR__, strlen($_SERVER['DOCUMENT_ROOT'])));

    $res = array();
    $result =  $this->getAllQuery("SELECT * FROM $this->table ORDER BY id desc limit 5");
    while($s = $result->fetch_array(MYSQLI_ASSOC)){
      $m["icon_url"] = "{$path}images/social/{$s['icon']}";
      $res[]=$s;
    } 

    return $res;
  }


  function getAll()
  { 
  
    $path = str_replace("controllers", "", (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] .'/'. substr(__DIR__, strlen($_SERVER['DOCUMENT_ROOT'])));

    $res = array();
    $result =  $this->getAllQuery("SELECT * FROM $this->table");
    while($s = $result->fetch_array(MYSQLI_ASSOC)){
      $m["icon_url"] = "{$path}images/social/{$s['icon']}";
      $res[]=$s;
    } 

    return $res;
  }

  
  function getAllEnable()
  { 
    $path = str_replace("controllers", "", (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] .'/'. substr(__DIR__, strlen($_SERVER['DOCUMENT_ROOT'])));

    $res = array();
    $result =  $this->query("SELECT * FROM $this->table WHERE status=1");
    while($s = $result->fetch_array(MYSQLI_ASSOC)){
      $s["icon_url"] = "{$path}images/social/{$s['icon']}";
      $res[]=$s;
    }

    return $res;




    /*
    $path = str_replace("controllers", "", (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] .'/'. substr(__DIR__, strlen($_SERVER['DOCUMENT_ROOT'])));
    $arr = $this->fetchArray($this->query("SELECT * FROM $this->table WHERE status=1"));
    $arr["icon_url"] = "{$path}images/social/{$arr['icon']}"; 
    //$arr["icon_url_base64"] = base64_encode(file_get_contents($arr["icon_url"] ));
    return $arr;
    */


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
 
      $sql = "UPDATE $this->table SET id_app= '$this->id_app', status= '$this->status'  WHERE id='$this->id'";
      try {
        $this->query($sql);
        $_SESSION['success'] = "<b>DONE!! </b> The social has been updated.";
        echo '<script> window.location.href = "index.php?page=social&success"; </script>';
      } catch (Exception $e) {
        $_SESSION['error'] = "Social not updated";
      }
    }
  } 

}
