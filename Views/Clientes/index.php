<?php
include "Views/Templates/header.php";
?>
<br>
<button class="btn btn-primary mb-2" type="button" onclick="frmCliente();"><i class="fas fa-plus"></i></button>
<br>
<br>
<table class="table table-light" id="tblClientes" style="width: 100%;">
    <thead class="thead-light">
        <tr>
            <th>Id</th>
            <th>Cedula</th>
            <th>Nombre</th>
            <th>Telefono</th>
            <th>Direccion</th>
            <th>Estado</th>
            <th></th>

        </tr>
    </thead>
</table>
<br>

<!--Nuevo Usuario-->
<div id="nuevo_cliente" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: rgb(0, 123, 255);">
                <h5 class="modal-title text-white" id="title">Nuevo Cliente</h5>
            </div>
            <div class="modal-body">
                <form method="post" id="frmCliente">
                    <div class="form-group">
                        <label for="identificacion" class="obligatorio">Identificacion</label>
                        <!----> <input type="hidden" id="idies" name="idies">
                        <input id="identificacion" class="form-control" type="text" name="identificacion"
                            placeholder="Identificacion del Cliente">
                    </div>

                    <div class="form-group">
                        <label for="nombre" class="obligatorio">Nombre</label>
                        <input id="nombre" class="form-control" type="text" name="nombre"
                            placeholder="Nombre del Cliente">
                    </div>

                    <div class="form-group">
                        <label for="telefono" class="obligatorio">Telefono</label>
                        <input id="telefono" class="form-control" type="text" name="telefono"
                            placeholder="Telefono del Cliente">
                    </div>

                    <div class="form-group">
                        <label for="direccion" class="obligatorio">Direccion</label>
                        <textarea id="direccion" placeholder="Direccion del Cliente" class="form-control"
                            name="direccion" rows="3"></textarea>
                    </div>

                    <button id="btnAcion" class="btn" type="button" 
                        onclick="registrarCli(event);">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
include "Views/Templates/footer.php";
?>