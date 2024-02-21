<?php include "Views/Templates/header.php"; ?>

<div class="card">

    <div class="card-body">
        <form id="frmEmpresa">
            <div class="form-group">
                <input id="my-input" class="form-control" type="Hidden" name="id" value="<?php echo $data['id']; ?>">
                <div class="row" id="claves">
                    <div class="col-md-3">
                        <label for="identificacion" class="obligatorio"><i class="fas fa-id-badge "></i>
                            Identificacion</label>
                        <input id="my-input" class="form-control" type="text" name="identificacion"
                            value="<?php echo $data['identificacion']; ?>" placeholder="Identificacion de la Empresa">
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nombre" class="obligatorio"><i class="fas fa-user"></i> Nombre</label>
                            <input id="my-input" class="form-control" type="text" name="nombre"
                                value="<?php echo $data['nombre']; ?>" placeholder="Nombre de la Empresa">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="telefono" class="obligatorio"><i class="fas fa-phone"></i> Telefono</label>
                            <input id="my-input" class="form-control" type="text" name="telefono"
                                value="<?php echo $data['telefono']; ?>" placeholder="Telefono de la Empresa">
                        </div>
                </div>
                <div class="form-group">
                    <label for="direccion" class="obligatorio"><i class="fas fa-map-marker-alt"></i>
                        Direccion</label>
                    <input id="my-input" class="form-control" type="text" name="direccion"
                        value="<?php echo $data['direccion']; ?>" placeholder="Direccion de la Empresa">
                </div>


                <div class="form-group">
                    <label for="descripcion" class="obligatorio"> <i class="fas fa-info-circle"></i>
                        Descripcion</label>
                    <textarea id="descripcion" class="form-control" name="descripcion" rows="4"
                        placeholder="Descripcion de la Empresa"><?php echo $data['descripcion']; ?></textarea>
                </div>
            </div>

            <button class="btn" id="botonact" type="button" onclick="guardarEmpresa();"><i class="fas fa-sync"></i>
                Actualizar</button>
        </form>
    </div>
</div>



<?php include "Views/Templates/footer.php"; ?>