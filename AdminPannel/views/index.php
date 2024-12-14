<?php
session_start();
if (empty($_SESSION['user'])) {
  header('Location:  ../login.php ');
  die;
}

require_once("../config/constant.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Welcome to <?= PROJECT_MODULE ?></title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">
  <link href="../css/custom.css" rel="stylesheet">

  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="../dist/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="../dist/toastr/toastr.min.css">

  <!-- SweetAlert2 -->
  <script src="../dist/sweetalert2/sweetalert2.min.js"></script>
  <!-- Toastr -->
  <script src="../dist/toastr/toastr.min.js"></script>

  <!-- Switch Button -->
  <link href="../css/bootstrap-toggle/css/bootstrap-toggle.css" rel="stylesheet">

  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

  <link href="../dist/css/bootstrap-colorpicker.css" rel="stylesheet">
  <script src="../dist/js/bootstrap-colorpicker.js"></script>

  <script src="//cdnjs.cloudflare.com/ajax/libs/tinycolor/0.11.1/tinycolor.min.js"></script>
  <script src="../dist/bootstrap.colorpickersliders.js"></script>

  <link href="../dist/bootstrap.colorpickersliders.css" rel="stylesheet" type="text/css" media="all">
  <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.2.0/js/bootstrap.min.js"></script>


  <!-- Menu CSS -->
  <link rel="stylesheet" href="../css/jquery.nestable.css">
  <link rel="stylesheet" href="../css/style.css">

  <!-- select2 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" integrity="sha256-FdatTf20PQr/rWg+cAKfl6j4/IY3oohFAJ7gVC3M34E=" crossorigin="anonymous">
  <!-- select2-bootstrap4-theme -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme/dist/select2-bootstrap4.min.css"> <!-- for live demo page -->
 
  <!-- Select With Image --> 
  <!--<link rel="stylesheet" href="../css/bootstrap-select.css"> --> 
  <!-- Select With Image -->
  <!--<script src="../js/bootstrap-select.js"></script> --> 

  
  

</head>

<body id="page-top">
  <div class="wrapper">

    <!-- Page Wrapper -->
    <div id="wrapper">

      <!-- Sidebar -->
      <?php
      require "aside.php"
      ?>
      <!-- End of Sidebar -->

      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

          <!-- Topbar -->
          <?php
          require "navbar.php"
          ?>
          <!-- End of Topbar -->

          <!-- Begin Page Content -->
          <?php
          if (isset($_GET['page'])) {
            $action = $_GET['page'];
            $url = explode("_", $action);
            $route = "";
            foreach ($url as &$value) {
              $route .= $value . '/';
            }

            $route = rtrim($route, "/");

            if (count($url) == 1) {
              $route .= '/index.php';
            } else {
              $route .= '.php';
            }

            try {
              if (!@include_once($route)) // @ - to suppress warnings,
                // you can also use error_reporting function for the same purpose which may be a better option
                require_once("notFound/index.php");
              // or
              if (!file_exists($route))
                require_once("notFound/index.php");
              else
                require_once($route);
            } catch (Exception $e) {
              require_once("notFound/index.php");
            }
          } else {
            require_once("dashboard/index.php");
          }

          ?>
          <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->


        <!-- Footer -->
        <footer class="sticky-footer bg-white">
          <div class="float-right d-none d-sm-block copyright my-auto">
            <span class="pr-3">Version 3.0.5 </span>
          </div>
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright &copy; <?= date("Y"); ?> <a href="http://positifmobile.com/">Positifmobile.com</a></span>
            </div>
          </div>
        </footer>
        <!-- End of Footer -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
          <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
      </div>
      <!-- ./wrapper -->

      <!-- page script -->



      <!-- Core plugin JavaScript-->
      <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

      <!-- Custom scripts for all pages-->
      <script src="../js/sb-admin-2.min.js"></script>

      <!-- Page level plugins -->
      <script src="../vendor/chart.js/Chart.min.js"></script>

      <!-- Page level custom scripts -->
      <script src="../js/demo/chart-area-demo.js"></script>
      <script src="../js/demo/chart-pie-demo.js"></script>

      <!-- Switch Button -->
      <script src="../js/bootstrap-toggle/js/bootstrap-toggle.js"></script>

      <!-- Menu dynamics -->
      <!--<script src="../js/jquery-3.4.1.min.js"></script> -->
      <script src="../js/jquery.nestable.js"></script>
      <script src="../js/script.js"></script>
 
      <?php
      if (isset($_SESSION['success'])) { // && isset($_GET["success"])
      ?>
        <script>
          Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
          }).fire({
            type: 'success',
            html: '<?= $_SESSION['success'] ?>'
          });
        </script>
      <?php
        unset($_SESSION['success']);
        unset($_POST);
      }
      ?>

      <?php
      if (isset($_SESSION['error'])) {
      ?>
        <script>
          Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
          }).fire({
            type: 'error',
            title: '<?= $_SESSION['error'] ?>'
          });
        </script>
      <?php
      }
      ?>

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

        function readURLLogo(input) {
          var ext = input.files[0]['name'].substring(input.files[0]['name'].lastIndexOf('.') + 1).toLowerCase();
          if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg"))
            var reader = new FileReader();
          reader.onload = function(e) {
            $('#thumb_img_logo').attr('src', e.target.result);
            $('#preview_img_logo').attr('src', e.target.result);
          }

          reader.readAsDataURL(input.files[0]);
        }

        function readURLSplash(input) {
          var ext = input.files[0]['name'].substring(input.files[0]['name'].lastIndexOf('.') + 1).toLowerCase();
          if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg"))
            var reader = new FileReader();
          reader.onload = function(e) {
            $('#splash_img').attr('src', e.target.result);
            $('#preview_splash_img').attr('src', e.target.result);
          }

          reader.readAsDataURL(input.files[0]);
        }
      </script>

      <!-- select2 -->
      <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js" integrity="sha256-AFAYEOkzB6iIKnTYZOdUf9FFje6lOTYdwRJKwTN5mks=" crossorigin="anonymous"></script>
      <!-- select2-bootstrap4-theme -->
      <script src="../js/scriptSelect2.js"></script>

</body>

</html>