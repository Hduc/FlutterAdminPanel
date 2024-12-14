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
		<h1 class="h3 mb-0 text-gray-800">Application version</h1>
		<ol class="breadcrumb float-sm-right">
			<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
			<li class="breadcrumb-item active">Application version</li>
		</ol>
	</div>

	<div>
		<div class="card shadow mb-4">
			<!-- Card Header - Dropdown -->
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-primary">Application version</h6>
			</div>
			<!-- Card Body -->
			<form method="post" action="" id="form" enctype="multipart/form-data">
				<div class="card-body">

					<div class="row">
						<div class="col-md-6"> 
							<div class="form-group">
								<label for="android_id">Android</label>
								<div class="input-group">
									<input type="text" class="form-control" id="android_id" name="android_id" value="<?= $data['android_id'] ?>" placeholder="com.example.app">
									<div class="input-group-append">
										<div class="input-group-text">
											<span class="fab fa-google-play"></span>
										</div>
									</div>
								</div>
							</div>

							<div class="form-group">
								<label for="version_android">Android version</label>
								<div class="input-group">
									<input type="text" class="form-control" id="version_android" name="version_android" value="<?= $data['version_android'] ?>" placeholder="1.0.0">
									<div class="input-group-append">
										<div class="input-group-text">
											<span class="fab fa-google-play"></span>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="ios_id">iOS</label>
								<div class="input-group">
									<input type="text" class="form-control" id="ios_id" name="ios_id" value="<?= $data['ios_id'] ?>" placeholder="idXXXXXXXXX">
									<div class="input-group-append">
										<div class="input-group-text">
											<span class="fab fa-apple"></span>
										</div>
									</div>
								</div>
							</div>

							<div class="form-group">
								<label for="version_ios">iOS version</label>
								<div class="input-group">
									<input type="text" class="form-control" id="version_ios" name="version_ios" value="<?= $data['version_ios'] ?>" placeholder="1.0.0">
									<div class="input-group-append">
										<div class="input-group-text">
											<span class="fab fa-apple"></span>
										</div>
									</div>
								</div>
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