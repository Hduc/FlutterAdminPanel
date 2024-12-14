<?php
require_once "../controllers/nativesocial.php";

$id = null;
if (!empty($_GET['id'])) {
  $id = $_REQUEST['id'];
}
$nativesocials = new NativeSocial(); 
$row = $nativesocials->getById($id);
if ($row == null) {
  echo '<script> window.location.href = "index.php?page=nativesocial"; </script>';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nativesocials->setParams($_POST, $_FILES);
  $nativesocials->update();
}

?>

<!-- Content Header (Page header) -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Application Social</h1>
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
      <li class="breadcrumb-item"><a id="goToIndex" href="index.php?page=nativesocial">Social</a></li>
      <li class="breadcrumb-item active">Edit Social</li>
    </ol>
  </div>

  <div>
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Edit Application Social</h6>

      </div>
      <!-- Card Body -->
      <form method="post" action="" id="form" enctype="multipart/form-data" class="needs-validation">
        <div class="card-body">

          <div class="card-body">

            <div class="row"> 
            <div class="form-group col-xl-6 col-md-6 mb-4">
                <label for="title">Start url with</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" required value="<?= $row["title"] ?>">
              </div>

              <div class="form-group col-xl-6 col-md-6 mb-4">
              </div>
 
              <div class="form-group col-xl-6 col-md-6 mb-4">
                <label for="status">Status</label>
                <div class="custom-control custom-switch">
                  <input type="checkbox" class="custom-control-input" id="status" name="status" data-bootstrap-switch <?php echo ($row["status"] === "1") ? ' checked="checked"' : ''; ?>>
                  <label class="custom-control-label" for="status"></label>
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