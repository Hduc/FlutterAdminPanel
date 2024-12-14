<?php
require_once "../controllers/floatings.php";
$floatings = new Floatings();
if (isset($_POST["id"]) && $_SERVER['REQUEST_METHOD'] === 'POST') {
  $floatings = new Floatings();
  $floatings->setParams($_POST);
  $floatings->delete();
}

require_once "../controllers/app_settings.php";
$app_settings = new AppSettings();
$data = $app_settings->getData();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $app_settings->update($_POST, $_FILES); 
  $data = $app_settings->getData();
}


$floating_option = array(
	array(
		'value' => 'circular',
		'title' => 'Circular'
	), 
	array(
		'value' => 'regular',
		'title' => 'Regular'
	)
);

?>
<!-- Content Header (Page header) -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">App Floating</h1>
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
      <li class="breadcrumb-item active">Floating</li>
    </ol>
  </div>


  <div>
    <!-- Card Body -->
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Config Floating</h6>
      </div>
      <!-- Card Body -->
      <div class="card-body">
        <form method="post" action="" id="form" enctype="multipart/form-data" class="needs-validation">
          <div class="row">

            <div class="form-group col-xl-6 col-md-6 mb-4">
              <label for="floating_enable">Enable Floating</label>
              <div class="custom-control custom-switch">
                <input type="hidden" name="floating_enable" value="0">
                <input type="checkbox" class="custom-control-input" value="1" id="floating_enable" name="floating_enable" data-bootstrap-switch <?php echo ($data["floating_enable"] === "1") ? ' checked="checked"' : ''; ?>>
                <label class="custom-control-label" for="floating_enable"></label>
              </div>
            </div> 
            <div class="form-group col-md-4 floating_button">
                                    <label for="floating_option">Floating Button Style</label>
                                    
                                    <div class="d-flex justify-content-between">
                                    <?php
                                        foreach ($floating_option as $option){
                                            $selected = ($option['value'] == $data['floating_type']) ? "checked" : "";
                                        ?>
                                        
                                        <div class="col-md-4 d-inline">
                                            <div class="custom-control custom-radio custom-control-inline col-md-2">
                                                <input type="radio" name="floating_type" id="radio_<?= $option['value'] ?>" value="<?= $option['value'] ?>" <?= $selected ?>  class="custom-control-input">
                                                <label class="custom-control-label" for="radio_<?= $option['value'] ?>" ><?= $option['title'] ?></label>
                                            </div> 
                                            <div  >
                                                <img src="../images/floating/<?= $option['value'] ?>.png" style="width:180px" id="thumb_img" class="img-thumbnail"> 
                                              </div>
                                        </div>
                                    <?php } ?>
                                    </div>
                                </div> 
            <div class="form-group col-xl-6 col-md-6 mb-4">
              <label>Icon Color:</label>
              <div class="input-group floating_icon_color">
                <input type="text" class="form-control" id="floating_icon_color" name="floating_icon_color" value="<?= $data["floating_icon_color"] ?>">
                <div class="input-group-append">
                  <span class="input-group-text"><i class="fas fa-square" style="color:<?= $data['floating_icon_color'] ?>"></i></span>
                </div>
              </div>
            </div>
            <div class="form-group col-xl-6 col-md-6 mb-4">
              <label>Icon Color ( Dark Mode ):</label>
              <div class="input-group floating_icon_color_dark">
                <input type="text" class="form-control" id="floating_icon_color_dark" name="floating_icon_color_dark" value="<?= $data["floating_icon_color_dark"] ?>">
                <div class="input-group-append">
                  <span class="input-group-text"><i class="fas fa-square" style="color:<?= $data['floating_icon_color_dark'] ?>"></i></span>
                </div>
              </div>
            </div>
 
            <div class="form-group col-xl-6 col-md-6 mb-4">
              <label>Background Color:</label>
              <div class="input-group floating_background_color">
                <input type="text" class="form-control" id="floating_background_color" name="floating_background_color" value="<?= $data["floating_background_color"] ?>">
                <div class="input-group-append">
                  <span class="input-group-text"><i class="fas fa-square" style="color:<?= $data['floating_background_color'] ?>"></i></span>
                </div>
              </div>
            </div>
            <div class="form-group col-xl-6 col-md-6 mb-4">
              <label>Background Color ( Dark Mode ):</label>
              <div class="input-group floating_background_color_dark">
                <input type="text" class="form-control" id="floating_background_color_dark" name="floating_background_color_dark" value="<?= $data["floating_background_color_dark"] ?>">
                <div class="input-group-append">
                  <span class="input-group-text"><i class="fas fa-square" style="color:<?= $data['floating_background_color_dark'] ?>"></i></span>
                </div>
              </div>
            </div>
 
            <div class="form-group col-xl-6 col-md-6 mb-4">
              <label for="floating_icon">Image</label>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="floating_icon" name="floating_icon" onChange="readURL(this);">
                  <label class="custom-file-label" for="floating_icon">Choose file</label>
                </div>
              </div>
            </div>
            <div class="form-group col-xl-6 col-md-6 mb-4">
              <label for="floating_margin_bottom">Margin Bottom</label>
              <input type="number" class="form-control" id="floating_margin_bottom" name="floating_margin_bottom" placeholder="Enter margin bottom" required value="<?= $data["floating_margin_bottom"] ?>">
            </div>
 
            <div class="form-group col-xl-6 col-md-6 mb-4">
              <img src="../images/floating/<?= $data["floating_icon"] ?>?<?= time() ?>" style="width:70px" id="thumb_img" class="img-thumbnail">
            </div>
          </div>

          <button type="submit" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50">
              <i class="fas fa-save"></i>
            </span>
            <span class="text">Save</span>
          </button>
          <!-- /.card-body -->
        </form>
      </div>
    </div>
  </div>
 
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">List Floating</h6>

      <a href="?page=floating_add" class="btn btn-success btn-icon-split btn-sm">
        <span class="icon text-white-50">
          <i class="fas fa-plus"></i>
        </span>
        <span class="text">Add</span>
      </a>
    </div>
    <!-- Card Body -->
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Icon</th> 
            <th>Title</th>
            <th style="width: 150px;">Status</th>
            <th style="width: 210px;">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($floatings->getAll() as $f) {
          ?>
            <tr>
              <td><img src="../images/floating/<?= $f['icon'] ?>?<?= time() ?>" style="width:30px" class="img-thumbnail"></td>
              <td><?= $f['title'] ?></td> 
              <td>
                <span class="badge <?= $f['status'] ? 'badge-success' : 'badge-secondary' ?>"><?= $f['status'] ? "Active" : "Inactive" ?></span>
              </td>
              <td>

                <a href="?page=floating_edit&id=<?= $f['id'] ?>&lang=<?= $data["default_language_code"] ?>" class="btn btn-info btn-icon-split btn-sm">
                  <span class="icon text-white-50">
                    <i class="fas fa-pencil-alt"></i>
                  </span>
                  <span class="text">Edit</span>
                </a>

                <a href="#" data-toggle="modal" data-target="#responsive-modal<?= $f['id'] ?>" class="btn btn-danger btn-icon-split btn-sm">
                  <span class="icon text-white-50">
                    <i class="fas fa-trash"></i>
                  </span>
                  <span class="text">Delete</span>
                </a>

                <!-- /.modal -->
                <div class="modal fade" id="responsive-modal<?= $f['id'] ?>">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Delete</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p>Are you sure you want to delete this floating <b><?= $f['title'] ?></b>
                          <img src="../images/floating/<?= $f['icon'] ?>?<?= time() ?>" style="width:30px" class="img-thumbnail"> ?
                        </p>
                      </div>

                      <form id="form-responsive-modal<?= $f['id'] ?>" method="post">
                        <div class="modal-footer justify-content-between">
                          <input type="hidden" name="id" value="<?= $f['id'] ?>" />
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-danger waves-effect waves-light">Delete</button>
                      </form>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
    </div>
    <!-- End Card Body -->
    </td>
    </tr>
  <?php } ?>
  </tbody>
  <tfoot>
    <tr>
      <th>Icon</th>
      <th>Title</th>
      <th>Status</th>
      <th>Action</th>
    </tr>
  </tfoot>
  </table>
  </div>
 
</div>
 
<script>
  $("input#floating_background_color").ColorPickerSliders({
    hsvpanel: true,
    previewformat: 'hex',
    onchange: function(container, color) {
      $('.floating_background_color .fa-square').css('color', color.tiny.toHexString());
    }
  });

  $("input#floating_icon_color").ColorPickerSliders({
    hsvpanel: true,
    previewformat: 'hex',
    onchange: function(container, color) {
      $('.floating_icon_color .fa-square').css('color', color.tiny.toHexString());
    }
  });

  $("input#floating_background_color_dark").ColorPickerSliders({
    hsvpanel: true,
    previewformat: 'hex',
    onchange: function(container, color) {
      $('.floating_background_color_dark .fa-square').css('color', color.tiny.toHexString());
    }
  });

  $("input#floating_icon_color_dark").ColorPickerSliders({
    hsvpanel: true,
    previewformat: 'hex',
    onchange: function(container, color) {
      $('.floating_icon_color_dark .fa-square').css('color', color.tiny.toHexString());
    }
  });
</script>