<?php

require_once "../controllers/menusdynamics.php";
$menus = new MenuDynamics();

require_once "../controllers/app_settings.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST'  &&  isset($_POST['update_position_menu'])) { 
  $menus->save($_POST['menu'], $_FILES);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' &&  isset($_POST['insert_menu'])) {
  $menus->setParams($_POST, $_FILES);
  $menus->insert();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' &&  isset($_POST['delete_menu'])) {
  $menus->setParams($_POST, $_FILES);
  $menus->delete();
}

$types = array(
  array(
    'value' => 'url',
    'title' => 'URL'
  ),
  array(
    'value' => 'home',
    'title' => 'Home (redirection to Base URL)'
  ),
  array(
    'value' => 'share',
    'title' => 'Share'
  ),
  array(
    'value' => 'about',
    'title' => 'About'
  ),
  array(
    'value' => 'rate_us',
    'title' => 'Rate Us'
  ),
  array(
    'value' => 'languages',
    'title' => 'Languages'
  ),
  array(
    'value' => 'dark',
    'title' => 'Dark Mode'
  ),
  array(
    'value' => 'divider',
    'title' => 'Divider'
  ),
  array(
    'value' => 'title_block',
    'title' => 'Title Block'
  ),
  array(
    'value' => 'socials',
    'title' => 'List Socials'
  ),
  array(
    'value' => 'notification',
    'title' => 'List Notifications'
  )
);

function renderMenuItem($id, $label, $url, $type, $icon, $lang, $base64)
{

  $types = array(
    array(
      'value' => 'url',
      'title' => 'URL'
    ),
    array(
      'value' => 'home',
      'title' => 'Home (redirection to Base URL)'
    ),
    array(
      'value' => 'share',
      'title' => 'Share'
    ),
    array(
      'value' => 'about',
      'title' => 'About'
    ),
    array(
      'value' => 'rate_us',
      'title' => 'Rate Us'
    ),
    array(
      'value' => 'languages',
      'title' => 'Languages'
    ),
    array(
      'value' => 'dark',
      'title' => 'Dark Mode'
    ),
    array(
      'value' => 'divider',
      'title' => 'Divider'
    ),
    array(
      'value' => 'title_block',
      'title' => 'Title Block'
    ),
    array(
      'value' => 'socials',
      'title' => 'List Socials'
    ),
    array(
      'value' => 'notification',
      'title' => 'List Notifications'
    )
  );

  $key = 0;
  $title = $label;
  if ($type != 'url' && $type != 'title_block') {
    $key = array_search($type, array_column($types, 'value'));
    if ($key) {
      $title  = $types[$key]["title"];
    }
  }

  $menu =  '<li class="dd-item dd3-item" data-id="' . $id . '" data-label="' . $label . '" data-url="' . $url . '" data-type="' . $type . '" data-base64="false" data-old="true" data-imagebase64="' . $base64 . '" data-icon="' . $icon . '">' .
    '<div class="dd-handle dd3-handle" > Drag</div>' .
    '<div class="dd3-content"><span>' . $title . '</span>' .
    '<div class="item-edit">Edit</div>' .
    '</div>' .
    '<div class="item-settings d-none">';

  if ($type == 'url') {
    $menu  = $menu .
      '<div class="form-group col-xl-12 col-md-12 "><label for="">Navigation Label</label><input disabled class="form-control" type="text" name="navigation_label" value="' . $title . '"></div>' .
      '<div class="form-group col-xl-12 col-md-12 "><label for="">Navigation Url</label><input disabled class="form-control" type="text" name="navigation_url" value="' . $url . '"></div>' .
      '<div class="form-group col-xl-12 col-md-12 ">' .
      '<label for="image">Image</label><div class="input-group">' .
      '<img type="image"  style="width:70px" id="test-' . $id . '" src="../images/menu/' . $base64 . '"/>' .
      //'<input type="file"  style="display: none;">' .
      //'<input type="hiden" class="select_file_base64" name="answers_images_base64[]"  id="file-base64-' . $id . '" value="' . $base64 . '" style="display: none;">' .
      //'<input type="hiden" class="icon" name="icon"  id="icon" value="' . $icon . '" style="display: none;">' .
      '</div></div> ' .
      '<a href="index.php?page=menudynamics_translation&id=' . $id . '&lang=' .  $lang . '&title=' .  $title .  '" class="item-close btn btn-info btn-icon-split btn-sm mr-2">' .
      '<span class="icon text-white-50">' .
      '<i class="fas fa-language"></i>' .
      '</span>' .
      '<span class="text">Translation</span>' .
      '</a>' .
      //'<a href="javascript:;" class="item-close btn btn-info btn-icon-split btn-sm mr-2">' .
      //'<span class="icon text-white-50">' .
      //'<i class="fas fa-pencil-alt"></i>' .
      //'</span>' .
      //'<span class="text">Edit</span>' .
      //'</a>'.
      '';
  }

  if ($type == 'url_') {
    $menu  = $menu .
      '<div class="form-group col-xl-12 col-md-12 "><label for="">Navigation Label</label><input class="form-control" type="text" name="navigation_label" value="' . $title . '"></div>' .
      '<div class="form-group col-xl-12 col-md-12 "><label for="">Navigation Url</label><input class="form-control" type="text" name="navigation_url" value="' . $url . '"></div>' .
      '<div class="form-group col-xl-12 col-md-12 ">' .
      '<label for="image">Image</label><div class="input-group">' .
      '<input type="image"  class="add_image img-thumbnail" name="answers_images[]" style="width:70px" id="test-' . $id . '" src="../images/menu/' . $base64 . '">' .
      '<input type="file" class="select_file" name="answers_images[]"  id="file-' . $id . '" style="display: none;">' .
      '<input type="hiden" class="select_file_base64" name="answers_images_base64[]"  id="file-base64-' . $id . '" value="' . $base64 . '" style="display: none;">' .
      '<input type="hiden" class="icon" name="icon"  id="icon" value="' . $icon . '" style="display: none;">' .
      '</div></div> ' .
      '<a href="index.php?page=menudynamics_translation&id=' . $id . '&lang=' .  $lang . '&title=' .  $title .  '" class="item-close btn btn-info btn-icon-split btn-sm mr-2">' .
      '<span class="icon text-white-50">' .
      '<i class="fas fa-language"></i>' .
      '</span>' .
      '<span class="text">Translation</span>' .
      '</a>' .
      //'<a href="javascript:;" class="item-close btn btn-info btn-icon-split btn-sm mr-2">' .
      //'<span class="icon text-white-50">' .
      //'<i class="fas fa-pencil-alt"></i>' .
      //'</span>' .
      //'<span class="text">Edit</span>' .
      //'</a>'.
      '';
  }

  if ($type == 'title_block') {
    $menu  = $menu .
      '<div class="form-group col-xl-12 col-md-12 "><label for="">Tite </label><input disabled class="form-control" type="text" name="navigation_label" value="' . $title . '"></div>' .
      '<a href="index.php?page=menudynamics_translation&id=' . $id . '&lang=' .  $lang . '&title=' .  $title .  '" class="item-close btn btn-info btn-icon-split btn-sm mr-2">' .
      '<span class="icon text-white-50">' .
      '<i class="fas fa-language"></i>' .
      '</span>' .
      '<span class="text">Translation</span>' .
      '</a>' .
      //'<a href="javascript:;" class="item-close btn btn-info btn-icon-split btn-sm mr-2">' .
      //'<span class="icon text-white-50">' .
      //'<i class="fas fa-pencil-alt"></i>' .
      //'</span>' .
      //'<span class="text">Edit</span>' .
      //'</a>'.
      '';
  }


  $menu  = $menu . '<a href="#" data-toggle="modal" data-target="#responsive-modal' . $id . '"  class="item-delete_ btn btn-danger btn-icon-split btn-sm">' .
    '<span class="icon text-white-50">' .
    '<i class="fas fa-trash"></i>' .
    '</span>' .
    '<span class="text">Delete</span>' .
    '</a>' .
    '</div>' .
    '</li>';
 
  return $menu;
}

function menuTree($parent_id = 0)
{

  $items = '';
  $menus = new MenuDynamics();
  $result = $menus->getAllMenuDynamicByPosition();
  $app_settings = new AppSettings();
  $data = $app_settings->getData();


  if (count($result) > 0) {
    $items .= '<ol class="dd-list">';
    foreach ($result as $row) {
      $items .= renderMenuItem($row['id'], $row['label'], $row['url'], $row['type'], $row['icon'], $data["default_language_code"], $row['icon']);
      //$items .= menuTree($row['id']);
      $items .= '</li>';
    }
    $items .= '</ol>';
  }
  return $items;
}

?>
<!-- Content Header (Page header) -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">App Menu</h1>
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
      <li class="breadcrumb-item active">Menu</li>
    </ol>
  </div>

  <div>
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">List Menu</h6>

        <!-- <a href="?page=menu_add" class="btn btn-success btn-icon-split btn-sm">
          <span class="icon text-white-50">
            <i class="fas fa-plus"></i>
          </span>
          <span class="text">Add</span>
        </a> -->
      </div>
      <!-- Card Body -->
      <div class="card-body">

        <div class="row">
          <div class="col col-sm-4">
            <form id="add-menu" method="post" enctype="multipart/form-data">
              <input type="hidden" id="insert_menu" name="insert_menu" />  
              <div>
                <div class="form-group">
                  <label for="type_menu">Select type</label>
                  <select class="form-control type" id="type_menu" name="type_menu" style="width: 100%;">
                    <?php
                    foreach ($types as $option) {
                    ?>
                      <option value="<?= $option['value'] ?>"><?= $option["title"] ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group  ">
                  <label for="name">Title</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Enter title" required>
                </div>
                <div class="form-group">
                  <label for="url">Url</label>
                  <input type="url" class="form-control" id="url" name="url" placeholder="Enter url" required>
                </div>
                <div class="form-group">
                  <label for="image">Image</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="image" name="image" onChange="readURL(this);">
                      <label class="custom-file-label" for="image">Choose file</label>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <img src="../images/menu/default.png?<?= time() ?>" style="width:70px" id="thumb_img" class="img-thumbnail">
                </div>
              </div>
              <button type="submit" class="btn btn-primary btn-icon-split">
                <span class="icon text-white-50">
                  <i class="fas fa-save"></i>
                </span>
                <span class="text">Add New Item</span>
              </button>
            </form>
          </div>
          <!-- <form id="add-item">
          <div class="form-group col-xl-6 col-md-6 mb-4">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter title">
          </div>
          <input type="text" name="url" placeholder="Url">
          <button type="submit">Add Item</button>
        </form> -->
          <div class="col ">
            <form id="update_position" method="post" enctype="multipart/form-data">
              <input type="hidden" id="update_position_menu" name="update_position_menu">
              <b>Your menu is </b>
              <div class="dd" id="nestable">
                <?php
                $html_menu = menuTree();
                echo (empty($html_menu)) ? '<ol class="dd-list"></ol>' : $html_menu;
                ?>
              </div>
              <hr />
              <input type="hidden" id="nestable-output" name="menu">
              <button type="submit" class="btn btn-primary btn-icon-split">
                <span class="icon text-white-50">
                  <i class="fas fa-save"></i>
                </span>
                <span class="text">Update Position Menu</span>
              </button>
            </form>
            <?php
            $menu = "";
            $result = $menus->getAllMenuDynamicByPosition();
            foreach ($result as $m) {
              $menu .= '<div>' .
                '<div class="modal fade" id="responsive-modal' . $m['id'] . '">' .
                '<div class="modal-dialog">' .
                '<div class="modal-content">' .
                '<div class="modal-header">' .
                '<h4 class="modal-title">Delete</h4>' .
                '<button type="button" class="close" data-dismiss="modal" aria-label="Close">' .
                '<span aria-hidden="true">&times;</span>' .
                '</button>' .
                '</div>' .
                '<div class="modal-body">' .
                '<p>Are you sure you want to delete this menu <b>' .  $m['label']  . '</b>?</p>' .
                '</div>' .
                '<form id="form-responsive-modal' . $m['id'] . '" method="post">' .
                '<input type="hidden" id="insert_menu" name="delete_menu" /> ' .
                '<div class="modal-footer justify-content-between">' .
                '<input type="hidden" name="id" value="' . $m['id'] . '" />' .
                '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>' .
                '<button type="submit" class="btn btn-danger waves-effect waves-light">Delete</button>' .
                '</div>' .
                '</form>' .
                '</div>' .
                '</div>' .
                '</div>' .
                '</div>';
            }
            echo $menu;
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>