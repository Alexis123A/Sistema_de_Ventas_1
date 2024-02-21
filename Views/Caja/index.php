<?php
include "Views/Templates/header.php";
?>
<br>
<button class="btn btn-primary mb-2" type="button" onclick="frmCaja();"><i class="fas fa-plus"></i></button>
<table class="table table-light" id="tblCaja" style="width: 100%;">
    <thead class="thead-light">
        <tr>
            <th>Id</th>
            <th>Caja</th>
            <th>Estado</th>
            <th></th>

        </tr>
    </thead>
</table>

<!--Nuevo Usuario-->
<div id="nueva_caja" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: rgb(0, 123, 255);">
                <h5 class="modal-title text-white" id="title">Nueva Caja</h5>
            </div>
            <div class="modal-body">
                <form method="post" id="frmCaja">
                    <div class="form-group">
                        <label for="caja" class="obligatorio">Caja</label>
                        <!----> <input type="hidden" id="idies" name="idies">
                        <input id="caja" class="form-control" type="text" name="caja" placeholder="Nombre de la Caja">
                        <br>
                        <button id="btnAcion" class="btn" type="button" onclick="registrarCaja(event);">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
include "Views/Templates/footer.php";
?>