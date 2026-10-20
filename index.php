<?php
    require_once __DIR__ . "/documents/app/core/bootstrap.php";

    // Si ya hay una sesión activa, ir directo al sistema.
    iniciar_sesion(true);
    if (sesion_valida()) {
        header("Location: documents/app/views/home.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Cardiología - Login</title>
        
        <!--FAVICON-->
        <link rel="shortcut icon" href="documents/assets/img/logo.png" type="image/x-icon">
        
        <!--BOOTSTRAP-->
        <link rel="stylesheet" href="documents/assets/css/bootstrap/bootstrap.min.css">

        <!--SWEETALERT-->
        <link rel="stylesheet" href="documents/assets/css/sweetalert/sweetalert2.min.css">

        <!--FONTAWESOME-->
        <link rel="stylesheet" href="documents/assets/css/fontawesome/all.min.css">

        <!--ANIMATE-->
        <link rel="stylesheet" href="documents/assets/css/animate/animate.min.css">

        <!--CSS-->
        <link rel="stylesheet" href="documents/assets/css/estilos/estilos.css">
        <link rel="stylesheet" href="documents/assets/css/estilos/login.css">
    </head>
    <body class="bg">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5 animate__animated animate__fadeInDown" style="background-color: #001d3d;"> <!--style="background-color: #001d3d;"-->
                                    <div class="card-header d-flex flex-column justify-content-center">
                                        <img src="documents/assets/img/main_logo.png" alt="MR" class="img_login">
                                        <h1 class="text-center font-weight-light my-4 text-light">CARDIOLOGÍA</h1>
                                    </div>
                                    <form id="formLogin" class="form" action="" method="post" onsubmit="return userLogin()">
                                        <div class="card-body">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" name="usuario" id="usuario" type="text" maxlength="20" autocomplete="username" autofocus placeholder="Ingrese su usuario" required>
                                                <label for="usuario">Usuario:</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" name="password" id="password" type="password" autocomplete="current-password" placeholder="Ingrese su contraseña" required>
                                                <label for="password">Contraseña:</label>
                                            </div>
                                        </div>
                                        <div class="card-footer text-center py-3">
                                            <input type="submit" name="submit" class="btn btn-primary shadow" value="INICIAR SESIÓN">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>

        <!--JQUERY-->
        <script src="documents/assets/js/jquery/jquery-3.6.3.min.js"></script>

        <!--BOOTSTRAP (incluye Popper)-->
        <script src="documents/assets/js/bootstrap/bootstrap.bundle.min.js"></script>

        <!--SWEETALERT-->
        <script src="documents/assets/js/sweetalert/sweetalert.min.js"></script>
        
        <!--JS-->
        <script src="script.js?v=<?php echo ASSET_VERSION;?>"></script>
        <script src="documents/assets/js/scripts/scripts.js"></script>
    </body>
</html>
