<?php 
require_once "../controllers/notification.php";  

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$notification = new Notification();
	$notification->setParams($_POST);
	$notification->send(); 
}
 
 /*
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 
	$heading = array(
		"en" => $_POST["title"]
	);

	$content = array(
		"en" => $_POST["message"]
	);

	$fields = array(
		'app_id' => $s["onesignal_id"],
		//'included_segments' => array('All'),  
        'include_player_ids' => array("5eac0624-2b0b-4fc5-a3b9-ef2f59ac6374"),
		'data' => array(
			"url" => $_POST['url']
		),
		'headings' => $heading,
		'contents' => $content
	);
 
	if (isset($_FILES['image']) && substr($_FILES['image']['type'], 0, 5) == "image") {
		$path = str_replace("views/notification", "", (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . substr(__DIR__, strlen($_SERVER['DOCUMENT_ROOT'])));
		move_uploaded_file($_FILES['image']['tmp_name'], "../images/onesignal/onesignal.png");
		$url = "{$path}images/onesignal/onesignal.png";
 		$fields['chrome_web_image'] = $url;
		$fields['big_picture'] = $url;
	}

	$fields = json_encode($fields);
 
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/json; charset=utf-8',
		'Authorization: Basic ' . $s["onesignal_api_key"]
	));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_HEADER, FALSE);
	curl_setopt($ch, CURLOPT_POST, TRUE);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

	$response = curl_exec($ch);
	curl_close($ch);

	$_SESSION['success'] = "<b>DONE!! </b> Notification sent.";
  
	$return["allresponses"] = $response;
	$return = json_encode($return);

	$data = json_decode($response, true); 
	$id = $data['id'];  
}*/
 


?>
 
<!-- Content Header (Page header) -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Notification</h1>
		<ol class="breadcrumb float-sm-right">
			<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
			<li class="breadcrumb-item active">Notification</li>
		</ol>
	</div>

	<div>
		<div class="card shadow mb-4">
			<!-- Card Header - Dropdown -->
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-primary">Send notification</h6>
			</div>
			<!-- Card Body -->
			<form method="post" action="" id="form" enctype="multipart/form-data">
				<div class="card-body">

					<div class="row">
						<div class="col-lg-6"> 
							<div class="form-group">
								<label for="title">Title</label>
								<input type="text" class="form-control" id="title" name="title" placeholder="Title" required>
							</div>
							<div class="form-group">
								<label for="message">Message</label>
								<textarea type="text" class="form-control" id="message" name="message" placeholder="Message" required rows="4"></textarea>
							</div> 
							<div class="form-group">
								<label for="image">Image <small>(Optional)</small></label>
								<input type="file" class="form-control-file" name="image" id="image" onChange="readURLImage(this);">
							</div>
							<div class="form-group">
								<label for="url">Launch Url <small>(Optional open in browser phone)</small></label>
								<input type="url" class="form-control" id="url" name="url" placeholder="http://example.com">
							</div> 
						</div> 
						<div class="col-md-6">
							<div class="fDVyfF">
								<div class="sc-RpuvT dEwQFD">
									<div class="sc-dDJTWM fHlNKJ">
										<div class=" ZwMRE"><span class="sc-gDPesD gTWumr"></span><span class="sc-kxYOAa jIVepP">FlyWeb</span>

											<div class=" ZwMRE ">
												<span id="icon" class="sc-guUSXb fEaDjt"></span>
											</div>
										</div>
										<div class="sc-lhGUXL dcTGzQ">
											<div class="sc-efAmGo hlCnSV">
												<div class="sc-dqvjwr cDaNjW">
													<div class="sc-bNpCPZ bLcLfs" id="titleOneSignal">Title</div>
													<div class="sc-lfEzOC hPcIuM" id="messageOneSignal">Message Body</div>
												</div>
											</div>
											<img id="imgOneSignal" class="image sc-ecFaGM dvJxIe">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> 
					<button type="submit" class="btn btn-primary btn-icon-split">
						<span class="icon text-white-50">
							<i class="fas fa-paper-plane"></i>
						</span>
						<span class="text">Send</span>
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
				title: {
					required: true,
				}
			},
			messages: {
				title: {
					required: "Please enter a title",
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

		$("#title").on('change paste keyup', function() {
			var titleValue = $(this).val();
			$('#titleOneSignal').text(titleValue)
		});

		$("#message").on('change paste keyup', function() {
			var contentValue = $(this).val();
			$('#messageOneSignal').text(contentValue);
		});

		$(".dEwQFD").click(function() {
			if (document.getElementById("image").files.length != 0) {
				let block = $('#imgOneSignal').css('display');
				if (block == "block") {
					$("#imgOneSignal").css("display", "none");
					$('#icon').css({
						'transform': 'rotate(0deg)'
					});
				} else if (block == "none") {
					$("#imgOneSignal").css("display", "block");
					$('#icon').css({
						'transform': 'rotate(180deg)'
					});

				}
			}
		});
	});
 
	function readURLImage(input) {
		var ext = input.files[0]['name'].substring(input.files[0]['name'].lastIndexOf('.') + 1).toLowerCase();
		if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg"))
			var reader = new FileReader();
		reader.onload = function(e) {
			$('#imgOneSignal').attr('src', e.target.result);
		}

		reader.readAsDataURL(input.files[0]);
		$("#imgOneSignal").css("display", "block");
		$('#icon').css({
			'transform': 'rotate(180deg)',
			'width': '15px'
		});
	}
</script>