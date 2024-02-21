<?php include "Views/Templates/header.php"; ?>

<div class="card" style="width: 100%;">
    <div class="card-body">
        <form id="frmVenta">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="desde">Desde</label>
                        <input id="desde" class="form-control" type="date" name="desde">
                    </div>
                </div>
                <!----->
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="hasta">Hasta</label>
                        <input id="hasta" class="form-control" type="date" name="hasta">
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



<table class="table table-light" id="t_historia_v" style="width: 100%;">
    <thead class="thead-light">
        <tr>
            <th>Id</th>
            <th>Total</th>
            <th>Fecha</th>
            <th>Estado</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>







<?php include "Views/Templates/footer.php"; ?>