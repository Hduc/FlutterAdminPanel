<?php
if (is_file("../config/DBClass.php")) {
  require_once("../config/DBClass.php");
} else { 
  require_once("../../config/DBClass.php");
} 

require_once "app_settings.php";
  
class Notification extends DBClass
{
  private $table = "notification";

  private $id; 
  private $title;
  private $content; 
  private $url;  
  private $created_at;
  private $updated_at;

  function setParams($data_array = null, $data_files = null)
  {
    if (isset($data_array) && is_array($data_array)) {
      if (isset($data_array['id']))
        $this->id = $data_array['id'];  
      if (isset($data_array['title']))
        $this->title = $data_array['title']; 
        if (isset($data_array['content']))
          $this->content = $data_array['content'];  
      if (isset($data_array['url']))
        $this->url = $data_array['url'];  

      if (isset($data_array['created_at'])) {
        $this->created_at = $data_array['created_at'];
      }

      if (isset($data_array['updated_at'])) {
        $this->updated_at = $data_array['updated_at'];
      }
    } 
  }
  
  function getAllQuery($req){ 
    return $this->query($req);
  }

  function getAll()
  { 
    $arr = $this->getAllQuery("SELECT * FROM $this->table");
    return $arr;
  }

  function getPagination($offset,$nb)
  { 
    //$arr = $this->getAllQuery("SELECT * FROM $this->table LIMIT $offset, $nb");
    //return $arr;
 
    $res = array();
    $result =  $this->getAllQuery("SELECT * FROM $this->table ORDER BY id DESC LIMIT $offset, $nb");
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
 

  function send()
  { 

    $app_settings = new AppSettings();
    $s = $app_settings->getData();
    
 
    $heading = array(
		"en" => $_POST["title"]
	);

	$content = array(
		"en" => $_POST["message"]
	);

	$fields = array(
		'app_id' => $s["onesignal_id"],
		'included_segments' => array('All'),  
    //'include_player_ids' => array("xxxxx-xxxxx-xxxxx-xxxxx-xxxxxxxxxx"),
		'data' => array(
			"url" => $_POST['url']
		),
		'headings' => $heading,
		'contents' => $content
	);

	if (isset($_FILES['image']) && substr($_FILES['image']['type'], 0, 5) == "image") {
		$path = str_replace("views/notification", "", (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] .'/'. substr(__DIR__, strlen($_SERVER['DOCUMENT_ROOT'])));
	  $path =str_replace("controllers", "",$path  );
		move_uploaded_file($_FILES['image']['tmp_name'], "../images/onesignal/onesignal.png");
		$url = "{$path}images/onesignal/onesignal.png"; 
 	  $fields['chrome_web_image'] = $url;
		$fields['big_picture'] = $url;
    $fields['ios_attachments'] = $url; 
	}

	$fields = json_encode($fields);

  //INSTALL FLYWEB
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/json; charset=utf-8',
		'Authorization: Basic ' . $s["onesignal_api_key"] 
	));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_HEADER, FALSE);
	curl_setopt($ch, CURLOPT_POST, TRUE);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

	$response = curl_exec($ch);
	curl_close($ch);

	$_SESSION['success'] = "<b>DONE!! </b> Notification sent.";
  
	$return["allresponses"] = $response;
	$return = json_encode($return);

	$data = json_decode($response, true); 
	$id = $data['id'];  
   
    $message = $_POST["message"];
    $title = $_POST["title"];
    $url = $_POST['url'];
    $_SESSION['success'] = "<b>DONE!! </b> Notification sent.";
      $sql = "INSERT INTO $this->table (title,content,url,created_at,updated_at) 
      VALUES 
      ('$title','$message','$url',now() ,now() )";  
      try {
        $this->query($sql);
        $_SESSION['success'] = "<b>DONE!! </b> The notification sent.";
        echo '<script> window.location.href = "index.php?page=notification_send&success"; </script>';
      } catch (Exception $e) {
        $_SESSION['error'] = "Notification not sent";
      } 
  } 


  function delete()
  {
    $sql = "DELETE FROM $this->table WHERE id='$this->id'";
    try {
      $this->query($sql);
      $_SESSION['success'] = "<b>DELETED!! </b> The notification has been deleted.";
    } catch (Exception $e) {
      $_SESSION['error'] = " notification not deleted";
    }
  }


  function delete_all()
  {
    $sql = "DELETE FROM $this->table ";
    try {
      $this->query($sql);
      $_SESSION['success'] = "<b>DELETED!! </b> The notification has been deleted.";
    } catch (Exception $e) {
      $_SESSION['error'] = " notification not deleted";
    }
  }
 
}
