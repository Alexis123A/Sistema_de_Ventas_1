<?php include "Views/Templates/header.php"; ?>
<br>
<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card" id="cardUsuarios">
            <div class="card-body d-flex text-black" id="body">
                <!--<i class="fas fa-user fa-2x ml-left" id="iconoUser"></i>-->
                <i class="fas fa-user" id="iconoUser"></i>
                <div class="text-container">
                    <a href="<?php echo base_url; ?>Usuarios" id="a"><span>Usuarios</span> </a>
                    <span style="margin-top: 7px;"><b>
                            <?php echo $data['usuarios']['total'] ?>
                        </b></span>
                </div>
            </div>

        </div>
    </div>
    <!-------------------------------------------------------------->
    <div class="col-xl-3 col-md-6">
        <div class="card" id="cardUsuarios">
            <div class="card-body d-flex text-black" id="body">
                <i class="fas fa-users fa-2x ml-left" id="iconoCli"></i>
                <div class="text-container">
                    <a href="<?php echo base_url; ?>Clientes" id="b"><span>Clientes</span></a>
                    <span style="margin-top: 7px"><b>
                            <?php echo $data['clientes']['total'] ?>
                        </b></span>
                </div>
            </div>
        </div>
    </div>
    <!-------------------------------------------------------------->
    <div class="col-xl-3 col-md-6">
        <div class="card" id="cardUsuarios">
            <div class="card-body d-flex text-black" id="body">
                <i class="fas fa-box fa-2x ml-left" id="iconoCaj"></i>
                <div class="text-container">
                    <a href="<?php echo base_url; ?>Caja" id="d"><span>Cajas</span></a>

                    <samp style="margin-top: 7px">
                        <b>
                            <?php echo $data['cajas']['total'] ?>
                        </b>
                    </samp>

                </div>
            </div>
        </div>
    </div>
    <!-------------------------------------------------------------->
    <div class="col-xl-3 col-md-6">
        <div class="card" id="cardUsuarios">
            <div class="card-body d-flex text-black" id="body">
                <i class="fas fa-cash-register fa-2x ml-left" id="iconoV"></i>
                <div class="text-container">
                    <a id="e" href="<?php echo base_url; ?>Ventas/historial">Ventas Dia</a>
                    <samp style="margin-top: 7px">
                        <b>
                            <?php echo $data['ventas']['total'] ?>
                        </b>
                    </samp>
                </div>
            </div>
        </div>
    </div>
</div>
<br>

<!-------------------------------------------------------------->
<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card" id="cardUsuarios">
            <div class="card-body d-flex text-black" id="body">
                <i class="fab fa-product-hunt fa-2x ml-left" id="iconoCa"></i>
                <div class="text-container">
                    <a id="c" href="<?php echo base_url; ?>Productos">Productos</a>
                    <samp style="margin-top: 7px">
                        <b>
                            <?php echo $data['productos']['total'] ?>
                        </b>
                    </samp>
                </div>
            </div>
        </div>
    </div>
    <!-------------------------------------------------------------->
    <div class="col-xl-3 col-md-6">
        <div class="card" id="cardUsuarios">
            <div class="card-body d-flex text-black" id="body">
                <i class="fas fa-tag fa-2x ml-left" id="iconoCate"></i>
                <div class="text-container">
                    <a id="f" href="<?php echo base_url; ?>Categorias">Categorias</a>
                    <samp style="margin-top: 7px">
                        <b>
                            <?php echo $data['categorias']['total'] ?>
                        </b>
                    </samp>
                </div>
            </div>
        </div>
    </div>
    <!-------------------------------------------------------------->
    <div class="col-xl-3 col-md-6">
        <div class="card" id="cardUsuarios">
            <div class="card-body d-flex text-black" id="body">
                <i class="fas fa-cash-register fa-2x ml-left" id="iconoCo"></i>
                <div class="text-container">
                    <a id="g" href="<?php echo base_url; ?>Compras/historial">Compras Dia</a>
                    <samp style="margin-top: 7px">
                        <b>
                            <?php echo $data['compras']['total'] ?>
                        </b>
                    </samp>
                </div>
            </div>
        </div>
    </div>
    <!-------------------------------------------------------------->
    <div class="col-xl-3 col-md-6">
        <div class="card" id="cardUsuarios">
            <div class="card-body d-flex text-black" id="body">
                <i class="fas fa-home  fa-2x ml-left" id="iconoPro"></i>
                <div class="text-container">
                    <a id="h" href="<?php echo base_url; ?>Proveedores">Proveedores</a>
                    <samp style="margin-top: 7px">
                        <b>
                            <?php echo $data['proveedor']['total'] ?>
                        </b>
                    </samp>
                </div>
            </div>
        </div>
    </div>
</div>
<br>






<!-- Grafico de Productos Minimos -->

<div class="row mt-2">
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header bg-white text-black" style="text-align: center; font-size: 20px">
                Productos con Stock Minimos
            </div>
            <div class="card-body">
                <canvas id="productos" width="300" height="300"></canvas>
            </div>
        </div>
    </div>

    <!-- Grafico de Productos mas Vendidos -->

    <div class="col-xl-6">
        <div class="card">
            <div class="card-header bg-white text-black" style="text-align: center; font-size: 20px">
                Productos Mas Vendidos
            </div>
            <div class="card-body">
                <canvas id="ventas" width="400" height="400"></canvas>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php"; ?>