
<!doctype html>
<html lang="es">

<head>
    <title>SSST</>::Acceso</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="src/public/css/style.css">

</head>

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10">
                    <div class="wrap d-md-flex">
                        <div class="img p-3" >
                        <img src="src/public/img/DIF_LOGO-01.png" style="width: 100%;"/>
                        </div>
                        <div class="login-wrap p-4 p-md-5">
                            <div class="d-flex">
                                <div class="w-100">
                                    <h3 class="text-center ">Sistema de Seguridad y Salud en el Trabajo (SSST)</h3>
                                </div>

                                <?php
                                if (isset($mensaje)) {
                                    switch ($mensaje) {
                                        case "1";
                                ?>
                                            <div class="alert alert-danger" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <div class="d-flex align-items-center justify-content-start">
                                                    <i class="icon ion-ios-checkmark alert-icon tx-32 mg-t-5 mg-xs-t-0"></i>
                                                    <span>El usuario y/o contraseña son incorrectos.</span>
                                                </div>
                                            </div>
                                        <?php
                                            break;

                                        case "2";
                                        ?>
                                            <div class="alert alert-danger" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <div class="d-flex align-items-center justify-content-start">
                                                    <i class="icon ion-ios-checkmark alert-icon tx-32 mg-t-5 mg-xs-t-0"></i>
                                                    <span>Los campos estan vacios.</span>
                                                </div>
                                            </div>
                                <?php
                                            break;
                                    }
                                }
                                ?>

                            </div>

                            <div class="text-center mb-4">
                                <div>
                                    <img src="src/public/img/hidalgo-02.png" width="200" height="120" position: fixed;>
                                </div>
                            </div>

                            <form class="sign-box" action="/log" method="post" id="login_form">
                                <div class="form-group mb-3">
                                    <label class="label" for="name">Usuario</label>
                                    <input type="text" id="nombre_usuario" name="nombre_usuario" class="form-control" placeholder="Ingresa nombre de usuario" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label" for="password">Contraseña</label>
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Ingresa contraseña" required>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="form-control btn btn-primary rounded submit px-3">Iniciar sesión</button>
                                </div>

                        </div>

                    </div>
                    </form>

                </div>
            </div>
        </div>

        </div>
        </div>
    </section>
    <script src="src/public/js/jquery.min.js"></script>
    <script src="src/public/js/popper.min.js"></script>
    <script src="src/public/js/bootstrap.min.js"></script>
    <script src="src/public/js/main.js"></script>

</body>

</html>