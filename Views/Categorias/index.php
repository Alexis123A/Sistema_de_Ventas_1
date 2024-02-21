<?php
include "Views/Templates/header.php";
?>
<br>
<button class="btn btn-primary mb-2" type="button" onclick="frmCategorias();"><i class="fas fa-plus"></i></button>
<br>
<br>
<table class="table table-light" id="tblCategorias" style="width: 100%;">
    <thead class="thead-light">
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Estado</th>
            <th></th>
        </tr>
    </thead>
</table>

<!--Nuevo Usuario-->
<div id="nueva_categorias" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: rgb(0, 123, 255);">
                <h5 class="modal-title text-white" id="title">Nueva Categoria</h5>
            </div>
            <div class="modal-body">
                <form method="post" id="frmCategorias">
                    <div class="form-group">
                        <label for="categorias" class="obligatorio">Categoria</label>
                        <!----> <input type="hidden" id="idies" name="idies">
                        <input id="categorias" class="form-control" type="text" name="categorias"
                            placeholder="Nombre de la Categoria">
                        <br>
                        <button id="btnAcion" class="btn" type="button"
                            onclick="registrarCategorias(event);">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
include "Views/Templates/footer.php";
?>