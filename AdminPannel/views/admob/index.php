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
		<h1 class="h3 mb-0 text-gray-800">adMob (Google)</h1>
		<ol class="breadcrumb float-sm-right">
			<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
			<li class="breadcrumb-item active">adMob</li>
		</ol>
	</div>

	<div>
		<div class="card shadow mb-4">
			<!-- Card Header - Dropdown -->
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-primary">adMob</h6>
			</div>
			<!-- Card Body -->
			<form method="post" action="" id="form" enctype="multipart/form-data">
				<div class="card-body">

					<div class="row">
						<div class="col-md-6"> 
							<div class="form-group">
								<label for="admob_id">Set your adMob ID ( Android )</label>
								<input type="text" class="form-control" id="admob_id" name="admob_id" placeholder="AdMob ID" value="<?= $data['admob_id'] ?>">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="admob_id_ios">Set your adMob ID  ( iOS )</label>
								<input type="text" class="form-control" id="admob_id_ios" name="admob_id_ios" placeholder="AdMob ID iOS" value="<?= $data['admob_id_ios'] ?>">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="ad_banner">Show ad banner</label>
								<div class="custom-control custom-switch">
								    <input type="hidden" name="ad_banner" value="false"> 
									<input type="checkbox" class="custom-control-input" id="ad_banner" name="ad_banner" value="true" data-bootstrap-switch <?php echo ($data["ad_banner"] === "true") ? ' checked="checked"' : ''; ?>>
									<label class="custom-control-label" for="ad_banner"></label>
								</div>
							</div>
						</div>
						<div class="col-md-6">
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="admob_key_ad_banner">Set adMob key ad banner  ( Android )</label>
								<input type="text" class="form-control" id="admob_key_ad_banner" name="admob_key_ad_banner" placeholder="AdMob Key Ad Banner" value="<?= $data['admob_key_ad_banner'] ?>">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="admob_key_ad_banner_ios">Set adMob key ad banner ( iOS )</label>
								<input type="text" class="form-control" id="admob_key_ad_banner_ios" name="admob_key_ad_banner_ios" placeholder="AdMob Key Ad Banner iOS" value="<?= $data['admob_key_ad_banner_ios'] ?>">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="ad_interstitial">Show ad interstitial</label>
								<div class="custom-control custom-switch"> 
								    <input type="hidden" name="ad_interstitial" value="false"> 
									<input type="checkbox" class="custom-control-input" id="ad_interstitial" name="ad_interstitial" value="true" data-bootstrap-switch <?php echo ($data["ad_interstitial"] === "true") ? ' checked="checked"' : ''; ?>>
									<label class="custom-control-label" for="ad_interstitial"></label>
								</div>
							</div>
						</div>
						<div class="col-md-6">
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="admob_key_ad_interstitial">Set adMob key ad interstitial ( Android )</label>
								<input type="text" class="form-control" id="admob_key_ad_interstitial" name="admob_key_ad_interstitial" placeholder="AdMob Key Ad Interstitial" value="<?= $data['admob_key_ad_interstitial'] ?>">
							</div>
						</div>



						<div class="col-md-6">
							<div class="form-group">
								<label for="admob_key_ad_interstitial_ios">Set adMob key ad interstitial ( iOS )</label>
								<input type="text" class="form-control" id="admob_key_ad_interstitial_ios" name="admob_key_ad_interstitial_ios" placeholder="AdMob Key Ad Interstitial iOS" value="<?= $data['admob_key_ad_interstitial_ios'] ?>">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="admob_dealy">Set adMob dealy in second </label>
								<input type="text" class="form-control" id="admob_dealy" name="admob_dealy" placeholder="AdMob Dealy in milliseconds" value="<?= $data['admob_dealy'] ?>">
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