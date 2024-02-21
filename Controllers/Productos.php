<?php
class Productos extends Controller
{
    public function __construct()
    {
        session_start();

        parent::__construct();
    }
    public function index()
    {

        $id_user = $_SESSION['id_usuario'];
        $verificar = $this->model->verificarPermiso($id_user, 'productos');
        if (!empty($verificar) || $id_user == 1) {
            $data['medidass'] = $this->model->getMedidas();
            $data['categorias'] = $this->model->getCategorias();
            $this->views->getView($this, "index", $data);
        } else {
            header('Location: ' . base_url . 'Errors/permisos');
        }
    }

    public function listar()
    {

        $data = $this->model->getProductos();

        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['imagen'] = '<img class="img-thumbnail" src="' . base_url . 'Img/' . $data[$i]['img'] . '"width="100">';
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge badge-primary" style="background-color: green" >Activo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-primary" type="button" onclick="btnEditarPro(' . $data[$i]['id'] . ');"><i class="fas fa-edit"></i></button>
                <button class="btn btn-danger" type="button" onclick="btnEliminarPro(' . $data[$i]['id'] . ');"    ><i class="fas fa-trash-alt">></i></button>';
            } else {
                $data[$i]['estado'] = '<span class="badge badge-danger" style="background-color: red">Inactivo</span>';
                $data[$i]['acciones'] = '<div>
               <button class="btn btn-success" type="button" onclick="btnReingresarPro(' . $data[$i]['id'] . ');"    ><i class="fas fa-redo">></i></button>
               <div/>';
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function registrar()
    {
        $codigo = $_POST['codigo'];
        $descripcion = $_POST['descripcion'];
        $precio_compra = $_POST['precio_compra'];
        $precio_venta = $_POST['precio_venta'];
        $medida = $_POST['medidass'];
        $categoria = $_POST['categorias'];
        $id = $_POST['idies'];
        $img = $_FILES['imagen'];
        $name = $img['name'];
        $tpmname = $img['tmp_name'];
        $fecha = date("YmdHis");
        if (empty($codigo) || empty($descripcion) || empty($precio_compra) || empty($precio_venta)) {
            $msg = "Todos los Campos son Obligatorios";
        } else {
            if (!empty($name)) {
                $imgNombre = $fecha . ".jpg";
                $destino = "Img/" . $imgNombre;
            } else if (!empty($_POST['foto_actual']) && empty($name)) {
                $imgNombre = $_POST['foto_actual'];
            } else {
                $imgNombre = "default.png";
            }
            if ($id == "") {
                $data = $this->model->registrarProducto($codigo, $descripcion, $precio_compra, $precio_venta, $medida, $categoria, $imgNombre);
                if ($data == 'ok') {
                    if (!empty($name)) {
                        move_uploaded_file($tpmname, $destino);
                    }
                    $msg = 'Si';
                } else if ($data == "existe") {
                    $msg = "El Producto ya Existe";
                } else {
                    $msg = "Error al Regitrar Producto";
                }
            } else {
                $imagen_delete = $this->model->editarPro($id);
                if ($imagen_delete['img'] != 'default.png') {
                    if (file_exists("Img/" . $imagen_delete['img'])) {
                        unlink("Img/" . $imagen_delete['img']);
                    }
                }
                $data = $this->model->modificarProductos($codigo, $descripcion, $precio_compra, $precio_venta, $medida, $categoria, $imgNombre, $id);
                if ($data == "modificado") {
                    if (!empty($name)) {
                        move_uploaded_file($tpmname, $destino);
                    }
                    $msg = "modificado";
                } else {
                    $msg = "Error al modificar el Usuario";
                }
            }

        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function editar(int $id)
    {
        $data = $this->model->editarPro($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();

    }

    public function eliminar(int $id)
    {
        $data = $this->model->eliminarPro($id);
        if ($data == 1) {
            $msg = 'ok';
        } else {
            $msg = "Error al Eliminar el Producto";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function reingresar(int $id)
    {
        $data = $this->model->reingresarUser($id);
        if ($data == 1) {
            $msg = 'ok';
        } else {
            $msg = "Error al Reingresar el Usuario";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function salir()
    {
        session_destroy();
        header("location: " . base_url);
    }

}
?>