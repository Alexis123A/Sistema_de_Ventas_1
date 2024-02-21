<?php include "Views/Templates/header.php"; ?>



<div class="card" style="width: 100%;">

    <div class="card-head bg-primary text-white">
        <h4>Nueva Compra</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                
                <a href="<?php echo base_url; ?>Compras/Historial" class="secion"> <button class="btn " id="btnAcione2"type="button">Historial</button></a>
                <a href="<?php echo base_url; ?>Proveedores" class="secion"> <button class="btn " id="btnAcione" type="button">Proveedores</button></a>

            </div>
        </div>
        <br>
        <form id="frmCompra">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="codigo"><i class="fas fa-barcode"></i> Codigo de Barras</label>
                        <input type="hidden" id="id" name="id">
                        <input id="codigo" class="form-control" type="text" name="codigo"
                            placeholder="Codigo del Producto" onkeyup="buscarCodigo(event);">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="cantidad">Cantidad</label>
                        <input id="cantidad" class="form-control" type="number" name="cantidad" placeholder="0"
                            onkeyup="calcularPro(event);">
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
    <table id="tblcompra" class="table table-light table-bordered table-hover">
        <thead class="thead-light">
            <tr>
                <th>Id</th>
                <th>Descripcion</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Sub Total</th>
                <th></th>
            </tr>
        </thead>
        <tbody id="tblDetalle">
        </tbody>
    </table>
</div>
<br>
<div class="card" style="width: 100%;">
    <div class="card-body">
        <form id="frmCompra">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="codigo"><i class="fas fa-users"></i> Proveedor</label>
                        <input type="hidden" id="id" name="id">
                        <input id="codigo" class="form-control" type="text" name="codigo"
                            placeholder="Codigo del Producto" onkeyup="buscarCodigo(event);">
                    </div>
                </div>
                <!----->
                <div class="col-md-2">
                    <br>
                    <div class="checkbox">
                        <div class="form-group">
                            <input type="radio" name="checkbox" id="check1">
                            <label for="check1">Efectivo</label>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <br>
                    <div class="checkbox">
                        <div class="form-group">
                            <input type="radio" name="checkbox" id="check1">
                            <label for="check1">Efectivo</label>
                        </div>
                    </div>
                </div>


                <!------>
                <div class="row">
                    <div class="col-md-4 ml-auto">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="total" class="font-weight-bold"><strong>Total</strong></label>
                                <input id="total" class="form-control" type="number" name="total"
                                    placeholder="Total Compra" disabled>
                            </div>
                        </div>
                        <br>
                        <button id="botonact"class="btn" type="button" onclick="generarCompra()">Generar Compra</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
include "Views/Templates/footer.php";
?>