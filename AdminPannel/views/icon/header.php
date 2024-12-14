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
		<h1 class="h3 mb-0 text-gray-800">Header Config</h1>
		<ol class="breadcrumb float-sm-right">
			<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
			<li class="breadcrumb-item active">Header Config</li>
		</ol>
	</div>

	<div>
		<div class="card shadow mb-4">
			<!-- Card Header - Dropdown -->
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-primary">Header Config</h6>
			</div>
			<!-- Card Body -->
			<form method="post" action="" id="form" enctype="multipart/form-data">
 
				<div class="card-body">
					<div class="row">
					



          <div class="col-md-6"> 
          <!-- Color Picker -->
          <div class="form-group">
              <label>First Color: </label>
              <div class="input-group firstColor">
                  <input type="text" class="form-control" id="firstColor" name="firstColor" value="<?= $data["firstColor"] ?>">

                  <div class="input-group-append">
                      <span class="input-group-text"><i class="fas fa-square" style="color:<?= $data['firstColor'] ?>"></i></span>
                  </div>
              </div> 
              <small>( NB: Color #FF0000 )</small>
              <!-- /.input group -->
          </div>

          <!-- Color Picker -->
          <div class="form-group">
              <label>Second Color:</label> 
              <div class="input-group secondColor">
                  <input type="text" class="form-control" id="secondColor" name="secondColor" value="<?= $data['secondColor'] ?>">

                  <div class="input-group-append">
                      <span class="input-group-text"><i class="fas fa-square" style="color:<?= $data['secondColor'] ?> "></i></span>
                  </div>
              </div>
              <small>( NB: Color #FF0000 )</small>
              <!-- /.input group -->
          </div>



          <!-- Color Picker -->
          <div class="form-group">
              <label>Icon Color:</label> 
              <div class="input-group iconColor">
                  <input type="text" class="form-control" id="iconColor" name="iconColor" value="<?= $data['iconColor'] ?>">

                  <div class="input-group-append">
                      <span class="input-group-text"><i class="fas fa-square" style="color:<?= $data['iconColor'] ?> "></i></span>
                  </div>
              </div>
              <small>( NB: Color #FF0000 )</small>
              <!-- /.input group -->
          </div>


		     <!-- Color Picker -->
			 <div class="form-group">
              <label>Icon Color Dark Mode:</label> 
              <div class="input-group iconColor_dark">
                  <input type="text" class="form-control" id="iconColor_dark" name="iconColor_dark" value="<?= $data['iconColor_dark'] ?>">

                  <div class="input-group-append">
                      <span class="input-group-text"><i class="fas fa-square" style="color:<?= $data['iconColor_dark'] ?> "></i></span>
                  </div>
              </div>
              <small>( NB: Color #FFFFFF )</small>
              <!-- /.input group -->
          </div>



          <!-- Color Picker -->
          <div class="form-group">
              <label  for="height_header" >Height Header:</label> 
              <div class="input-group ">
                  <input type="text" name="height_header" id="height_header" class="form-control" value="<?= $data['height_header'] ?>"> 
              </div>
              <small>( NB: example 60 )</small>
              <!-- /.input group -->
          </div>
 
							<div class="form-group">
								<label for="navigatin_bar_style">Select navigatin bar style</label>
								<select class="form-control navigatin_bar_style" id="navigatin_bar_style" name="navigatin_bar_style" style="width: 100%;">
									<?php
									foreach ($navigatin_option as $option) {
									?>
										<option value="<?= $option['value'] ?>" <?php echo ($option['value'] == $data['navigatin_bar_style']) ? ' selected="selected"' : ''; ?>><?= $option["title"] ?></option>
									<?php } ?>
								</select>
							</div>
              <div class="form-group">
								<label for="type_header">Select type header </label>
								<select class="form-control" id="type_header" name="type_header" style="width: 100%;">
									<?php
									foreach ($title_option as $option) {
									?>
										<option value="<?= $option['value'] ?>" <?php echo ($option['value'] == $data['type_header']) ? ' selected="selected"' : ''; ?>><?= $option["title"] ?></option>
									<?php } ?>
								</select>
							</div> 


              <div class="form-group">
               <label for="logo_header">Logo Header</label>
               <div class="input-group">
                 <div class="custom-file">
                   <input type="file" class="custom-file-input" id="logo_header" name="logo_header" onChange="readURLLogo(this);">
                   <label class="custom-file-label" for="logo_header">Choose file</label>
                 </div>
               </div>
             </div>
             <div class="form-group">
               <img src="../images/settings/<?= $data["logo_header"] ?>?<?= time() ?>" style="width:100px; background-color: #bdbdbd" id="thumb_img_logo" class="img-thumbnail">
             </div>


        </div>



 
							     <!-- /.col -->
                   <div class="col-md-6"> 
                    <label>Preview:</label>
                    <div class="linearGradient" style="
                    height: 20px;
                    background: linear-gradient(135deg, <?= $data['firstColor'] ?> , <?= $data['secondColor'] ?>);
                    border-top-width: 2px;
                    border-top-style: solid;
                    border-right-width: 2px;
                    border-right-style: solid;
                    border-left-width: 2px;
                    border-left-style: solid;
                    border-color: black;">
                        <div class="d-flex justify-content-between">
                            <img src="../img/part1.png" style="height:15px;" />
                            <img src="../img/part2.png" style="height:15px;" />
                            <img src="../img/part3.png" style="height:15px;" />
                        </div>
                    </div>

                    
                    <!-- icon 1 -->
                    <div id="preview_logo" style=" 
  									    z-index: 2;
								        width: 100%;
								        height: 100%;
										overflow: auto;
										margin: auto;
										position: absolute;   
										left: calc(5% ); 
                    right: calc(5% ); 
										align-items: center;
										<?php echo ($data["enable_logo"] == "0") ? ' display : none ' : ''; ?>
 									  ">
                    <div class="iconHeader" style=' 
                    width:30px;
                    height:30px;
                    display:inline-block;
                    background:<?= $data["iconColor"] ?>;
                    -webkit-mask:url("../images/left_navigation_icon/icon_left_100.png?<?= time() ?>") center/contain;
                            mask:url("../images/left_navigation_icon/icon_left_100.png?<?= time() ?>") center/contain;
                            mask-repeat: no-repeat;  
                            -webkit-mask-repeat: no-repeat; 
                    '>
                  </div> 
									  </div>


                    <!-- logo -->
                    <div id="preview_logo" style=" 
  									    z-index: 2;
								        width: 100%;
								        height: 100%;
										overflow: auto;
										margin: auto;
										position: absolute;   
										left: calc(50% - (70px)); 
                    right: calc(50% - (70px)); 
										align-items: center;
										<?php echo ($data["enable_logo"] == "0") ? ' display : none ' : ''; ?>
 									  ">
										<img src="../images/settings/<?= $data["logo_header"] ?>?<?= time() ?>" 
                     style="width:140px; height:40px ; object-fit:contain;" 
                     id="preview_img_logo"
                      />
									  </div>
                    <!-- end logo -->


                    <!-- icon 2 -->
                    <div id="preview_logo" style=" 
  									    z-index: 2;
								        width: 100%;
								        height: 100%;
										overflow: auto;
										margin: auto;
										position: absolute;   
										left: calc(87% ); 
                    right: calc(5% ); 
										align-items: center;
										<?php echo ($data["enable_logo"] == "0") ? ' display : none ' : ''; ?>
 									  ">
                    <div class="iconHeader"  style=' 
                    width: 30px;
                    height:30px;
                    display:inline-block;
                    background:<?= $data["iconColor"] ?>;
                    -webkit-mask:url("../images/left_navigation_icon/icon_right_100.png?<?= time() ?>") center/contain;
                            mask:url("../images/left_navigation_icon/icon_right_100.png?<?= time() ?>") center/contain;
                            mask-repeat: no-repeat;  
                            -webkit-mask-repeat: no-repeat; 
                    '>
                  </div> 
									  </div>


                    <div class="linearGradient" style="
                    border-bottom-width: 2px;
                    border-bottom-style: solid;
                    border-right-width: 2px;
                    border-right-style: solid;
                    border-left-width: 2px;
                    border-left-style: solid;
                    border-color: black;
                    height: 55px;
                    background: linear-gradient(135deg, <?= $data['firstColor'] ?> , <?= $data['secondColor'] ?>);"></div>

                    </div>
                    <!-- /.col --> 

 
					</div> 
				</div> 
				<div class="card-body"> 
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


<script>
   $("#hsvflat").ColorPickerSliders({
        color: "rgb(36, 170, 242)",
        flat: false,
        sliders: false,
        swatches: false,
        hsvpanel: false
    });
    $("input#backgroundColor").ColorPickerSliders({
        hsvpanel: true,    
        flat: false,
        sliders: false,
        swatches: false,
        previewformat: 'hex',
        onchange: function(container, color) {
            $('.statusBarColor .fa-square').css('color', color.tiny.toHexString());
            $('.statusBar').css('background', color.tiny.toHexString());
        }
    });
    $("input#secondColor").ColorPickerSliders({
        hsvpanel: true,    
        flat: false,
        sliders: false,
        swatches: false,
        previewformat: 'hex',
        onchange: function(container, color) {
            $('.secondColor .fa-square').css('color', color.tiny.toHexString());
            $('.linearGradient').css('background', 'linear-gradient(135deg, ' + $("#firstColor").val() + ', ' + color.tiny.toHexString() + ' )');
        }
    });
    $("input#firstColor").ColorPickerSliders({
        hsvpanel: true,    
        flat: false,
        sliders: false,
        swatches: false,
        previewformat: 'hex',
        onchange: function(container, color) {
            $('.firstColor .fa-square').css('color', color.tiny.toHexString());
            $('.linearGradient').css('background', 'linear-gradient(135deg,  ' + color.tiny.toHexString() + ', ' + $("#secondColor").val() + ' )');
        }
    });
    $("input#iconColor").ColorPickerSliders({
        hsvpanel: true,    
        flat: false,
        sliders: false,
        swatches: false,
        previewformat: 'hex',
        onchange: function(container, color) {
            $('.iconColor .fa-square').css('color', color.tiny.toHexString());
            $('.iconHeader').css('background', color.tiny.toHexString() );
        }
    });
    $("input#iconColor_dark").ColorPickerSliders({
        hsvpanel: true,    
        flat: false,
        sliders: false,
        swatches: false,
        previewformat: 'hex',
        onchange: function(container, color) {
            $('.iconColor_dark .fa-square').css('color', color.tiny.toHexString()); 
        }
    });

 
</script>

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