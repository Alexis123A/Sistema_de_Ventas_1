<?php include "Views/Templates/header.php"; ?>

<div class="card" style="width: 100%;">
    <div class="card-body">
        <form id="frmVenta">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="fecha">Desde</label>
                        <input id="fecha" class="form-control" type="date" name="fecha">
                    </div>
                </div>
                <!----->
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="fecha">Hasta</label>
                        <input id="fecha" class="form-control" type="date" name="fecha">
                    </div>
                </div>
                <!----->
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="fecha">Registros</label>
                        <input type="button" class="form-control" value="--------------" id="botonact">
                    </div>
                </div>

        </form>
    </div>

</div>
</div>
<br>



<table class="table table-light" id="t_historia_vc" style="width: 100%;">
    <thead class="thead-light">
        <tr>
            <th>Id</th>
            <th>Total</th>
            <th>Cliente</th>
            <th>Fecha</th>
            <th>Abonado</th>
            <th>Restante</th>
            <th>Estado</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>


<div id="nuevo_credito" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: rgb(0, 123, 255);">
                <h5 class="modal-title text-white" id="title">Nuevo Abono</h5>
            </div>
            <div class="modal-body">
                <form method="post" id="frmCredito">
                    <div class="form-group">
                        <label for="cliente" class="obligatorio">Datos del Cliente</label>
                        <!----> <input type="hidden" id="idies" name="idies">
                        <input id="cliente" class="form-control" type="text" name="cliente"
                            placeholder="Identificacion del Cliente" disabled>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="total" class="obligatorio">Monto Total</label>
                                <input id="total" class="form-control" type="text" name="total"
                                    placeholder="Nombre del Cliente" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="abonado" class="obligatorio">Abonado</label>
                                <input id="abonado" class="form-control" type="text" name="abonado"
                                    placeholder="Telefono del Cliente" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="restante" class="obligatorio">Restante</label>
                                <input id="restante" class="form-control" type="text" name="restante"
                                    placeholder="Nombre del Cliente" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="abonar" class="obligatorio">Abonar</label>
                                <input id="abonar" class="form-control" type="text" name="abonar"
                                    placeholder="Telefono del Cliente" onkeyup="abonarVenta(event);">

                            </div>
                        </div>
                    </div>




                    <button id="btnAcion" class="btn" type="button" onclick="registrarCli(event);">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>




<?php include "Views/Templates/footer.php"; ?>