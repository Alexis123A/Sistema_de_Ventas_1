<?php include "Views/Templates/header.php"; ?>



<div class="card" style="width: 100%;">

    <div class="card-head bg-primary text-white">
        <h4>Nueva Venta</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <a href="<?php echo base_url; ?>Clientes"><button class="btn " id="btnAcione" type="button"
                        onclick="">Clientes</button></a>

                <a href="<?php echo base_url; ?>Ventas/Historial"><button class="btn " id="btnAcione2" type="button"
                        onclick="">Historial</button></a>

                <a href="<?php echo base_url; ?>Caja"> <button class="btn " id="btnAcione3" type="button"
                        onclick="">Caja</button></a>




            </div>
        </div>
        <br>
        <form id="frmVenta">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="codigo"><i class="fas fa-barcode"></i> Codigo de Barras</label>
                        <input type="hidden" id="id" name="id">
                        <input id="codigo" class="form-control" type="text" name="codigo"
                            placeholder="Codigo del Producto" onkeyup="buscarCodigoVenta(event);">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="cantidad">Cantidad</label>
                        <input id="cantidad" class="form-control" type="number" name="cantidad" placeholder="0"
                            onkeyup="calcularProV(event);">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="descripcion">Descripcion</label>
                        <input id="descripcion" class="form-control" type="text" name="descripcion"
                            placeholder="Descripcion del Producto" disabled>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="precio">Precio</label>
                        <input id="precio" class="form-control" type="number" name="precio" placeholder="Precio Compra"
                            disabled>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="sub_total">Sub Total</label>
                        <input id="sub_total" class="form-control" type="number" name="sub_total"
                            placeholder="Sub Total" disabled>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <table id="tblventa" class="table table-light table-bordered table-hover">
        <thead class="thead-light">
            <tr>
                <th>Id</th>
                <th>Descripcion</th>
                <th>Cantidad</th>
                <th>Aplicar</th>
                <th>Descuento</th>
                <th>Precio</th>
                <th>Sub Total</th>
                <th></th>
            </tr>
        </thead>
        <tbody id="tblDetalleVenta">
        </tbody>
    </table>
</div>
<br>
<div class="card" style="width: 100%;">
    <div class="card-body">
        <form id="frmVentaInfo">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="cliente"><i class="fas fa-users"></i> Buscar Cliente</label>
                        <input type="hidden" id="id" name="id">
                        <input id="cliente" class="form-control" type="text" name="cliente" placeholder="Identificacion"
                            onkeyup="buscarCli(event);">
                        <input type="hidden" id="telefonoCli">
                        <input type="hidden" id="direcionCli">
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="pago" class="obligatorio">Forma de Pago:</label>
                    <select id="pago" class="form-control" name="pago">
                        <option value="Contado">
                            Contado
                        </option>
                        <option value="Credito">
                            Credito
                        </option>
                    </select>
                </div>
                <!------>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="resivo"><i class="fas fa-users"></i> Efectivo Resivido</label>
                        <input id="resivo" class="form-control" type="text" name="resivo" placeholder="Recibo"
                            onkeyup="resivoVenta(event);">
                    </div>
                </div>
                <!------>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="total" class="font-weight-bold"><strong>Cambio:</strong></label>
                        <input id="total" class="form-control" type="number" name="total" placeholder="Cambio" disabled>
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="totalVenta" class="font-weight-bold"><strong>Total</strong></label>
                        <input id="totalVenta" class="form-control" type="number" name="totalVenta"
                            placeholder="Total Venta" disabled>
                    </div>
                    <button class="btn" type="button" id="botonact" onclick="generarVenta()">Generar Venta</button>
                </div>
            </div>




        </form>
    </div>
</div>

<?php
include "Views/Templates/footer.php";
?>