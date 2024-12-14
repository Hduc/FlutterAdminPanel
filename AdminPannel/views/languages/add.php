<?php
require_once "../controllers/countries.php";
require_once "../controllers/languages.php";
require_once "../controllers/languages_code.php";
$countries = new Countries();
$languages_code = new LanguagesCode();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $languages = new Languages();
  $languages->setParams($_POST, $_FILES);
  $languages->insert();
}

?>

<!-- Content Header (Page header) -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Add Language</h1>
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
      <li class="breadcrumb-item"><a id="goToIndex" href="index.php?page=languages">Language</a></li>
      <li class="breadcrumb-item active">Add Language</li>
    </ol>
  </div>

  <div>
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Language Information</h6>
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

              <div class="form-group col-xl-6 col-md-6 mb-4">
                <label for="title">Title native</label>
                <input type="text" class="form-control" id="title_native" name="title_native" placeholder="Enter title native" required>
              </div>

              <div class="form-group col-xl-6 col-md-6 mb-4">
                <label>Code</label>
                <select data-placeholder="Choose one thing" data-allow-clear="1" id="code" name="code" required>
                  <option></option>
                  <?php
                  foreach ($countries->getAll() as $obj) {
                  ?>
                    <option value="<?= $obj['code'] ?>" data-flag="<?= $obj['code'] ?>">
                      <?= $obj['code'] ?> <span data-flag="TN"></span>
                    </option>
                  <?php } ?>
                </select>
              </div>

              <!-- 
                <div class="form-group col-xl-6 col-md-6 mb-4">
              </div>
             -->
              <!--
              <div class="form-group col-xl-6 col-md-6 mb-4">
                <label for="app_lang_code">App Lang Code</label>
                <code><a target="_blank" href="https://en.wikipedia.org/wiki/List_of_ISO_639-1_codes">Links for ISO 639-1 codes</a></code>
                <input type="text" class="form-control" id="app_lang_code" name="app_lang_code" placeholder="Put ISO 639-1 code for your language" required>
              </div>
              -->
              <div class="form-group col-xl-6 col-md-6 mb-4">
                <label for="app_lang_code">App Lang Code</label>
                <select data-placeholder="Choose one thing" data-allow-clear="1" id="app_lang_code" name="app_lang_code" required>
                  <option></option>
                  <?php
                  foreach ($languages_code->getAll() as $obj) {
                  ?>
                    <option value="<?= $obj['code'] ?>">
                      <?= $obj['name'] ?> ( <?= $obj['code'] ?> )
                    </option>
                  <?php } ?>
                </select>
              </div>

              <div class="form-group col-xl-6 col-md-6 mb-4">
                <label for="status">Status</label>
                <div class="custom-control custom-switch">
                  <input type="hidden" name="status" value="0">
                  <input type="checkbox" class="custom-control-input" id="status" name="status" value="1" checked data-bootstrap-switch>
                  <label class="custom-control-label" for="status"></label>
                </div>
              </div>

              <div class="form-group col-xl-6 col-md-6 mb-4">
                <label for="rtl">RTL</label>
                <div class="custom-control custom-switch">
                  <input type="hidden" name="rtl" value="0">
                  <input type="checkbox" class="custom-control-input" id="rtl" name="rtl" value="1" data-bootstrap-switch>
                  <label class="custom-control-label" for="rtl"></label>
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

<script type="text/javascript">
  const getFlagEmoji = (countryCode) => countryCode.toUpperCase().replace(/./g,
    char => String.fromCodePoint(127397 + char.charCodeAt())
  );


  const flagReplace = document.querySelectorAll('[data-flag]');
   flagReplace.forEach(s => s.innerHTML = getFlagEmoji(s.dataset.flag) + " " + s.dataset.flag)

  //flagReplace.forEach(s => s.innerHTML = "<p>sss</p>")


  $(document).ready(function() {


    $("#cmbIdioma").select2({
      templateResult: function(idioma) {
        var $span = $("<span><img src='https://www.free-country-flags.com/countries/" + idioma.id + "/1/tiny/" + idioma.id + ".png'/> " + idioma.text + "</span>");
        return $span;
      },
      templateSelection: function(idioma) {
        var $span = $("<span><img src='https://www.free-country-flags.com/countries/" + idioma.id + "/1/tiny/" + idioma.id + ".png'/> " + idioma.text + "</span>");
        return $span;
      }
    });


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