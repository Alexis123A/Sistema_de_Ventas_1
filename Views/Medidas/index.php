<?php
include "Views/Templates/header.php";
?>
<br>
<button class="btn btn-primary mb-2" type="button" onclick="frmMedidas();"><i class="fas fa-plus"></i></button>
<table class="table table-light" id="tblMedidas" style="width: 100%;">
<br><br>
    <thead class="thead-light">
        <tr>
            <th>Id</th>
            <th>Medida</th>
            <th>Medida Corta</th>
            <th>Estado</th>
            <th></th>
        </tr>
    </thead>
</table>

<!--Nuevo Usuario-->
<div id="nueva_medidas" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: rgb(0, 123, 255);">
                <h5 class="modal-title text-white" id="title">Nueva Medida</h5>
            </div>
            <div class="modal-body">
                <form method="post" id="frmMedidas">
                    <div class="form-group">
                        <label for="medidas" class="obligatorio">Medida</label>
                        <!----> <input type="hidden" id="idies" name="idies">
                        <input id="medidas" class="form-control" type="text" name="medidas"
                            placeholder="Nombre de la Medida">
                        <label for="medidas_corto" class="obligatorio">Medida Corta</label>
                        <input id="medidas_corto" class="form-control" type="text" name="medidas_corto"
                            placeholder="Nombre de la Medida Corta">
                        <br>
                        <button id="btnAcion" class="btn" type="button" 
                            onclick="registrarMedidas(event);">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
include "Views/Templates/footer.php";
?>