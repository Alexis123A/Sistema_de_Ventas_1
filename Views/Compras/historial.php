<?php include "Views/Templates/header.php"; ?>
<div class="card" style="width: 100%;">
    <div class="card-body">
        <form id="frmCompra">
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



<table class="table table-light" id="t_historia_c" style="width: 100%;">
    <thead class="thead-light">
        <tr>
            <th>Id</th>
            <th>Total</th>
            <th>Fecha</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>




<?php include "Views/Templates/footer.php"; ?>