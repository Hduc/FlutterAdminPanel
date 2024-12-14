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
		<h1 class="h3 mb-0 text-gray-800">Custom Css</h1>
		<ol class="breadcrumb float-sm-right">
			<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
			<li class="breadcrumb-item active">Custom Css</li>
		</ol>
	</div>

	<div>
		<div class="card shadow mb-4">
			<!-- Card Header - Dropdown -->
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-primary">Custom Css</h6>
			</div>
			<!-- Card Body -->
			<form method="post" action="" id="form" enctype="multipart/form-data">
				<div class="card-body">

					<div>
						<input type="hidden" id="id" name="id" value="<?= $data['id'] ?>">

						<div class="form-group">
							<label for="customCss">Custom Css</label>
							<textarea class="form-control" id="customCss" name="customCss" rows="6" placeholder="Custom Css"><?= $data['customCss'] ?></textarea>
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