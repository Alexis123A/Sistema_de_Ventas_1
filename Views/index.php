<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Iniciar Secion</title>
    <link href="<?php echo base_url; ?>Assets/css/styles.css" rel="stylesheet" />
    <script src="<?php echo base_url; ?>Assets/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">INICIAR SECION</h3>
                                </div>
                                <div class="card-body">
                                    <form id="frmLogin">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="usuario" type="email" placeholder="Correo"
                                                name="usuario" />
                                            <label for="usuario"><i class="fas fa-user"></i> Correo</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="pass" type="password"
                                                placeholder="Contraseña" name="pass" />
                                            <label for="passs"><i class="fas fa-lock"></i> Contraseña</label>
                                        </div>
                                        <div class="alert alert-danger text-center d-none" role="alert" id="alerta">

                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a class="small" href="password.html">Olvide mi Contraseña</a>
                                            <!--<a class="btn btn-primary" href="index.html">Ingresar</a>-->
                                            <button class="btn btn-primary" type="submit"
                                                onclick="frmLogin(event);">INICIAR <i
                                                    class="fas fa-arrow-right"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted"><strong>Copyright &copy; 2024 <a href="">Sistema de Ventas</a> </strong>
                        </div>
                        <div>
                            <a href="#">Politicas de Privacidad</a>
                            &middot;
                            <a href="#">Terminos &amp; Condiciones</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="<?php echo base_url; ?>Assets/js/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
    <script src="<?php echo base_url; ?>Assets/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="<?php echo base_url; ?>Assets/js/scripts.js"></script>
    <script>
        const base_url = "<?php echo base_url; ?>"
    </script>
    <script src="<?php echo base_url; ?>Assets/js/inicio.js"></script>

</body>

</html>