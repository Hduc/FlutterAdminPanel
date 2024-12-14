<?php
require_once "../controllers/floatings.php";
require_once "../controllers/app_settings.php";
$app_settings = new AppSettings();
$data = $app_settings->getData();
 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $floatings = new Floatings();
  $floatings->setParams($_POST, $_FILES);
  $floatings->insert();
}

?>

<!-- Content Header (Page header) -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">App floating</h1>
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
      <li class="breadcrumb-item"><a id="goToIndex" href="index.php?page=floating">Floating</a></li>
      <li class="breadcrumb-item active">Add Floating</li>
    </ol>
  </div>

  <div>
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Add Floating</h6>
      </div>
      <!-- Card Body -->
      <form method="post" action="" id="form" enctype="multipart/form-data">
        <div class="card-body">

          <div class="card-body">

            <div class="row">
              <div class="form-group col-xl-6 col-md-6 mb-4">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" required>
              </div>

              <div></div>

              <div class="form-group">
                <label>Background Color:</label>

                <div class="input-group backgroundColor">
                  <input type="text" class="form-control" id="backgroundColor" name="backgroundColor" value="<?= $data["firstColor"] ?>">

                  <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-square" style="color:<?= $data['firstColor'] ?>"></i></span>
                  </div>
                </div>
                <!-- /.input group -->
              </div>


              <div class="form-group">
                <label>Icon Color:</label>

                <div class="input-group iconColor">
                  <input type="text" class="form-control" id="iconColor" name="iconColor" value="#ffffff">

                  <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-square" style="color:#ffffff"></i></span>
                  </div>
                </div>
                <!-- /.input group -->
              </div>

              <div class="form-group col-xl-6 col-md-6 mb-4">
                <label for="url">Url</label>
                <input type="url" class="form-control" id="url" name="url" placeholder="Enter url" required>
              </div>

              <div class="form-group col-xl-6 col-md-6 mb-4">
                <label for="image">Image</label>
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="image" name="image" onChange="readURL(this);">
                    <label class="custom-file-label" for="image">Choose file</label>
                  </div>
                </div>
              </div>

              <div class="form-group col-xl-6 col-md-6 mb-4">
                <label for="status">Status</label>
                <div class="custom-control custom-switch">
                  <input type="checkbox" class="custom-control-input" id="status" name="status" checked data-bootstrap-switch>
                  <label class="custom-control-label" for="status"></label>
                </div>
              </div>

              <div class="form-group col-xl-6 col-md-6 mb-4">
                <img src="../images/floating/default.png?<?= time() ?>" style="width:70px" id="thumb_img" class="img-thumbnail">
              </div>
 
            </div>
            <button type="submit" class="btn btn-primary btn-icon-split">
              <span class="icon text-white-50">
                <i class="fas fa-save"></i>
              </span>
              <span class="text">Save</span>
            </button>
          </div>
          <!-- /.card-body -->

      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $('#form').validate({
      rules: {},
      messages: {
        title: {
          required: "Please enter a title",
        },
        url: {
          required: "Please enter a url",
          url: "Please enter valid url (http://www.example.com)",
        }
      },
      errorElement: 'div',
      errorPlacement: function(error, element) {
        error.addClass('invalid-feedback');

        element.closest('.form-group').append(error);
      },
      highlight: function(element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function(element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      }
    });
  });

  $("input#backgroundColor").ColorPickerSliders({
    hsvpanel: true,
    previewformat: 'hex',
    onchange: function(container, color) {
      $('.backgroundColor .fa-square').css('color', color.tiny.toHexString());
    }
  });

  $("input#iconColor").ColorPickerSliders({
    hsvpanel: true,
    previewformat: 'hex',
    onchange: function(container, color) {
      $('.iconColor .fa-square').css('color', color.tiny.toHexString());
    }
  });
</script>