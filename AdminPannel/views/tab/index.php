<?php
require_once "../controllers/tab.php";
require_once "../controllers/app_settings.php";

$tab = new Tab();
$app_settings = new AppSettings();
$data = $app_settings->getData();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $req =  $_POST;
  $req["tab_refresh"] =  isset($_POST["tab_refresh"]) ? "true" : "false";
  $req["tab_navigation_enable"] =  isset($_POST["tab_navigation_enable"]) ? "true" : "false";

  $app_settings->update($req);
  $data = $app_settings->getData();
}

$tab_positions  = array(
  array(
    'value' => 'top',
    'title' => 'Top'
  ),
  array(
    'value' => 'bottom',
    'title' => 'Bottom'
  )
);


$tab_types = array(
  array(
    'value' => 'regular',
    'title' => 'Style 1'
  ),
  array(
    'value' => 'circular',
    'title' => 'Style 2'
  ),
);

?>

<!-- Content Header (Page header) -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Configuration Tab</h1>
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
      <li class="breadcrumb-item active">Tab</li>
    </ol>
  </div>

  <div>
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Edit Tab ( Enable, Icon Colors , Background Color ) </h6>
      </div>
      <!-- Card Body -->
      <div class="card-body">
        <form method="post" action="" id="form" enctype="multipart/form-data">

          <div class="row">

            <div class="col-md-6">
              <div class="form-group">
                <label for="tab_navigation_enable">Enable Tab navigation</label>
                <div class="custom-control custom-switch">
                  <input type="checkbox" class="custom-control-input tab_navigation_enable" id="tab_navigation_enable" name="tab_navigation_enable" value="true" data-bootstrap-switch <?php echo ($data["tab_navigation_enable"] === "true") ? ' checked="checked"' : ''; ?> />
                  <label class="custom-control-label" for="tab_navigation_enable"></label>
                </div>
              </div>
            </div>
            <div class="col-md-6">
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="tab_refresh">Enable Refresh ( Double Tab ) </label>
                <div class="custom-control custom-switch">
                  <input type="checkbox" class="custom-control-input tab_refresh" id="tab_refresh" name="tab_refresh" value="true" data-bootstrap-switch <?php echo ($data["tab_refresh"] === "true") ? ' checked="checked"' : ''; ?> />
                  <label class="custom-control-label" for="tab_refresh"></label>
                </div>
              </div>
            </div>

            <div class="form-group col-md-4 floating_button">
              <label for="tab_type">Tab Style</label>
              <div class="d-flex justify-content-between">
                <?php
                foreach ($tab_types as $option) {
                  $selected = ($option['value'] == $data['tab_type']) ? "checked" : "";
                ?>
                  <div class="col-md-4 d-inline">
                    <div class="custom-control custom-radio custom-control-inline  ">
                      <input type="radio" name="tab_type" id="radio_<?= $option['value'] ?>" value="<?= $option['value'] ?>" <?= $selected ?> class="custom-control-input">
                      <label class="custom-control-label" for="radio_<?= $option['value'] ?>"><?= $option['title'] ?></label>
                    </div>
                    <div>
                      <img src="../images/tab/<?= $option['value'] ?>.png" style="width:200px;height:auto">
                    </div>
                  </div>
                <?php } ?>
              </div>
            </div>
            <div class="form-group col-xl-6 col-md-6 mb-4"></div>


            <div class="col-md-6">
              <div class="form-group">
                <label for="tab_navigation_enable">Tab position</label>
                <div>

                  <select class="form-control" id="tab_position" name="tab_position" style="width: 100%;">
                    <?php
                    foreach ($tab_positions as $option) {
                    ?>
                      <option value="<?= $option['value'] ?>" <?php echo ($option['value'] == $data['tab_position']) ? ' selected="selected"' : ''; ?>><?= $option["title"] ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label>Color icon active :</label>
              <div class=" input-group tab_color_icon_active">
                <input type="text" class="form-control" id="tab_color_icon_active" name="tab_color_icon_active" value="<?= $data["tab_color_icon_active"] ?>" />
                <div class="input-group-append">
                  <span class="input-group-text"><i class="fas fa-square" style="color:<?= $data['tab_color_icon_active'] ?>"></i></span>
                </div>
              </div>
            </div>
            <div class="form-group col-md-6">
              <label>Color icon active ( Dark Mode ):</label>
              <div class=" input-group tab_color_icon_active_dark">
                <input type="text" class="form-control" id="tab_color_icon_active_dark" name="tab_color_icon_active_dark" value="<?= $data["tab_color_icon_active_dark"] ?>" />
                <div class="input-group-append">
                  <span class="input-group-text"><i class="fas fa-square" style="color:<?= $data['tab_color_icon_active_dark'] ?>"></i></span>
                </div>
              </div>
            </div>
            <div class="form-group col-md-6">
              <label>Color icon inactive :</label>
              <div class=" input-group tab_color_icon_inactive">
                <input type="text" class="form-control" id="tab_color_icon_inactive" name="tab_color_icon_inactive" value="<?= $data["tab_color_icon_inactive"] ?>">
                <div class="input-group-append">
                  <span class="input-group-text"><i class="fas fa-square" style="color:<?= $data['tab_color_icon_inactive'] ?>"></i></span>
                </div>
              </div>
            </div>
            <div class="form-group col-md-6">
              <label>Color icon inactive ( Dark Mode ):</label>
              <div class=" input-group tab_color_icon_inactive_dark">
                <input type="text" class="form-control" id="tab_color_icon_inactive_dark" name="tab_color_icon_inactive_dark" value="<?= $data["tab_color_icon_inactive_dark"] ?>">
                <div class="input-group-append">
                  <span class="input-group-text"><i class="fas fa-square" style="color:<?= $data['tab_color_icon_inactive_dark'] ?>"></i></span>
                </div>
              </div>
            </div>
            <div class="form-group col-md-6">
              <label>Color background :</label>
              <div class=" input-group tab_color_background">
                <input type="text" class="form-control" id="tab_color_background" name="tab_color_background" value="<?= $data["tab_color_background"] ?>">
                <div class="input-group-append">
                  <span class="input-group-text"><i class="fas fa-square" style="color:<?= $data['tab_color_background'] ?>"></i></span>
                </div>
              </div>
            </div>
            <div class="form-group col-md-6">
              <label>Color background ( Dark Mode ):</label>
              <div class=" input-group tab_color_background_dark">
                <input type="text" class="form-control" id="tab_color_background_dark" name="tab_color_background_dark" value="<?= $data["tab_color_background_dark"] ?>">
                <div class="input-group-append">
                  <span class="input-group-text"><i class="fas fa-square" style="color:<?= $data['tab_color_background_dark'] ?>"></i></span>
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
        </form>
      </div>
    </div>
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">List Tab</h6>
      </div>
      <!-- Card Body -->
      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Icon</th>
            <th style="width: 150px;">Status</th>
            <th style="width: 150px;">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($tab->getAll() as $t) {
          ?>
            <tr>
              <td><img src="../images/tab/<?= $t['icon'] ?>?<?= time() ?>" style="width:30px" class="img-thumbnail"></td>
              <td>
                <span class="badge <?= $t['status'] ? 'badge-success' : 'badge-secondary' ?>"><?= $t['status'] ? "Active" : "Inactive" ?></span>
              </td>
              <td>
                <a href="?page=tab_edit&id=<?= $t['id'] ?>&lang=<?= $data["default_language_code"] ?>" class="btn btn-info btn-icon-split btn-sm">
                  <span class="icon text-white-50">
                    <i class="fas fa-pencil-alt"></i>
                  </span>
                  <span class="text">Edit</span>
                </a>
              </td>
            </tr>

          <?php } ?>
        </tbody>
        <tfoot>
          <tr>
            <th>Icon</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>
<script>
  /*
  $("input#colorTab").ColorPickerSliders({
    hsvpanel: true,
    previewformat: 'hex',
    onchange: function(container, color) {
      $('.colorTab .fa-square').css('color', color.tiny.toHexString()); 
      $.ajax({
        type: "POST",
        url: '../api/settings/changeTab.php',
        data: {
          "colorTab": color.tiny.toHexString()
        },
        success: function(response) {
          var jsonData = JSON.parse(response);

          console.log(jsonData.success)
        }
      }); 
    }
  });
  */

  $("input#tab_color_icon_active").ColorPickerSliders({
    hsvpanel: true,
    previewformat: 'hex',
    onchange: function(container, color) {
      $('.tab_color_icon_active .fa-square').css('color', color.tiny.toHexString());
    }
  });
  $("input#tab_color_icon_active_dark").ColorPickerSliders({
    hsvpanel: true,
    previewformat: 'hex',
    onchange: function(container, color) {
      $('.tab_color_icon_active_dark .fa-square').css('color', color.tiny.toHexString());
    }
  });
  $("input#tab_color_icon_inactive").ColorPickerSliders({
    hsvpanel: true,
    previewformat: 'hex',
    onchange: function(container, color) {
      $('.tab_color_icon_inactive .fa-square').css('color', color.tiny.toHexString());
    }
  });
  $("input#tab_color_icon_inactive_dark").ColorPickerSliders({
    hsvpanel: true,
    previewformat: 'hex',
    onchange: function(container, color) {
      $('.tab_color_icon_inactive_dark .fa-square').css('color', color.tiny.toHexString());
    }
  });
  $("input#tab_color_background").ColorPickerSliders({
    hsvpanel: true,
    previewformat: 'hex',
    onchange: function(container, color) {
      $('.tab_color_background .fa-square').css('color', color.tiny.toHexString());
    }
  });
  $("input#tab_color_background_dark").ColorPickerSliders({
    hsvpanel: true,
    previewformat: 'hex',
    onchange: function(container, color) {
      $('.tab_color_background_dark .fa-square').css('color', color.tiny.toHexString());
    }
  });

  /*
   
    $('#tab_navigation_enable').change(function() {
      var tab_checked = $(this).is(':checked');
      $.ajax({
        type: "POST",
        url: '../api/settings/changeTab.php',
        data: {
          "tab_navigation_enable": tab_checked == true ? "1" : "0",
        },
        success: function(response) {
          var jsonData = JSON.parse(response);

          console.log(jsonData.success)
        }
      });
    } ); 

    $('#tab_refresh').change(function() {
      var tab_checked = $(this).is(':checked');
      $.ajax({
        type: "POST",
        url: '../api/settings/changeTab.php',
        data: {
          "tab_refresh": tab_checked == true ? "1" : "0",
        },
        success: function(response) {
          var jsonData = JSON.parse(response);

          console.log(jsonData.success)
        }
      });
    } ); 
    */
</script>