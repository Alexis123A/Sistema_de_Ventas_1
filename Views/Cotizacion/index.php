<?php include "Views/Templates/header.php"; ?>

<div class="card" style="width: 100%;">

    <div class="card-head bg-primary text-white">
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <a href="<?php echo base_url; ?>Apartados/historial"><button class="btn " id="btnAcione" type="button"
                        onclick="">Historial Cotizaciones</button></a>

            </div>
            <hr>
        </div>

        <form id="frmCotizacion">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="codigo"><i class="fas fa-barcode"></i> Codigo de Barras</label>
                        <input type="hidden" id="idPro" name="idPro">
                        <input id="codigo" class="form-control" type="text" name="codigo"
                            placeholder="Codigo del Producto" onkeyup="buscarCodigoCotizacion(event);">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="cantidad">Cantidad</label>
                        <input id="cantidad" class="form-control" type="number" name="cantidad" placeholder="0"
                            onkeyup="calcularProCo(event);">
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
    <table id="tblCotizacion" class="table table-light table-bordered table-hover">
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
        <tbody id="tblDetalleCotizacion">
        </tbody>
    </table>
</div>
<br>
<div class="card" style="width: 100%;">
    <div class="card-body">
        <form id="frmCotizacion2">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="cliente"><i class="fas fa-users"></i> Buscar Cliente</label>
                        <input id="cliente" class="form-control" type="text" name="cliente" placeholder="Identificacion"
                            onkeyup="buscarCliCoti(event);">
                        <input type="hidden" id="telefonoCli">
                        <input type="hidden" id="direcionCli">
                    </div>
                </div>
                <!----->
                <div class="col-md-2">
                    <label for="" class="obligatorio">Condicion de Pago:</label>
                    <select id="pago" class="form-control" name="pago">
                        <option value="Contado">
                            Contado
                        </option>
                        <option value="Credito">
                            Credito
                        </option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label for="" class="obligatorio">Validez:</label>
                    <select id="validez" class="form-control" name="validez">
                        <option value="5">
                            5 dias
                        </option>
                        <option value="10">
                            10 dias
                        </option>
                    </select>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="check1" class="obligatorio">Nota:</label>
                        <textarea id="nota" class="form-control" name="nota" rows="2" placeholder="Nota"></textarea>
                    </div>
                </div>



                <!------>
                <div class="row">
                    <div class="col-md-4 ml-auto">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="totalVenta" class="font-weight-bold"><strong>Total</strong></label>
                                <input id="totalVenta" class="form-control" type="number" name="totalVenta"
                                    placeholder="Total Venta" disabled>
                            </div>
                        </div>
                        <button class="btn" type="button" id="botonact" onclick="generarCotizacion()">Generar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<?php include "Views/Templates/footer.php"; ?>