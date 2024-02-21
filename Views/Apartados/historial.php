<?php include "Views/Templates/header.php"; ?>

<div class="card" style="width: 100%;">
    <div class="card-body">
        <form id="frmApartado">
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



<table class="table table-light" id="t_historia_a" style="width: 100%;">
    <thead class="thead-light">
        <tr>
            <th>Id</th>
            <th>Total</th>
            <th>Cliente</th>
            <th>Fecha</th>
            <th>Estado</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
<div id="nueva_apartado" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
    aria-hidden="true">
    <div class="modal-dialog" role="document" id="modalApartado">
        <div class="modal-content">
            <div class="modal-header" style="background-color: rgb(0, 123, 255);">
                <h5 class="modal-title text-white" id="title">Apartados</h5>
            </div>
            <div class="modal-body">
                <form method="post" id="frmApartado">
                    <span style="display: block; text-align: center; font-family: Arial, sans-serif;">Informacion del
                        Cliente</span>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input id="nombre" class="form-control" type="text" name="nombre" disabled>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="telefono">Telefono:</label>
                                <input id="telefono" class="form-control" type="text" name="telefono" disabled>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="direccion">Direccion:</label>
                                <input id="direccion" class="form-control" type="text" name="direccion" disabled>
                            </div>
                        </div>
                    </div>
                    <span style="display: block; text-align: center; font-family: Arial, sans-serif;">Detalle
                        Productos</span>
                    <br>

                    <table class="table table-light" id="t_historia_ap" style="width: 100%;">
                        <thead class="thead-light">
                            <tr>
                                <th>Cantidad</th>
                                <th>Descripcion</th>
                                <th>Precio</th>
                                <th>Descuento</th>
                                <th>Sub Total</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tbody id="tblApartadoDetalle">
                        </tbody>
                    </table>
                    <br>
                    <div class="col-md-4">
                    <b>Fecha Recojo: </b> <input  class="form-control" type="text" id="fechass" disabled>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="abonado">Abonado:</label>
                            <input id="abonado" class="form-control" type="text" name="abonado" disabled>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="restante">Restante:</label>
                            <input id="restante" class="form-control" type="text" name="" disabled>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="total">Total:</label>
                            <input id="total" class="form-control" type="text" name="total" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-11">
                            <button class="btn" type="button" id="botonact"
                                onclick="generarApartado()">Procesar</button>
                        </div>
                        <div class="col-md-1">
                            <button class="btn" type="button" id="botonact" onclick="generarApartado()">Cerrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php include "Views/Templates/footer.php"; ?>