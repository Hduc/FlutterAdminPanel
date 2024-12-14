<?php
require_once "../controllers/splash.php";
$splash = new Splash();
$s = $splash->getFirst();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$splash->setParams($_POST, $_FILES);
	$splash->update();
	$s = $splash->getById($s["id"]);
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

				<form method="post" action="" id="splash" enctype="multipart/form-data">
					<input type="hidden" id="id" name="id" value="<?= $s["id"] ?>">

					<div class="card-body">
						<div class="row">
							<div class="col-md-6">

								<!-- Color Picker -->
								<div class="form-group">
									<label>First Color:</label>

									<div class="input-group firstColor">
										<input type="text" class="form-control" id="firstColor" name="firstColor" value="<?= $s["firstColor"] ?>">

										<div class="input-group-append">
											<span class="input-group-text"><i class="fas fa-square" style="color:<?= $s['firstColor'] ?>"></i></span>
										</div>
									</div>
									<!-- /.input group -->
								</div>

								<!-- Color Picker -->
								<div class="form-group">
									<label>Second Color:</label>

									<div class="input-group secondColor">
										<input type="text" class="form-control" id="secondColor" name="secondColor" value="<?= $s['secondColor'] ?>">

										<div class="input-group-append">
											<span class="input-group-text"><i class="fas fa-square" style="color:<?= $s['secondColor'] ?> "></i></span>
										</div>
									</div>
									<!-- /.input group -->
								</div>

								<div class="form-group">
									<label for="enable_logo">Show logo</label>
									<div class="custom-control custom-switch">
										<input type="checkbox" class="custom-control-input enable_logo" id="enable_logo" name="enable_logo" data-bootstrap-switch <?php echo ($s["enable_logo"] == "1") ? ' checked="checked"' : ''; ?> />
										<label class="custom-control-label" for="enable_logo"></label>
									</div>
								</div>

								<div id="logo_splash_image_container" <?php echo ($s["enable_logo"] == "0") ? ' style="display : none"' : ''; ?>>
									<div class="form-group">
										<label for=" logo_splash">Logo splash</label>
										<div class="input-group">
											<div class="custom-file">
												<input type="file" class="custom-file-input" id="logo_splash" name="logo_splash" onChange="readURLLogo(this);">
												<label class="custom-file-label" for="logo_splash">Choose file</label>
											</div>
										</div>
									</div>
									<div class="form-group">
										<img src="../images/splash/<?= $s["logo_splash"] ?>?<?= time() ?>" style="width:100px; background-color: #bdbdbd" id="thumb_img_logo" class="img-thumbnail">
									</div>
								</div>

								<div>
									<div class="form-group">
										<label for="splash_logo_width">Logo Width </label>
										<div>
											<input type="text" class="form-control" id="splash_logo_width" name="splash_logo_width" placeholder="Logo width" value="<?= $s['splash_logo_width'] ?>" required>
										</div>
									</div>

									<div class="form-group">
										<label for="splash_logo_height">Logo Height </label>
										<div>
											<input type="text" class="form-control" id="splash_logo_height" name="splash_logo_height" placeholder="Logo height" value="<?= $s['splash_logo_height'] ?>" required>
										</div>
									</div>
								</div>

								<div class="form-group">
									<label for="enable_img">Show image splash screen</label>
									<div class="custom-control custom-switch">
										<input type="checkbox" class="custom-control-input" id="enable_img" name="enable_img" data-bootstrap-switch <?php echo ($s["enable_img"] == "1") ? ' checked="checked"' : ''; ?>>
										<label class="custom-control-label" for="enable_img"> </label>
									</div>
								</div>

								<div id="image_splash_image_container" <?php echo ($s["enable_img"] == "0") ? ' style="display : none"' : ''; ?>>
									<div class="form-group">
										<label for="img_splash">Splash Image</label>
										<div class="input-group">
											<div class="custom-file">
												<input type="file" class="custom-file-input" id="img_splash" name="img_splash" onChange="readURLSplash(this);">
												<label class="custom-file-label" for="image_splash">Choose file</label>
											</div>
										</div>
									</div>

									<div class="form-group">
										<img src="../images/splash/<?= $s["img_splash"] ?>?<?= time() ?>" style="width:100px; background-color: #bdbdbd" id="splash_img" class="img-thumbnail">
									</div>
								</div>

							</div>
							<!-- /.col -->
							<div class="col-md-6">

								<label>Preview:</label>
								<div class="linearGradient" style="
 								position: relative;
                                height: 500px;
                                width: 270px;
                                background: linear-gradient(180deg, <?= $s['firstColor'] ?> , <?= $s['secondColor'] ?>);
                                border-top-width: 2px;
                                border-top-style: solid;
                                border-right-width: 2px;
                                border-right-style: solid;
                                border-left-width: 2px;
                                border-left-style: solid;
                                border-color: black;
                                border-bottom-width: 2px;
                                border-bottom-style: solid;">
									<div class="d-flex justify-content-between">
										<img src="../img/part1.png" style="height:10px; width: 90px;" />
										<img src="../img/part2.png" style="height:10px; width: 90px;" />
										<img src="../img/part3.png" style="height:10px; width: 90px;" />
									</div>
									<div id="preview_logo" style=" 
  									    z-index: 2;
								        width: 100%;
								        height: 100%;
										overflow: auto;
										margin: auto;
										position: absolute;
										top: calc(50% - (<?= $s["splash_logo_height"] / 2 ?>px));    
										left: calc(50% - (<?= $s["splash_logo_width"] / 2 ?>px));   
										align-items: center;
										<?php echo ($s["enable_logo"] == "0") ? ' display : none ' : ''; ?>
 									">
										<img src="../images/splash/<?= $s["logo_splash"] ?>?<?= time() ?>" style="width: <?= $s["splash_logo_width"] ?>px; height: <?= $s["splash_logo_height"] ?>px" id="preview_img_logo" />
									</div>
									<div id="preview_splash" style="  
  									    z-index: 1;
									    height:100%; width: 100%;
										overflow: auto;
										margin: auto;
										position: absolute;
										top: 0; 
										left: 0; 
										bottom: 0; 
										right: 0;
										<?php echo ($s["enable_img"] == "0") ? ' display : none ' : ''; ?>
 									">
										<img src="../images/splash/<?= $s["img_splash"] ?>?<?= time() ?>" style="
									        height:100%; 
											width: 100%;
										" id="preview_splash_img" />
									</div>
								</div>
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
	$("input#secondColor").ColorPickerSliders({
		hsvpanel: true,
		previewformat: 'hex',
		onchange: function(container, color) {
			$('.secondColor .fa-square').css('color', color.tiny.toHexString());
			$('.linearGradient').css('background', 'linear-gradient(180deg, ' + $("#firstColor").val() + ', ' + color.tiny.toHexString() + ' )');
		}
	});
	$("input#firstColor").ColorPickerSliders({
		hsvpanel: true,
		previewformat: 'hex',
		onchange: function(container, color) {
			$('.firstColor .fa-square').css('color', color.tiny.toHexString());
			$('.linearGradient').css('background', 'linear-gradient(180deg,  ' + color.tiny.toHexString() + ', ' + $("#secondColor").val() + ' )');
		}
	});

	$('#enable_logo').change(function() {
		var logo_splash_checked = $(this).is(':checked');
		var logoElement = document.getElementById("logo_splash_image_container");
		var logoElementPreview = document.getElementById("preview_logo");
		if (logo_splash_checked) {
			logoElement.style.display = "block";
			logoElementPreview.style.display = "block";
		} else {
			logoElement.style.display = "none";
			logoElementPreview.style.display = "none";
		}
	});

	$('#enable_img').change(function() {
		var image_splash_checked = $(this).is(':checked');
		var splashElement = document.getElementById("image_splash_image_container");
		var splashElementPreview = document.getElementById("preview_splash");
		if (image_splash_checked) {
			splashElement.style.display = "block";
			splashElementPreview.style.display = "block";
		} else {
			splashElement.style.display = "none";
			splashElementPreview.style.display = "none";
		}
	});
</script>