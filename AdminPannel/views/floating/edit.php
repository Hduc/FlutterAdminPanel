<?php
require_once "../controllers/floatings.php";
require_once "../controllers/languages.php";
$languages = new Languages();
$floatings = new Floatings();

$lang =  $_REQUEST['lang'];
$data = $floatings->getByLang($lang);

$id = null;
if (!empty($_GET['id'])) {
  $id = $_REQUEST['id'];
}

$row = $floatings->getById($id);
if ($row == null) {
  echo '<script> window.location.href = "index.php?page=floating"; </script>';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST'  && isset($_POST['update_floating'])) {
  $floatings->setParams($_POST, $_FILES);
  $floatings->update();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST'  && isset($_POST['update_floating_translation'])) {
  $floatings->setParams($_POST, $_FILES);
  $floatings->updateTranslation();
}

?>

<!-- Content Header (Page header) -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Floating</h1>
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
      <li class="breadcrumb-item"><a id="goToIndex" href="index.php?page=floating">Floating</a></li>
      <li class="breadcrumb-item active">Edit Floating</li>
    </ol>
  </div>

  <div>
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Edit Floating</h6>
      </div>
      <!-- Card Body -->
      <form method="post" action="" id="form" enctype="multipart/form-data" class="needs-validation">
        <input type="hidden" name="update_floating" />
        <div class="card-body">
          <div class="card-body">
            <div class="row">
              <div class="form-group col-xl-6 col-md-6 mb-4">
                <label for="status">Enable Sub Floating</label>
                <div class="custom-control custom-switch">
                  <input type="checkbox" class="custom-control-input" id="status" name="status" data-bootstrap-switch <?php echo ($row["status"] === "1") ? ' checked="checked"' : ''; ?>>
                  <label class="custom-control-label" for="status"></label>
                </div>
              </div>
              <div class="form-group col-xl-6 col-md-6 mb-4"></div>

              <div class="form-group col-xl-6 col-md-6 mb-4">
                <label>Icon Color:</label>
                <div class="input-group icon_color">
                  <input type="text" class="form-control" id="icon_color" name="icon_color" value="<?= $row["icon_color"] ?>">
                  <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-square" style="color:<?= $row['icon_color'] ?>"></i></span>
                  </div>
                </div>
                <!-- /.input group -->
              </div>
              <div class="form-group col-xl-6 col-md-6 mb-4">
                <label>Icon Color ( Dark Mode ):</label>
                <div class="input-group icon_color_dark">
                  <input type="text" class="form-control" id="icon_color_dark" name="icon_color_dark" value="<?= $row["icon_color_dark"] ?>">
                  <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-square" style="color:<?= $row['icon_color_dark'] ?>"></i></span>
                  </div>
                </div>
                <!-- /.input group -->
              </div>

              <div class="form-group col-xl-6 col-md-6 mb-4">
                <label>Background Color:</label>
                <div class="input-group background_color">
                  <input type="text" class="form-control" id="background_color" name="background_color" value="<?= $row["background_color"] ?>">
                  <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-square" style="color:<?= $row['background_color'] ?>"></i></span>
                  </div>
                </div>
                <!-- /.input group -->
              </div>
              <div class="form-group col-xl-6 col-md-6 mb-4">
                <label>Background Color ( Dark Mode ):</label>
                <div class="input-group background_color_dark">
                  <input type="text" class="form-control" id="background_color_dark" name="background_color_dark" value="<?= $row["background_color_dark"] ?>">
                  <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-square" style="color:<?= $row['background_color_dark'] ?>"></i></span>
                  </div>
                </div>
                <!-- /.input group -->
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
              <div class="form-group col-xl-6 col-md-6 mb-4"></div>

              <div class="form-group col-xl-6 col-md-6 mb-4">
                <img src="../images/floating/<?= $row["icon"] ?>?<?= time() ?>" style="width:70px" id="thumb_img" class="img-thumbnail">
              </div>
              <div class="form-group col-xl-6 col-md-6 mb-4"></div>
 
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
 
  <div>
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Edit Translation Tab</h6>
      </div>
      <br>
      <!-- Nav tabs -->
      <ul class="nav nav-tabs">
        <?php
        foreach ($languages->getAll() as $obj) {
        ?>
          <li class="nav-item">
            <a class="nav-link <?= $lang == $obj['app_lang_code'] ? 'active' : '' ?> " href="?page=floating_edit&id=<?= $id ?>&lang=<?= $obj['app_lang_code'] ?>">
              <?= $obj['title'] ?>
            </a>
          </li>
        <?php } ?>
      </ul>
      <!-- Card Body -->
      <form method="post" action="" id="form" enctype="multipart/form-data" class="needs-validation">
        <input type="hidden" name="update_floating_translation" />
        <div class="card-body">
          <div class="card-body">
            <div class="row">
              <div class="form-group col-xl-6 col-md-6 mb-4">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" required value="<?= $data["title"] ?>">
              </div>
              <div class="form-group col-xl-6 col-md-6 mb-4">
                <label for="url">Url</label>
                <input type="url" class="form-control" id="url" name="url" placeholder="Enter url" value="<?= $data["url"] ?>" required>
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

<script>
  function readURL(input) {
    var ext = input.files[0]['name'].substring(input.files[0]['name'].lastIndexOf('.') + 1).toLowerCase();
    if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg"))
      var reader = new FileReader();
    reader.onload = function(e) {
      $('#thumb_img').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
</script>

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

  $("input#background_color").ColorPickerSliders({
    hsvpanel: true,
    previewformat: 'hex',
    onchange: function(container, color) {
      $('.background_color .fa-square').css('color', color.tiny.toHexString());
    }
  });
  $("input#background_color_dark").ColorPickerSliders({
    hsvpanel: true,
    previewformat: 'hex',
    onchange: function(container, color) {
      $('.background_color_dark .fa-square').css('color', color.tiny.toHexString());
    }
  });

  $("input#icon_color").ColorPickerSliders({
    hsvpanel: true,
    previewformat: 'hex',
    onchange: function(container, color) {
      $('.icon_color .fa-square').css('color', color.tiny.toHexString());
    }
  });
  $("input#icon_color_dark").ColorPickerSliders({
    hsvpanel: true,
    previewformat: 'hex',
    onchange: function(container, color) {
      $('.icon_color_dark .fa-square').css('color', color.tiny.toHexString());
    }
  });
</script>