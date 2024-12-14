<?php
require_once "../controllers/about.php";
require_once "../controllers/languages.php";
$languages = new Languages();
$appSettings = new AppSettings();

$lang =  $_REQUEST['lang'];
$data = $appSettings->getByLang($lang);
$dataSettings = $appsettings->getData();
 
$id = null;
if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}
 
if ($_SERVER['REQUEST_METHOD'] === 'POST'  && isset($_POST['update_app_translation'])) { 
    $appSettings->updateTranslation($_POST);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST'  && isset($_POST['update_logo_drawer'])) { 
    $appSettings->update($_POST, $_FILES);
	$dataSettings = $appSettings->getData();
}


?>

<!-- Content Header (Page header) -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Application</h1>
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li> 
            <li class="breadcrumb-item active">Application</li>
        </ol>
    </div>
 
    <div>
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Logo Drawer ( Menu )</h6>
            </div>


            <form method="post" action="" id="form" enctype="multipart/form-data" class="needs-validation">
                <input type="hidden" name="update_logo_drawer" />
                <div class="card-body" > 
                <div class="row">
                   <div class="form-group col-xl-6 col-md-6 mb-4"> 
                        <label for="logo_drawer_width">Logo </label> 
                    <div class="input-group">
                        <div class="custom-file"> 
                        <input type="file" class="custom-file-input" id="logo_drawer" name="logo_drawer" onChange="readURLLogo(this);">
                        <label class="custom-file-label" for="logo_drawer">Choose file</label>
                        </div>  
                        </div>   
                        <br>
                        <img src="../images/settings/<?= $dataSettings["logo_drawer"] ?>?<?= time() ?>" style="width:100px; background-color: #bdbdbd" id="thumb_img_logo" class="img-thumbnail">
                    </div>

                    <div class="form-group col-xl-6 col-md-6 mb-4"> 
                                 <div>  
									<div class="form-group">
										<label for="logo_drawer_width">Logo Width </label>
										<div>
											<input type="text" class="form-control" id="logo_drawer_width" name="logo_drawer_width" placeholder="Logo width" value="<?= $dataSettings['logo_drawer_width'] ?>" required>
										</div>
									</div>

									<div class="form-group">
										<label for="logo_drawer_height">Logo Height </label>
										<div>
											<input type="text" class="form-control" id="logo_drawer_height" name="logo_drawer_height" placeholder="Logo height" value="<?= $dataSettings['logo_drawer_height'] ?>" required>
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
                </div>
            </form>
            </div>
            </div>

    <div>
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Translation Application</h6>
            </div>
            <br>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <?php
                foreach ($languages->getAll() as $obj) {
                ?>
                    <li class="nav-item">
                        <a class="nav-link <?= $lang == $obj['app_lang_code'] ? 'active' : '' ?> " href="?page=application_translation&id=<?= $id ?>&lang=<?= $obj['app_lang_code'] ?>">
                            <?= $obj['title'] ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
            
            <!-- Card Body -->
            <form method="post" action="" id="form" enctype="multipart/form-data" class="needs-validation">
                <input type="hidden" name="update_app_translation" />
                <div class="card-body">
                    <div class="card-body"> 
                    <div class="row">
                        
                        </div> 
                        <div class="row">
                            <div class="form-group col-xl-6 col-md-6 mb-4">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" required value="<?= $data["title"] ?>">
                            </div>
                            <div class="form-group col-xl-6 col-md-6 mb-4">
                                <label for="url">Sub Title</label>
                                <input type="text" class="form-control" id="url" name="sub_title" placeholder="Enter sub title" value="<?= $data["sub_title"] ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xl-6 col-md-6 mb-4">
                                <label for="title">Url</label>
                                <input type="text" class="form-control" id="url" name="url" placeholder="Enter url application" required value="<?= $data["url"] ?>">
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