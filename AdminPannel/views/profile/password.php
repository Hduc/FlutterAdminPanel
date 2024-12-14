<?php
require_once "../controllers/users.php";
$users = new Users();
$u = $users->getFirst();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$users->setParams($_POST, $_FILES);
	$users->changePassword();
	$u = $users->getById($u["id"]);
}
?>

<!-- Content Header (Page header) -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Change Password</h1>
		<ol class="breadcrumb float-sm-right">
			<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
			<li class="breadcrumb-item"><a id="goToIndex" href="index.php?page=profile">Profile</a></li>
			<li class="breadcrumb-item active">Change Password</li>
		</ol>
	</div>

	<div>
		<div class="card shadow mb-4">
			<!-- Card Header - Dropdown -->
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-primary">Change Password</h6>
			</div>
			<!-- Card Body -->
			<form method="post" action="" id="form" enctype="multipart/form-data">
				<div class="card-body">

					<div class="row">
						<input type="hidden" id="id" name="id" value="<?= $u['id'] ?>">


						<div class="form-group col-xl-6 col-md-6 mb-4">
							<label for="password">New password</label>
							<input type="password" class="form-control" id="password" name="password" placeholder="New password" required>
						</div>

						<div class="form-group col-xl-6 col-md-6 mb-4">
						</div>

						<div class="form-group col-xl-6 col-md-6 mb-4">
							<label for="retype_new_password">Retype new password</label>
							<input type="password" class="form-control" id="retype_new_password" name="retype_new_password" placeholder="Retype new password" required>
						</div>

						<!-- /.col -->
					</div>

					<div>

						<button type="submit" class="btn btn-info btn-icon-split mr-3">
							<span class="icon text-white-50">
								<i class="fas fa-key"></i>
							</span>
							<span class="text">Change password</span>
						</button>

					</div>
				</div>
			</form>
		</div>
	</div>
</div>


<script type="text/javascript">
	$(document).ready(function() {
		$.validator.addMethod("valueEquals", function(value, element, arg) {
			return arg === value;
		}, "Value must not equal arg.");

		$('#form').validate({
			rules: {
				password: {
					required: true,
					minlength: 5
				},
				retype_new_password: {
					required: true,
					minlength: 5,
					equalTo: "#password"
				}
			},
			messages: {
				password: {
					required: "Please enter a new password",
				},
				retype_new_password: {
					required: "Please retype new password",
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