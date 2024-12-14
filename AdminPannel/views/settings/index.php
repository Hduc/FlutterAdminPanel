<?php
require_once "../controllers/app_settings.php";
$appsettings = new AppSettings();
$data = $appsettings->getData();

$navigatin_option = array(
	array(
		'value' => 'left',
		'title' => 'Left Navigation'
	),

	array(
		'value' => 'center',
		'title' => 'Center Navigation'
	),

	array(
		'value' => 'right',
		'title' => 'Right Navigation'
	),

	array(
		'value' => 'empty',
		'title' => 'No Navigation'
	)
);

$loader_option = array(
	array(
		'value' => 'RotatingPlain',
		'title' => 'Rotating Plain'
	),
	array(
		'value' => 'DoubleBounce',
		'title' => 'Double Bounce'
	),
	array(
		'value' => 'Wave',
		'title' => 'Wave'
	),
	array(
		'value' => 'WanderingCubes',
		'title' => 'Wandering Cubes'
	),
	array(
		'value' => 'FadingFour',
		'title' => 'Fading Four'
	),
	array(
		'value' => 'FadingCube',
		'title' => 'Fading Cube'
	),

	array(
		'value' => 'Pulse',
		'title' => 'Pulse'
	),
	array(
		'value' => 'ChasingDots',
		'title' => 'Chasing Dots'
	),
	array(
		'value' => 'ThreeBounce',
		'title' => 'Three Bounce'
	),
	array(
		'value' => 'Circle',
		'title' => 'Circle'
	),
	array(
		'value' => 'CubeGrid',
		'title' => 'Cube Grid'
	),
	array(
		'value' => 'FadingCircle',
		'title' => 'Fading Circle'
	),

	array(
		'value' => 'RotatingCircle',
		'title' => 'Rotating Circle'
	),
	array(
		'value' => 'FoldingCube',
		'title' => 'Folding Cube'
	),
	array(
		'value' => 'PumpingHeart',
		'title' => 'Pumping Heart'
	),
	array(
		'value' => 'DualRing',
		'title' => 'Dual Ring'
	),
	array(
		'value' => 'HourGlass',
		'title' => 'Hour Glass'
	),
	array(
		'value' => 'PouringHourGlass',
		'title' => 'Pouring Hour Glass'
	),

	array(
		'value' => 'FadingGrid',
		'title' => 'Fading Grid'
	),
	array(
		'value' => 'Ring',
		'title' => 'Ring'
	),
	array(
		'value' => 'Ripple',
		'title' => 'Ripple'
	),
	array(
		'value' => 'SpinningCircle',
		'title' => 'Spinning Circle'
	),
	array(
		'value' => 'SquareCircle',
		'title' => 'Square Circle'
	),
	array(
		'value' => 'empty',
		'title' => 'No Loading'
	),
);

$title_option = array(
	array(
		'value' => 'text',
		'title' => 'Text'
	),
	array(
		'value' => 'image',
		'title' => 'Image'
	),
	array(
		'value' => 'empty',
		'title' => 'Empty'
	)
);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$appsettings->update($_POST, $_FILES);
	$data = $appsettings->getData();
}
?>

<!-- Content Header (Page header) -->
<div class="container-fluid">
	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Settings</h1>
		<ol class="breadcrumb float-sm-right">
			<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
			<li class="breadcrumb-item active">Settings</li>
		</ol>
	</div>

	<div>
		<div class="card shadow mb-4">
			<!-- Card Header - Dropdown -->
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-primary">Settings</h6>
			</div>
			<!-- Card Body -->
			<form method="post" action="" id="form" enctype="multipart/form-data">

				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="loader"><b>Application Fonts</b></label>
								<div class="d-flex justify-content-between">
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="google_font">Select Google Fonts</label>
								<select class="form-control google_font" id="google_font" name="google_font" style="width: 100%;">
									<?php
									foreach ($appsettings->getAllFonts() as $option) {
									?>
										<option value="<?= $option['title'] ?>" <?php echo ($option['title'] == $data['google_font']) ? ' selected="selected"' : ''; ?>><?= $option["title"] ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="form-group">
								<label for="initial_dark_mode">Initial Dark Mode</label>
								<div class="custom-control custom-switch">
									<input type="hidden" name="initial_dark_mode" value="false">
									<input type="checkbox" class="custom-control-input initial_dark_mode" id="initial_dark_mode" name="initial_dark_mode" value="true" data-bootstrap-switch <?php echo ($data["initial_dark_mode"] ==  "true") ? ' checked="checked"' : ''; ?> />
									<label class="custom-control-label" for="initial_dark_mode"></label>
								</div>
							</div>
					</div>
				</div>

			 
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="loader"><b>Settings Application</b></label>
								<div class="d-flex justify-content-between">
								</div>
							</div>
						</div>
						<div class="col-md-6">

							<!-- /.form-group -->

							<div class="form-group">
								<label for="loader">Select loader style</label>

								<div class="d-flex justify-content-between">
									<select class="form-control loader" id="loader" name="loader" style="width: 100%;">
										<?php
										foreach ($loader_option as $option) {
										?>
											<option value="<?= $option['value'] ?>" <?php echo ($option['value'] == $data['loader']) ? ' selected="selected"' : ''; ?>><?= $option["title"] ?></option>
										<?php } ?>
									</select>
									<img src="../img/loading/<?= $data['loader'] ?>.gif" id="image_loader" style="height:40px; width: 40px; margin-left:5px" />
								</div>

							</div>
							<!-- /.form-group -->


							<!-- Color Picker -->
							<div class="form-group">
								<label>Loader Color:</label>
								<div class="input-group loaderColor">
									<input type="text" class="form-control" id="loaderColor" name="loaderColor" value="<?= $data['loaderColor'] ?>">
									<div class="input-group-append">
										<span class="input-group-text">
											<i class="fas fa-square" style="color:<?= $data['loaderColor'] ?> "></i>
										</span>
									</div>
								</div>
								<!-- /.input group -->
							</div>

 
						</div>
						<!-- /.col -->
						<div class="col-md-6">
							<div class="form-group">
								<label for="pull_refresh">Pull refresh</label>
								<div class="custom-control custom-switch">
									<input type="hidden" name="pull_refresh" value="false">
									<input type="checkbox" class="custom-control-input pull_refresh" id="pull_refresh" name="pull_refresh" value="true" data-bootstrap-switch <?php echo ($data["pull_refresh"] ==  "true") ? ' checked="checked"' : ''; ?> />
									<label class="custom-control-label" for="pull_refresh"></label>
								</div>
							</div>
							<div class="form-group">
								<label for="title">Deeplink</label>
								<input type="text" class="form-control" id="deeplink" name="deeplink" placeholder="Deeplink" value="<?= $data['deeplink'] ?>" required>
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
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {

		$("#loader").on('change', function() {
			$('#image_loader').attr('src', '../img/loading/' + this.value + '.gif');
		});

		$("#right_button").on('change', function() {
			$('#image_right_button').attr('src', '../img/button/' + this.value + '.png');
		});

		$("#left_button").on('change', function() {
			$('#image_left_button').attr('src', '../img/button/' + this.value + '.png');
		});

		$('#form').validate({
			rules: {
				title: {
					required: true,
				},
				url: {
					url: true
				}
			},
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


<script>
	$("input#loaderColor").ColorPickerSliders({
		hsvpanel: true,
		previewformat: 'hex',
		onchange: function(container, color) {
			$('.loaderColor .fa-square').css('color', color.tiny.toHexString());
			$('.linearGradient').css('background', 'linear-gradient(135deg, ' + $("#firstColor").val() + ', ' + color.tiny.toHexString() + ' )');
		}
	});
</script>