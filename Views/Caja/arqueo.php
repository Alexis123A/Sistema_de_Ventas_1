<?php
include "Views/Templates/header.php";
?>
<br>
<div class="row">
    <div class="col-md-4">

        <button class="btn btn-primary mb-2" type="button" onclick="frmarqueo();"><i class="fas fa-plus"></i></button>
        <button class="btn btn-warning mb-2" type="button" onclick="Cerrarcaja();">Cerrar Caja</button>
    </div>
</div>
<table class="table table-light" id="t_arqueo" style="width: 100%;">
    <thead class="thead-light">
        <tr>
            <th>Id</th>
            <th>Monto Inicial</th>
            <th>Monto Final</th>
            <th>Fecha Apertura</th>
            <th>Fecha Cierre</th>
            <th>Total Ventas</th>
            <th>Monto Total</th>
            <th>Estado</th>

        </tr>
    </thead>
</table>

<!--Nuevo Usuario-->
<div id="abrir_caja" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: rgb(0, 123, 255);">
                <h5 class="modal-title text-white" id="title">Apertura de Caja</h5>
            </div>
            <div class="modal-body">


                <form method="post" id="frmarqueo" onsubmit="abrirArqueo(event);">
                    <div class="form-group">
                        <label for="monto" class="obligatorio">Monto Inicial</label>
                        <input type="hidden" id="id" name="id">
                        <input id="monto" class="form-control" type="text" name="monto"
                            placeholder="Monto Inicial de la Caja" required>
                    </div>
                    <div id="ocultar_campos">
                        <div class="form-group">
                            <label for="monto_final">Monto Final</label>
                            <input id="monto_final" class="form-control" type="text" name="monto_final" disabled>
                        </div>
                        <div class="form-group">
                            <label for="total_ventas">Total Ventas</label>
                            <input id="total_ventas" class="form-control" type="text" name="total_ventas" disabled>
                        </div>
                        <div class="form-group">
                            <label for="monto_general">Monto Total</label>
                            <input id="monto_general" class="form-control" type="text" name="monto_general" disabled>
                        </div>
                    </div>

                    <button id="btnAcion" class="btn" type="submit">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
include "Views/Templates/footer.php";
?>