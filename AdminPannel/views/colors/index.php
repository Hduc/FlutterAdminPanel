<?php
require_once "../controllers/app_settings.php";
$app_settings = new AppSettings();
$data = $app_settings->getData();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $app_settings->update($_POST);
    $data = $app_settings->getData();
}
?>

<!-- Content Header (Page header) -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Colors</h1>
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Colors</li>
        </ol>
    </div>

    <div>
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Colors</h6>
            </div>

            <!-- Card Body -->
            <div class="card-body">

                <form method="post" action="" id="settings">  
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
  
                                <!-- Color Picker -->
                                <div class="form-group">
                                    <label>First Color:</label>

                                    <div class="input-group firstColor">
                                        <input type="text" class="form-control" id="firstColor" name="firstColor" value="<?= $data["firstColor"] ?>">

                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-square" style="color:<?= $data['firstColor'] ?>"></i></span>
                                        </div>
                                    </div>
                                    <!-- /.input group -->
                                </div>

                                <!-- Color Picker -->
                                <div class="form-group">
                                    <label>Second Color:</label>

                                    <div class="input-group secondColor">
                                        <input type="text" class="form-control" id="secondColor" name="secondColor" value="<?= $data['secondColor'] ?>">

                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-square" style="color:<?= $data['secondColor'] ?> "></i></span>
                                        </div>
                                    </div>
                                    <!-- /.input group -->
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">

                                <label>Preview:</label>
                                <div class="linearGradient" style="
                                height: 20px;
                                background: linear-gradient(135deg, <?= $data['firstColor'] ?> , <?= $data['secondColor'] ?>);
                                border-top-width: 2px;
                                border-top-style: solid;
                                border-right-width: 2px;
                                border-right-style: solid;
                                border-left-width: 2px;
                                border-left-style: solid;
                                border-color: black;">
                                    <div class="d-flex justify-content-between">
                                        <img src="../img/part1.png" style="height:15px;" />
                                        <img src="../img/part2.png" style="height:15px;" />
                                        <img src="../img/part3.png" style="height:15px;" />
                                    </div>
                                </div>

                                <div class="linearGradient" style="
                                border-bottom-width: 2px;
                                border-bottom-style: solid;
                                border-right-width: 2px;
                                border-right-style: solid;
                                border-left-width: 2px;
                                border-left-style: solid;
                                border-color: black;
                                height: 55px;
                                background: linear-gradient(135deg, <?= $data['firstColor'] ?> , <?= $data['secondColor'] ?>);"></div>

                            </div>
                            <!-- /.col -->
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

</div>

<script>
    $("input#backgroundColor").ColorPickerSliders({
        hsvpanel: true,
        previewformat: 'hex',
        onchange: function(container, color) {
            $('.statusBarColor .fa-square').css('color', color.tiny.toHexString());
            $('.statusBar').css('background', color.tiny.toHexString());
        }
    });
    $("input#secondColor").ColorPickerSliders({
        hsvpanel: true,
        previewformat: 'hex',
        onchange: function(container, color) {
            $('.secondColor .fa-square').css('color', color.tiny.toHexString());
            $('.linearGradient').css('background', 'linear-gradient(135deg, ' + $("#firstColor").val() + ', ' + color.tiny.toHexString() + ' )');
        }
    });
    $("input#firstColor").ColorPickerSliders({
        hsvpanel: true,
        previewformat: 'hex',
        onchange: function(container, color) {
            $('.firstColor .fa-square').css('color', color.tiny.toHexString());
            $('.linearGradient').css('background', 'linear-gradient(135deg,  ' + color.tiny.toHexString() + ', ' + $("#secondColor").val() + ' )');
        }
    });
</script>