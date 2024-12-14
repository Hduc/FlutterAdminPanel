<?php
require_once "../controllers/tab.php";
require_once "../controllers/languages.php";
$languages = new Languages();
$tab = new Tab();

$lang =  $_REQUEST['lang'];
$data = $tab->getByLang($lang);


$id = null;
if (!empty($_GET['id'])) {
  $id = $_REQUEST['id'];
}
$row = $tab->getById($id);
if ($row == null) {
  echo '<script> window.location.href = "index.php?page=tab"; </script>';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST'  && isset($_POST['update_tab'])) {
  $tab->setParams($_POST, $_FILES);
  $tab->update();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST'  && isset($_POST['update_tab_translation'])) {
  $tab->setParams($_POST, $_FILES);
  $tab->updateTranslation();
}

?>

<!-- Content Header (Page header) -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Tab</h1>
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
      <li class="breadcrumb-item"><a id="goToIndex" href="index.php?page=tab">Tab</a></li>
      <li class="breadcrumb-item active">Edit Tab</li>
    </ol>
  </div>

  <div>
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Edit Tab</h6>
      </div>
      <br>
      <form method="post" action="" id="form" enctype="multipart/form-data" class="needs-validation">
        <input type="hidden" name="update_tab" />
        <div class="card-body">
          <div class="card-body">
            <div class="row">
              <div class="form-group col-xl-6 col-md-6 mb-4">
                <img src="../images/tab/<?= $row["icon"] ?>?<?= time() ?>" style="width:70px" id="thumb_img" class="img-thumbnail">
              </div>
              <div class="form-group col-xl-6 col-md-6 mb-4">
                <label for="status">Status</label>
                <div class="custom-control custom-switch">
                  <input type="checkbox" class="custom-control-input" id="status" name="status" data-bootstrap-switch <?php echo ($row["status"] === "1") ? ' checked="checked"' : ''; ?>>
                  <label class="custom-control-label" for="status"></label>
                </div>
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
            <a class="nav-link <?= $lang == $obj['app_lang_code'] ? 'active' : '' ?> " href="?page=tab_edit&id=<?= $id ?>&lang=<?= $obj['app_lang_code'] ?>">
              <?= $obj['title'] ?>
            </a>
          </li>
        <?php } ?>
      </ul>
      <!-- Card Body -->
      <form method="post" action="" id="form" enctype="multipart/form-data" class="needs-validation">
        <input type="hidden" name="update_tab_translation" />
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

<script type="text/javascript">
  $(document).ready(function() {
    $('#form').validate({
      rules: {},
      messages: {
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
</script>