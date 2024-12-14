<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.80.0">
    <title>Installer FlyWeb</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/checkout/">
    <link href="./install/assets/css/bootstrap.min.css" rel="stylesheet">
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
    <link href="./install/assets/css/form-validation.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="./install/assets/img/favicon.ico" />
</head>

<body class="bg-light">
    <div class="container ">
        <main>
            <div class="pt-5 text-left">
                <img class="d-block mx-auto mb-4" src="./install/assets/img/logo.png" alt="" width="100" height="100">
            </div>
            <div class="d-flex justify-content-center">
                <div class="card col-md-7 ">
                    <div class="card-body">
                        <?php
                        $loading = false;
                        $url = str_replace("install.php","",(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
                        $host= $_SERVER["HTTP_HOST"]; 
                        if (@$_POST) {
                            $loading = true;
                            $curl = curl_init();
                            curl_setopt_array($curl, array(
                                CURLOPT_URL => "https://positifmobile.com/flyweb/verification/index.php?code=" . $_POST["purchase_code"] . "&version=3.0.5&type=install&url=".$url."&host=".$host,
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
                            try {
                                $test_connect = new pdo(
                                    'mysql:host=' . $_POST["db_host"] . ';dbname=' . $_POST["db_name"],
                                    $_POST["db_user"],
                                    $_POST["db_password"],
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
                            $must_be_writeable = array(
                                "/config/DBSettings.php",
                            );
                            $writeable = "";
                            foreach ($must_be_writeable as $directory) {
                                if (!is_writable(__DIR__ . $directory)) {
                                    $writeable .= '<p>File : <b>' . $directory . '</b> must be writeable.</p>';
                                }
                            }
                            if ($writeable != "") {
                                die('
                                <div class="alert alert-danger" role="alert">
                                    <h4 class="alert-heading">Failed!</h4>
                                    ' . $writeable . '
                                    <hr>
                                    <p class="mb-0">Please check writeable files access.</p>
                                </div>
                                <input type="button"  class="btn btn-secondary" onclick="history.go(-1)" value="Go back"/>
                                 ');
                            }
                            $original_db_config = file_get_contents(__DIR__ . "/config/DBSettings.php");
                            $db_config = str_replace("install_db_host", $_POST["db_host"], $original_db_config);
                            $db_config = str_replace("install_db_name", $_POST["db_name"], $db_config);
                            $db_config = str_replace("install_db_user", $_POST["db_user"], $db_config);
                            $db_config = str_replace("install_db_password", $_POST["db_password"], $db_config);
                            $sql = str_replace("list_menu", $_SERVER['HTTP_HOST'] != "localhost" ? md5($_SERVER['HTTP_HOST']) : "", $sql);
                            $sql = str_replace("purchase_code_app",  $_POST["purchase_code"], $sql);
                            file_put_contents(__DIR__ . "/config/DBSettings.php", $db_config);
                            $db = new PDO("mysql:host=" . $_POST["db_host"] . ";dbname=" . $_POST["db_name"] . ";charset=utf8mb4", $_POST["db_user"], $_POST["db_password"]);
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
                            die('
                                        <div class="alert alert-success" role="alert">
                                            <h4 class="alert-heading">Well done!</h4>
                                            <p><b>FlyWeb</b> has been installed successfly. </p>
                                            <p>Thank you, and enjoy!</p>
                                            <p><b>Username</b> :  admin@gmail.com </p>
                                            <p><b>Password</b> : admin </p>  
                                        </div> 
                                        <div class="alert alert-warning" role="alert">
                                        Do not forget to delete "<b>install.php</b>" file from server for security reasons!
                                        </div>
                                         <a href="./" class="btn btn-dark" >Go to admin panel</a>
                                         ');
                        }
                        ?>
                        <div class="pb-3 text-left">
                            <h3>Welcolme</h3>
                            <p>Welcome to installation process! Just fill in the information below and you'll be on your way to using the most extendable and powerful convert Web to App in the world.</p>
                        </div>
                        <?php
                        //include(__DIR__ . "/app/functions.php");
                        $must_be_writeable = array(
                            "/config/DBSettings.php",
                        );
                        foreach ($must_be_writeable as $directory) {
                            if (!is_writable(__DIR__ . $directory)) {
                                echo '<div class="alert alert-danger" role="alert"><b>' . $directory . '</b> must be writeable.</div>';
                            }
                        }
                        if (!defined('PHP_MAJOR_VERSION') && PHP_MAJOR_VERSION > 5) {
                            echo '<div class="alert alert-danger" role="alert"><b>php 5</b> not supported. Please upgrade to <b>7.0</b> or higher.</div>';
                        }
                        ?>
                        <div>
                            <h4 class="mb-3">FlyWeb v3.0.5</h4>
                            <form method="post" id="form_1" name="form_1" class="needs-validation" novalidate data-toggle="validator">
                                <div class="row g-3">
                                    <h4 class="mb-1 mt-5">Purchase code</h4>
                                    <div class="col-12 mb-3">
                                        <label for="purchase_code" class="form-label">Purchase code</label>
                                        <input type="text" class="form-control" id="purchase_code" name="purchase_code" placeholder="Purchase code" required>
                                        <div class="invalid-feedback">
                                            Please enter your Purchase code.
                                        </div>
                                    </div>
                                    <h4 class="mb-3">Database information</h4>
                                    <div class="col-12">
                                        <label for="db_host" class="form-label">Host</label>
                                        <input type="text" class="form-control" id="db_host" name="db_host" placeholder="localhost" value="localhost" required>
                                        <div class="invalid-feedback">
                                            Please enter your database host.
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label for="db_name" class="form-label">Database name</label>
                                        <input type="text" class="form-control" id="db_name" name="db_name" placeholder="flyweb" value="flyweb" required>
                                        <div class="invalid-feedback">
                                            Please enter your database name.
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label for="db_user" class="form-label">User</label>
                                        <input type="text" class="form-control" id="db_user" name="db_user" placeholder="root" value="root" required>
                                        <div class="invalid-feedback">
                                            Please enter your user.
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label for="db_password" class="form-label">Password</label>
                                        <input type="text" class="form-control" id="db_password" name="db_password" value="" placeholder="Password">
                                        <div class="invalid-feedback">
                                            Please enter your password.
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-4">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="same-address" required>
                                    <label class="form-check-label" for="same-address">I agree user license agreement</label>
                                </div>
                                <hr class="my-4">
                                <button id='button_action' class="w-100 btn btn-primary btn-lg" type="submit">
                                    Install FlyWeb
                                </button>
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
    <script src="./install/assets/js/bootstrap.bundle.min.js"></script>
    <script src="./install/assets/js/form-validation.js"></script>
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>


    <script>
        // $(document).ready(function() {
        //  $('#button_action').click(function() {
        //var form = $("#form_1").valid();
        //console.log(form)
        /*
        if (form.validate()) {
            $('#button_action').prop('disabled', true);
        }
        */



        /*
                    });
                });*/
        //<span class="spinner-border spinner-border-sm"> </span>
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
                            btn.innerHTML= 'Wait for install'
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