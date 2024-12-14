<?php
require_once "../controllers/languages.php";
require_once "../controllers/app_settings.php";
$languages = new Languages();
$appsettings = new AppSettings();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_language'])) {
  $languages->setParams($_POST);
  $languages->delete();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_rtl'])) {
  $languages->setParams($_POST);
  $languages->enable();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_default_language'])) {
  $appsettings->update($_POST, $_FILES);
}
 
?>
<!-- Content Header (Page header) -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">List Languages</h1>
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
      <li class="breadcrumb-item active">Languages</li>
    </ol>
  </div>
 
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">Default Language</h6>
    </div>
    <!-- Card Body -->
    <div class="card-body">
      <form method="post" action="" id="form" enctype="multipart/form-data">
        <input type="hidden" name="change_default_language" value="change_default_language" />
        <div class="row">
          <div class="form-group col-xl-6 col-md-6 mb-4">
            <label>Default Language</label>
            <select data-placeholder="Choose one thing" data-allow-clear="1" id="default_language" name="default_language" required>
              <option></option>
              <?php
              foreach ($languages->getAll() as $obj) {
              ?>
                <option value="<?= $obj['id'] ?>" data-icon="" <?php echo ($obj["id"]  ==  $appsettings->getValueData('default_language')) ? ' selected="selected"' : ''; ?>>
                  <?= $obj['title'] . " (" . $obj['app_lang_code'] . ")" ?>
                </option>
              <?php } ?>
            </select>
            <input type="hidden" id="default_language_code" name="default_language_code" value="<?= $appsettings->getValueData('default_language_code')  ?>">
          </div>
        </div>
        <button type="submit" class="btn btn-primary btn-icon-split">
          <span class="icon text-white-50">
            <i class="fas fa-save"></i>
          </span>
          <span class="text">Save</span>
        </button>
      </form>
    </div>
  </div>

  <div>
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">List Languages</h6>
        <a href="?page=languages_add" class="btn btn-success btn-icon-split btn-sm">
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
              <th>Code Country</th>
              <th>Code Language</th>
              <th style="width: 150px;">RTL</th>
              <th style="width: 150px;">Status</th>
              <th style="width: 310px;">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($languages->getAll() as $obj) {
            ?>
              <tr>
                <td><img src="../images/flags/<?= strtolower($obj['code']) ?>.png?<?= time() ?>" style="width:30px" class="img-thumbnail"></td>
                <td><?= $obj['title'] ?></td>
                <td><?= $obj['code'] ?></td>
                <td><?= $obj['app_lang_code'] ?></td>
                <td>
                  <form id="change_rtl<?= $obj['id'] ?>" name="change_rtl" method="post">
                    <input type="hidden" name="id" value="<?= $obj['id'] ?>" />
                    <input type="hidden" name="change_rtl" value="change_rtl" />
                    <div class="custom-control custom-switch">
                      <input type="hidden" name="rtl_<?= $obj['id'] ?>" value="0">
                      <input onclick="document.getElementById('change_rtl<?= $obj['id'] ?>').submit()" value="1" type="checkbox" class="custom-control-input boarding" id="rtl_<?= $obj['id'] ?>" name="rtl_<?= $obj['id'] ?>" data-bootstrap-switch <?php echo ($obj["rtl"]  ==  1) ? ' checked="checked"' : ''; ?> />
                      <label class="custom-control-label" for="rtl_<?= $obj['id'] ?>"></label>
                    </div>
                  </form>
                </td>
                <td>
                  <span class="badge <?= $obj['status'] ? 'badge-success' : 'badge-secondary' ?>"><?= $obj['status'] ? "Active" : "Inactive" ?></span>
                </td>
                <td>
                  <a href="?page=translation&lang=<?= $obj['app_lang_code'] ?>" class="btn btn-success btn-icon-split btn-sm">
                    <span class="icon text-white-50">
                      <i class="fas fa-pencil-alt"></i>
                    </span>
                    <span class="text">Translation</span>
                  </a>
                  <a href="?page=languages_edit&id=<?= $obj['id'] ?>" class="btn btn-info btn-icon-split btn-sm">
                    <span class="icon text-white-50">
                      <i class="fas fa-pencil-alt"></i>
                    </span>
                    <span class="text">Edit</span>
                  </a>
                  <?php
                  if ($appsettings->getValueData('default_language') != $obj['id']) {
                  ?>
                    <a href="#" data-toggle="modal" data-target="#responsive-modal<?= $obj['id'] ?>" class="btn btn-danger btn-icon-split btn-sm">
                      <span class="icon text-white-50">
                        <i class="fas fa-trash"></i>
                      </span>
                      <span class="text">Delete</span>
                    </a>
                  <?php } ?>
                  <!-- /.modal -->
                  <div class="modal fade" id="responsive-modal<?= $obj['id'] ?>">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Delete</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <p>Are you sure you want to delete this page <b><?= $obj['title'] ?></b>
                            <img src="../images/flags/<?= $obj['code'] ?>.png?<?= time() ?>" style="width:30px" class="img-thumbnail"> ?
                          </p>
                        </div>
                        <form id="form-responsive-modal<?= $obj['id'] ?>" method="post">
                          <div class="modal-footer justify-content-between">
                            <input type="hidden" name="id" value="<?= $obj['id'] ?>" />
                            <input type="hidden" name="remove_language" id="remove_language" />
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger waves-effect waves-light">Delete</button>
                        </form>
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
      </div>
      <!-- End Modal -->
      </td>
      </tr>
    <?php } ?>
    </tbody>
    <tfoot>
      <tr>
        <th>Icon</th>
        <th>Title</th>
        <th>Code Country</th>
        <th>Code Language</th>
        <th style="width: 150px;">RTL</th>
        <th style="width: 150px;">Status</th>
        <th style="width: 210px;">Action</th>
      </tr>
    </tfoot>
    </table>
    </div>
  </div>
</div>


<script>
  $('#default_language').change(function() {
    var selected = $(this).children("option:selected").text();
    var code = selected.substring(
      selected.indexOf("(") + 1,
      selected.lastIndexOf(")")
    );
    $('#default_language_code').val(code);
  });
</script>