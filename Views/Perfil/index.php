<?php
$id_usuario = $_SESSION["usuario"];
$nombre = $_SESSION["nombre"];
$correo = $_SESSION["correo"];
$fecha = $_SESSION["fecha"];
?>
<?php include "Views/Templates/header.php"; ?>
<br>
<div class="row">
    <div class="col-xl-4 col-md-6">
        <div class="card" id="cardPerfil">
            <div class="card-body d-flex flex-column text-black text-center" id="perfilBody">
                <div class=" align-items-center justify-content-center">
                <img src="Img/Perfil.png" height="100px">
                  <!--  <i class="fas fa-user fa-2x ml-auto" id="iconoPerfil"></i> -->
                    <div class="text-perfil">
                        <span id="nombreusuario" class="mayusculas">
                            <?php echo $nombre ?>
                          
                        </span>
                        <hr class="linea-divisoria">
                        <label for=""><b style="margin: 60px;" id="b-perfil">Correo: </b><span class="spanperfil">
                                <?php echo $correo ?>
                            </span></label>
                        <hr class="linea-divisoria">
                        <label for=""><b style="margin: 60px;" id="b-perfil">F.registro: </b><span class="spanperfil">
                                <?php echo $fecha ?>
                            </span></label>
                        <hr class="linea-divisoria">


                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-8 col-md-12" style="height: 400px;">



            <form onsubmit="frmPass(event);" id="frmPass" style="height: 400px; background-color: white;">
            <h3 style="color: rgb(0, 123, 255); ">Nueva Contraseña <i class="fas fa-key"></i></h3>
                <div class="form-group">
                    <label for="actual" class="obligatorio">Contraseña Actual</label>
                    <input id="actual" class="form-control" type="password" name="actual">
                </div>
                <div class="form-group">
                    <label for="nueva" class="obligatorio">Nueva Contraseña</label>
                    <input id="nueva" class="form-control" type="password" name="nueva">
                </div>
                <div class="form-group">
                    <label for="confirmarC" class="obligatorio">Confirmar Contraseña</label>
                    <input id="confirmarC" class="form-control" type="password" name="confirmarC">
                </div>
                <button class="btn" id="botonact" type="submit">Modificar  <i class="fas fa-pencil-alt"></i></button>
            </form>



    </div>

    <?php include "Views/Templates/footer.php"; ?>