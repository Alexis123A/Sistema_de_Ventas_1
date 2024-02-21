<?php
include "Views/Templates/header.php";
?>
<br>
<div class="row">
    <div class="col-md-5">
        <button class="btn" id="nuevo" type="button" onclick="frmProductos();"><i class="fas fa-plus"></i></button>
        <button class="btn" id="barcode" type="button" onclick="frmProductos();"><i class="fas fa-barcode"></i></button>
        <button class="btn" id="Generarbarcode" type="button" onclick="frmProductos();"><i class="fas fa-tags "></i>
            Generar Codigo de Barras</button>

    </div>
</div>
<br>
<div class="table-responsive">
    <table class="table table-light" id="tblProductos" style="width: 100%;">
        <thead class="thead-light">
            <tr>
                <th>Id</th>
                <th>Imagen</th>
                <th>Código</th>
                <th>Descripcion</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Estado</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<!--Nuevo Usuario-->
<div id="nuevo_producto" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: rgb(0, 123, 255);">
                <h5 class="modal-title text-white" id="title">Nuevo Producto</h5>
            </div>
            <div class="modal-body">
                <form method="post" id="frmProductos">
                    <div class="form-group">
                        <label for="codigo" class="obligatorio">Codigo</label>
                        <!----> <input type="hidden" id="idies" name="idies">
                        <input id="codigo" class="form-control" type="text" name="codigo"
                            placeholder="Codigo de Barras">
                    </div>

                    <div class="form-group">
                        <label for="descripcion" class="obligatorio">Descripcion</label>
                        <input id="descripcion" class="form-control" type="text" name="descripcion"
                            placeholder="Nombre del Producto">
                    </div>

                    <div class="row" id="claves">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="precio_compra" class="obligatorio">Precio Compra</label>
                                <input id="precio_compra" class="form-control" type="number" name="precio_compra"
                                    placeholder="Precio Compra">
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="precio_venta" class="obligatorio">Precio Venta</label>
                                <input id="precio_venta" class="form-control" type="number" name="precio_venta"
                                    placeholder="Precio Venta">
                            </div>
                        </div>
                    </div>
                    <div class="row" id="claves">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="medidass">Medidas</label>
                                <select id="medidass" class="form-control" name="medidass">
                                    <?php foreach ($data['medidass'] as $row) { ?>
                                        <option value="<?php echo $row['id']; ?>">
                                            <?php echo $row['medidas_corto']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="categorias">Categoria</label>
                                <select id="categorias" class="form-control" name="categorias">
                                    <?php foreach ($data['categorias'] as $row) { ?>
                                        <option value="<?php echo $row['id']; ?>">
                                            <?php echo $row['categorias']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Imagen</label>
                            <div class="card" style="border: 1px solid rgb(0, 123, 255);">
                                <div class="card-body">
                                    <label for="imagen" id="icon-img" class="btn"><i class="fas fa-image"></i></label>
                                    <span id="icon-close"></span>
                                    <input type="file" id="imagen" class="d-none" name="imagen"
                                        onchange="prewiew(event)">
                                    <input type="hidden" id="foto_actual" name="foto_actual">
                                    <img class="img-thumbnail" id="img-preview">
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <button id="btnAcion" class="btn" type="button" onclick="registrarPro(event);"><i
                            class="fas fa-save"></i>Guasrdar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
include "Views/Templates/footer.php";
?>