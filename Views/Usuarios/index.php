<?php
include "Views/Templates/header.php";
?>
<br>
<button class="btn btn-primary" type="button" onclick="frmUsuario();"><i class="fas fa-plus"></i></button>

<br>
<br>
<table class="table table-light" id="tblUsuarios" style="width: 100%;">
    <thead class="thead-light">
        <tr>
            <th>Id</th>
            <th>Usuario</th>
            <th>Correo</th>
            <th>Nombre</th>
            <th>Caja</th>
            <th>Estado</th>
            <th></th>
        </tr>

    </thead>
    <tbody>
    </tbody>
</table>
<!--Nuevo Usuario-->
<div id="nuevo_usuario" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: rgb(0, 123, 255);">
                <h5 class="modal-title text-white" id="title">Nuevo Usuario</h5>
            </div>
            <div class="modal-body">
                <form method="post" id="frmUsuario">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="usuario" class="obligatorio">Usuario</label>
                                <!----> <input type="hidden" id="idies" name="idies">
                                <input id="usuario" class="form-control" type="text" name="usuario"
                                    placeholder="Usuario" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="correo" class="obligatorio">Correo</label>
                                <input id="correo" class="form-control" type="email" name="correo"
                                    placeholder="Correo" required>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="nombre" class="obligatorio">Nombre</label>
                        <input id="nombre" class="form-control" type="text" name="nombre"
                            placeholder="Nombre del Usuario">
                    </div>

                    <div class="row" id="claves">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pass" class="obligatorio">Contraseña</label>
                                <input id="pass" class="form-control" type="password" name="pass"
                                    placeholder="Contraseña">
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="confirmar" class="obligatorio">Confirmar Contraseña</label>
                                <input id="confirmar" class="form-control" type="password" name="confirmar"
                                    placeholder="Confirmar Contraseña">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="caja">Caja</label>
                        <select id="caja" class="form-control" name="caja">
                            <?php foreach ($data['cajas'] as $row) { ?>
                                <option value="<?php echo $row['id']; ?>">
                                    <?php echo $row['caja']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <br>
                    <button id="btnAcion" class="btn" type="button" onclick="registrarUser(event);"><i
                            class="fas fa-save"></i>Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
include "Views/Templates/footer.php";
?>