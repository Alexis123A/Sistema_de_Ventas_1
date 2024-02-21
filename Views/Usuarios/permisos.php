<?php include "Views/Templates/header.php"; ?>

<div class="col-md-8 mx-auto">

    <div class="card-header text-center bg-dark text-white">
        Asignar Permisos
    </div>
    <div class="card-body">
        <form id="formulario" onsubmit="registrarPermisos(event)">
            <div class="row">
                <?php foreach ($data['datos'] as $row) { ?>
                    <div class="col-md-4 text-center text-capitalize p-2">
                        <label for="">
                            <?php echo $row['permiso']; ?>
                        </label><br>
                        <input type="checkbox" name="permisos[]" value="<?php echo $row['id']; ?>" <?php echo isset($data['asignados'][$row['id']]) ? 'checked' : '' ; ?>>
                    </div>
                <?php } ?>
                <input type="hidden" value="<?php echo $data['id_usuario']; ?>" name="id_usuario">
            </div>
            <br>
            <div class="row">
                <div class="col-md-30 text-capitalize text-right">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="<?php echo base_url; ?>Usuarios"><button type="button"
                            class="btn btn-danger">Salir</button></a>

                </div>
            </div>


        </form>

    </div>
</div>

<?php include "Views/Templates/footer.php"; ?>