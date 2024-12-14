<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.80.0">
    <title>Update FlyWeb</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/checkout/">

    <!-- Bootstrap core CSS -->
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="./assets/css/form-validation.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="./assets/img/favicon.ico" />
</head>

<body class="bg-light">

    <div class="container ">
        <main>
            <div class="pt-5 text-left">
                <img class="d-block mx-auto mb-4" src="./assets/img/logo.png" alt="" width="100" height="100">
            </div>
            <div class="d-flex justify-content-center">
                <div class="card col-md-7 ">
                    <div class="card-body">
                        <?php
                        function rrmdir($dir)
                        {
                            if (is_dir($dir)) {
                                $files = scandir($dir);
                                foreach ($files as $file)
                                    if ($file != "." && $file != "..") rrmdir("$dir/$file");
                                rmdir($dir);
                            } else if (file_exists($dir)) unlink($dir);
                        }

                        // Function to Copy folders and files       
                        function rcopy($src, $dst)
                        {
                            if (file_exists($dst))
                                rrmdir($dst);
                            if (is_dir($src)) {
                                mkdir($dst);
                                $files = scandir($src);
                                foreach ($files as $file)
                                    if ($file != "." && $file != "..")
                                        rcopy("$src/$file", "$dst/$file");
                            } else if (file_exists($src))
                                copy($src, $dst);
                        }

                        if (@$_POST) {

                            $url = str_replace("install.php","",(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
                            $host= $_SERVER["HTTP_HOST"]; 

                            $curl = curl_init();

                            curl_setopt_array($curl, array(
                                CURLOPT_URL => "https://positifmobile.com/flyweb/verification/index.php?code=" . $_POST["purchase_code"] . "&version=3.0.5&type=update&version_update=3.0.4&url=".$url."&host=".$host,
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_ENCODING => '',
                                CURLOPT_MAXREDIRS => 10,
                                CURLOPT_TIMEOUT => 0,
                                CURLOPT_FOLLOWLOCATION => true,
                                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                CURLOPT_CUSTOMREQUEST => 'GET',
                            ));

                            $response = curl_exec($curl);
                            $info = curl_getinfo($curl);
                            
                            if ($info["http_code"] == "200") {
                                $sql = $response;
                            } else {
                                die('
                                <div class="alert alert-danger" role="alert">
                                    <h4 class="alert-heading">Failed!</h4>
                                    <p>Aww yeah, your <b>purchase code</b> not correct.</p>
                                    <hr>
                                    <p class="mb-0">Please check codecanyon.</p>
                                </div>
                                <input type="button"  class="btn btn-secondary" onclick="history.go(-1)" value="Go back"/>
                                 ');
                            }

                            if (is_file("../config/DBSettings.php")) {
                                require_once("../config/DBSettings.php");
                            }

                            try {

                                $settings_db = new DatabaseSettings();
                                $settings = $settings_db->getSettings();

                                $test_connect = new pdo(
                                    'mysql:host=' . $settings['dbhost'] . ';dbname=' . $settings['dbname'],
                                    $settings['dbusername'],
                                    $settings['dbpassword'],
                                    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
                                );
                            } catch (PDOException $ex) {
                                die('
                                <div class="alert alert-danger" role="alert">
                                    <h4 class="alert-heading">Failed!</h4>
                                    <p>Aww yeah, could not connect to the <b>database</b>.</p>
                                    <hr>
                                    <p class="mb-0">Please check credentials.</p>
                                </div>
                                <input type="button"  class="btn btn-secondary" onclick="history.go(-1)" value="Go back"/>
                                 ');
                            }

                            $db = new PDO(
                                'mysql:host=' . $settings['dbhost'] . ';dbname=' . $settings['dbname'] . ";charset=utf8mb4",
                                $settings['dbusername'],
                                $settings['dbpassword']
                            );

                            //$sql = file_get_contents(__DIR__ . '/db_update.sql');

                            /* $cmd = 'SELECT * FROM settings WHERE id ="1"';
                            $stmt = $db->query($cmd); */
                            /*
                            $id = "1";
                            $stmt = $db->prepare("SELECT * FROM settings WHERE id=? LIMIT 1");
                            $stmt->execute([$id]);
                            $set = $stmt->fetch();

                            $db_config = str_replace("#7b50dc", $set["firstColor"], $sql);
                            $db_config = str_replace("#597ae2", $set["secondColor"], $db_config);
                            $db_config = str_replace("list_menu", md5($_SERVER['HTTP_HOST']), $db_config);
                            $db_config = str_replace("purchase_code_app", $_POST["purchase_code"], $db_config);
                             try {
                                $qr = $db->exec($db_config);
                            } catch (\Throwable $th) {
                                die('
                                <div class="alert alert-warning" role="alert">
                                    <h4 class="alert-heading">Already Install!</h4> 
                                    <p>Thank you, and enjoy!</p> 
                                </div> 
 
                                 <a href="./" class="btn btn-dark" >Go to admin panel</a>
 
                                 ');
                            }
                            */
                            
                                 try {
                                $qr = $db->exec($sql);
                            } catch (\Throwable $th) {
                                die('
                                <div class="alert alert-warning" role="alert">
                                    <h4 class="alert-heading">Already Install!</h4> 
                                    <p>Thank you, and enjoy!</p> 
                                </div> 
 
                                 <a href="./" class="btn btn-dark" >Go to admin panel</a>
 
                                 ');
                            }
                            
                            
 
                            /** All Versions */
                            rcopy( './api', '../api');
                            rcopy( './controllers', '../controllers'); 
                            rcopy('./views', '../views');

                            /** for create folder */
                            //mkdir("../images/boarding", 0777); 

                            /** copie to new folder */
                            //rcopy( '/update/images/boarding', '../images/boarding'); 

                            /** copie files to folder */
                            /*
                            rcopy('./images/floating/circular.png', '../images/floating/circular.png');
                            rcopy('./images/floating/regular.png', '../images/floating/regular.png');
                            rcopy('./images/settings/logo_drawer.png', '../images/settings/logo_drawer.png');
                            rcopy('./images/tab/circular.png', '../images/tab/circular.png');  
                            rcopy('./images/tab/regular.png', '../images/tab/regular.png');
                            */
 
                            /*
                            if (!file_exists("../images/floating"))
                                mkdir("../images/floating", 0777);
                            */
 
                            die('
                            <div class="alert alert-success" role="alert">
                                <h4 class="alert-heading">Well done!</h4>
                                <p><b>FlyWeb v3.0.5</b> has been updated successfly. </p>
                                <p>Thank you, and enjoy!</p>   
                            </div> 

                            <div class="alert alert-warning" role="alert">
                            Do not forget to delete "<b>update</b>" folder from server for security reasons!
                            </div>

                             <a href="../" class="btn btn-dark" >Go to admin panel</a>
                             ');
                        }
                        ?>
                        <div class="pb-3 text-left">
                            <h3>Welcolme</h3>
                            <p>Welcome to update process! </p>
                        </div>

                        <div>
                            <h4 class="mb-3">FlyWeb v3.0.4 to v3.0.5 </h4>
                            <form method="post" class="needs-validation" novalidate data-toggle="validator">
                                <div class="row g-3">

                                </div>

                                <div class="col-12 mb-3 mt-4">
                                    <label for="purchase_code" class="form-label">Purchase code</label>
                                    <input type="text" class="form-control" id="purchase_code" name="purchase_code" placeholder="Purchase code" required>
                                    <div class="invalid-feedback">
                                        Please enter your Purchase code.
                                    </div>
                                </div>
                                <hr class="my-4">

                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="same-address" required>
                                    <label class="form-check-label" for="same-address">I agree to update version.</label>
                                </div>

                                <hr class="my-4">
                                <input type="text" name="update" id="update" hidden />
                                <button id='button_action' class="w-100 btn btn-primary btn-lg" type="submit">Update FlyWeb</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </main>

        <footer class="my-5  text-muted text-center text-small">
            <p class="mb-1">&copy; PositifMobile (FlyWeb)</p>
        </footer>
    </div>


    <script src="./assets/js/bootstrap.bundle.min.js"></script>

    <script src="./assets/js/form-validation.js"></script>
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>


    <script>
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();

                            var errorElements = document.querySelectorAll(
                                "input.form-control:invalid");
                            errorElements.forEach(function(element) {
                                element.parentNode.childNodes.forEach(function(node) {
                                    if (node.className == 'valid-feedback') {
                                        node.className = 'invalid-feedback';
                                        node.innerText =
                                            'Please choose a Gender';
                                    }
                                });
                            });
                            try {
                                $('html, body').animate({
                                    scrollTop: $(errorElements[0]).offset().top
                                }, 0);
                            } catch (error) {
                                console.error(error);
                            }
                        } else {
                            var btn = document.getElementById("button_action");
                            btn.innerHTML = 'Wait for update'
                            btn.setAttribute("disabled", "disabled");
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
</body>

</html>