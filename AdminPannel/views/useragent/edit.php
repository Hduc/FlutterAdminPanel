<?php
require_once "../controllers/userAgent.php";

$id = null;
if (!empty($_GET['id'])) {
  $id = $_REQUEST['id'];
}
$userAgent = new UserAgent();
$row = $userAgent->getById($id);
if ($row == null) {
  echo '<script> window.location.href = "index.php?page=useragent"; </script>';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $userAgent->setParams($_POST, $_FILES);
  $userAgent->update();
}

?>

<!-- Content Header (Page header) -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit User-Agent</h1>
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
      <li class="breadcrumb-item"><a id="goToIndex" href="index.php?page=useragent">User-Agent</a></li>
      <li class="breadcrumb-item active">Edit User-Agent</li>
    </ol>
  </div>

  <div>
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Edit Menu</h6>

      </div>
      <!-- Card Body -->
      <form method="post" action="" id="form" enctype="multipart/form-data" class="needs-validation">
        <div class="card-body">

          <div class="card-body">

            <div class="row">

              <div class="form-group col-xl-6 col-md-6 mb-4">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" required value="<?= $row["title"] ?>">
              </div>

              <div class="form-group col-xl-6 col-md-6 mb-4">
              </div>

              <div class="form-group col-xl-6 col-md-6 mb-4">
                <label for="value_android">User-agent for android</label>
                <textarea class="form-control" id="value_android" name="value_android" rows="6" placeholder="User-agent for android"><?= $row["value_android"] ?></textarea>
              </div>

              <div class="form-group col-xl-6 col-md-6 mb-4">
                <label for="value_ios">User-agent for iOS</label>
                <textarea class="form-control" id="value_ios" name="value_ios" rows="6" placeholder="User-agent for iOS"><?= $row["value_ios"] ?></textarea>
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
</script>