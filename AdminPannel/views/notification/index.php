<?php
require_once "../controllers/app_settings.php";
$app_settings = new AppSettings();
$data = $app_settings->getData();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$app_settings->update($_POST ); 
	$data = $app_settings->getData();
}
?>

<!-- Content Header (Page header) -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">OneSignal Config</h1>
		<ol class="breadcrumb float-sm-right">
			<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
			<li class="breadcrumb-item active">OneSignal Config</li>
		</ol>
	</div>

	<div>
		<div class="card shadow mb-4">
			<!-- Card Header - Dropdown -->
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-primary">OneSignal Config</h6>
			</div>
			<!-- Card Body -->
			<form method="post" action="" id="form" enctype="multipart/form-data">
				<div class="card-body"> 
					<div class="row">  
						 
						<div class="col-md-6">
							<div class="form-group">
								<label for="onesignal_id">OneSignal App ID</label>
								<input type="text" class="form-control" id="onesignal_id" name="onesignal_id" value="<?= $data['onesignal_id'] ?>" placeholder="xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxx">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="onesignal_api_key">Rest Api Key</label>
								<input type="text" class="form-control" id="onesignal_api_key" name="onesignal_api_key" value="<?= $data['onesignal_api_key'] ?>" placeholder="Rest Api Key" required>
							</div>
						</div>

					</div>

					<button type="submit" class="btn btn-primary btn-icon-split mt-3">
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

		$('#form').validate({
			rules: {
				onesignal_id: {
					required: true,
				},
				onesignal_id: {
					required: true,
				}
			},
			messages: {
				onesignal_id: {
					required: "Please enter a OneSignal App ID",
				},
				onesignal_api_key: {
					required: "Please enter a Rest Api Key",
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