<?php
require_once "../controllers/tab.php";
require_once "../controllers/translations.php";
require_once "../controllers/app_settings.php";

$translations = new Translations();
$lang = null;
if (!empty($_GET['lang'])) {
    $lang = $_REQUEST['lang'];
}

$tab = new Tab();
$app_settings = new AppSettings();
$data = $app_settings->getData();

if (isset($_POST["lang"]) && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reset_language'])) {
    $translations->saveTranslationByLang($_POST["lang"], 'update');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST'  && isset($_POST['update_language'])) {
    $translations->updateTranslation($_POST);
}


?>

<!-- Content Header (Page header) -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">List Translation</h1>
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="index.php?page=languages">Languages</a>
            </li>
            <li class="breadcrumb-item active">Translation
            </li>
        </ol>
    </div>

    <form method="post" action="" id="form" enctype="multipart/form-data">
        <input type="hidden" name="update_language" value="update_language" />
        <div>
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">List Translation</h6>
                   
                    <a href="#" data-toggle="modal" data-target="#responsive-modal" class="btn btn-primary btn-icon-split btn-sm">
                        <span class="icon text-white-50">
                            <i class="fas fa-sync"></i>
                        </span>
                        <span class="text">Reset Default Language</span>
                    </a>

                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Key</th>
                                <th>Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $id = 0;
                            foreach ($translations->getByLang($lang) as $obj) {
                                $id++;
                            ?>
                                <tr>
                                    <td><?= $id ?></td>
                                    <td><?= $obj['lang_value_default'] ?></td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="<?= $obj['lang_key'] ?>" name="<?= $obj['lang_key'] ?>" value="<?= $obj['lang_value'] ?>">
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th style="width: 5%;">#</th>
                                <th style="width: 35%;">Key</th>
                                <th>Value</th>
                            </tr>
                        </tfoot>
                    </table>
                    <button type="submit" class="btn btn-primary btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-save"></i>
                        </span>
                        <span class="text">Save</span>
                    </button>
                </div>
            </div>
        </div>
    </form>


    <!-- /.modal -->
    <div class="modal fade" id="responsive-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        Are you sure you want to reset this language by default language value ?<b></b>
                    </p>
                </div>

                <form id="form-responsive-modal" method="post">
                    <input type="hidden" name="reset_language" value="reset_language" />
                    <div class="modal-footer justify-content-between">
                        <input type="hidden" name="lang" value="<?= $lang ?>" />
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Change</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->


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
    });
</script>