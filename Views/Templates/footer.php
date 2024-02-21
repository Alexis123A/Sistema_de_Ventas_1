</div>
</main>
<footer class="footer" style="background-color: white;">
    <div class="container-fluid px-4" style="max-width: 3000px; margin: 0 auto;">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted" style="bac"><strong>Copyright &copy; 2024 <a
                        href="<?php echo base_url; ?>Info">Sistema de Ventas</a> </strong>
            </div>
            <div>
                <a href="#">Politica de Privacidad</a>
                &middot;
                <a href="#">Terminos &amp; Condiciones</a>
            </div>
        </div>
    </div>
</footer>
</div>
</div>

<div id="chamgePass" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="my-modal-title">Modificar Contraseña</h5>
            </div>
            <div class="modal-body">
                <form onsubmit="frmPass(event);" id="frmPass">
                <div class="form-group">
                    <label for="actual">Contraseña Actual</label>
                    <input id="actual" class="form-control" type="password" name="actual">
                </div>
                <div class="form-group">
                    <label for="nueva">Nueva Contraseña</label>
                    <input id="nueva" class="form-control" type="password" name="nueva">
                </div>
                <div class="form-group">
                    <label for="confirmarC">Confirmar Contraseña</label>
                    <input id="confirmarC" class="form-control" type="password" name="confirmarC">
                </div>
                <button class="btn btn-dark" id="botonact" type="submit">Modificar</button>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
<script src="<?php echo base_url; ?>Assets/js/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
<script src="<?php echo base_url; ?>Assets/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="<?php echo base_url; ?>Assets/js/scripts.js"></script>

<script src="<?php echo base_url; ?>Assets/js/datatables.min.js" crossorigin="anonymous"></script>
<script src="<?php echo base_url; ?>Assets/demo/datatables-demo.js"></script>

<script> const base_url = "<?php echo base_url; ?>"; </script>
<script src="<?php echo base_url; ?>Assets/js/sweetalert2.all.min.js"></script>
<script src="<?php echo base_url; ?>Assets/js/Chart.min.js"></script>
<script src="<?php echo base_url; ?>Funciones/funcionesUsuarios.js"></script>
<script src="<?php echo base_url; ?>Funciones/funcionesCompras.js"></script>
<script src="<?php echo base_url; ?>Funciones/funcionesClientes.js"></script>
<script src="<?php echo base_url; ?>Funciones/funcionesCaja.js"></script>
<script src="<?php echo base_url; ?>Funciones/funcionesCategorias.js"></script>
<script src="<?php echo base_url; ?>Funciones/funcionesMedidas.js"></script>
<script src="<?php echo base_url; ?>Funciones/funcionesProducto.js"></script>
<script src="<?php echo base_url; ?>Funciones/funcionesHistorialC.js"></script>
<script src="<?php echo base_url; ?>Funciones/funcionesHistorial.js"></script>
<script src="<?php echo base_url; ?>Funciones/funcionEmpresa.js"></script>
<script src="<?php echo base_url; ?>Funciones/funTiempo.js"></script>
<script src="<?php echo base_url; ?>Funciones/fuVentas.js"></script>
<script src="<?php echo base_url; ?>Funciones/funtPass.js"></script>
<script src="<?php echo base_url; ?>Funciones/funGraficos.js"></script>
<script src="<?php echo base_url; ?>Funciones/FuncionApartados.js"></script>
<script src="<?php echo base_url; ?>Funciones/funcionProveedor.js"></script>
<script src="<?php echo base_url; ?>Funciones/funcionCotizacion.js"></script>

</html>