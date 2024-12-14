<?php
require_once "../controllers/menusdynamics.php";
require_once "../controllers/languages.php";
$languages = new Languages();

$menus = new MenuDynamics();

$lang =  $_REQUEST['lang'];
$title = $_REQUEST['title'];
$data = $menus->getByLang($lang);

$id = null;
if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}

$row = $menus->getById($id);
if ($row == null || ($row["type"] != "url" && $row["type"] != "title_block")) {
    echo '<script> window.location.href = "index.php?page=menudynamics"; </script>';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_menu_translation'])) {
    $menus->setParams($_POST, $_FILES);
    $menus->updateTranslation();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST'  && isset($_POST['update_menu'])) {
    $menus->setParams($_POST, $_FILES);
    $menus->update();
}

?>

<!-- Content Header (Page header) -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Menu</h1>
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a id="goToIndex" href="index.php?page=menudynamics">List Menu</a></li>
            <li class="breadcrumb-item active">Edit Menu</li>
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
                <input type="hidden" name="update_menu" />
                <div class="card-body">

                    <div class="card-body">

                        <div class="row">
                            <div class="form-group col-xl-6 col-md-6 mb-4">
                                <label for="title">Navigation Label</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Enter navigation Label" required value="<?= $row["label"] ?>">
                            </div>

                            <div class="form-group col-xl-6 col-md-6 mb-4">
                            </div>

                            <?php
                            if ($row["type"] == "url") {
                            ?>
                                <div class="form-group col-xl-6 col-md-6 mb-4">
                                    <label for="url">Navigation Url</label>
                                    <input type="url" class="form-control" id="url" name="url" placeholder="Enter navigation Url" value="<?= $row["url"] ?>" required>
                                </div>
                            <?php } ?>

                            <?php
                            if ($row["type"] == "url") {
                            ?>
                                <div class="form-group col-xl-6 col-md-6 mb-4">
                                    <label for="image">Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="image" name="image" onChange="readURL(this);">
                                            <label class="custom-file-label" for="image">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>

                            <div class="form-group col-xl-6 col-md-6 mb-4">
                                <label for="status">Status</label>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="status" name="status" data-bootstrap-switch <?php echo ($row["status"] === "1") ? ' checked="checked"' : ''; ?>>
                                    <label class="custom-control-label" for="status"></label>
                                </div>
                            </div>

                            <?php
                            if ($row["type"] == "url") {
                            ?>
                                <div class="form-group col-xl-6 col-md-6 mb-4">
                                    <img src="../images/menu/<?= $row["icon"] ?>?<?= time() ?>" style="width:60px" id="thumb_img" class="img-thumbnail">
                                </div>
                            <?php } ?>

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
                <h6 class="m-0 font-weight-bold text-primary">Edit Translation Menu</h6>
            </div>
            <br>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <?php
                foreach ($languages->getAll() as $obj) {
                ?>
                    <li class="nav-item">
                        <a class="nav-link <?= $lang == $obj['app_lang_code'] ? 'active' : '' ?> " href="?page=menudynamics_translation&id=<?= $id ?>&lang=<?= $obj['app_lang_code'] ?>">
                            <?= $obj['title'] ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
            <!-- Card Body -->
            <form method="post" action="" id="form" enctype="multipart/form-data" class="needs-validation">
                <input type="hidden" name="update_menu_translation" />
                <div class="card-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-xl-6 col-md-6 mb-4">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" required value="<?= $data["title"] ?>">
                            </div>
                            <?php if ($row["type"] == "url") {  ?>
                                <div class="form-group col-xl-6 col-md-6 mb-4">
                                    <label for="url">Url</label>
                                    <input type="url" class="form-control" id="url" name="url" placeholder="Enter url" value="<?= $data["url"] ?>" required>
                                </div>
                            <?php } ?>
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