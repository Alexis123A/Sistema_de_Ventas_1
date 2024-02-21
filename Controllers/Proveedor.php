<?php
class Proveedor extends Controller
{
    public function __construct()
    {
        session_start();
        if (empty($_SESSION['activo'])) {
            header("location: " . base_url);
        }
        parent::__construct();
    }
    public function index()
    {

        $this->views->getView($this, "index");

    }

    public function listar()
    {
        $data = $this->model->getProveedor();
        for ($i = 0; $i < count($data); $i++) {
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
        $identificacion = $_POST['identificacion'];
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];
        $direccion = $_POST['direccion'];
        $id = $_POST['idies'];
        if (empty($identificacion) || empty($nombre) || empty($telefono) || empty($direccion)) {
            $msg = "Todos los Campos son Obligatorios";
        } else {
            if ($id == "") {
                $data = $this->model->registrarPro($identificacion, $nombre, $telefono, $direccion);
                if ($data == 'ok') {
                    $msg = 'Si';
                } else if ($data == "existe") {
                    $msg = "El Proveedor ya Existe";
                } else {
                    $msg = "Error al Regitrar el Proveedor";
                }
            } else {
                $data = $this->model->modificarPro($identificacion, $nombre, $telefono, $direccion, $id);
                if ($data == "modificado") {
                    $msg = "modificado";
                } else {
                    $msg = "Error al modificar el Proveedor";
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
            $msg = "Error al Eliminar el Proveedor";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function reingresar(int $id)
    {
        $data = $this->model->reingresarPro($id);
        if ($data == 1) {
            $msg = 'ok';
        } else {
            $msg = "Error al Reingresar el Proveedor";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function salir()
    {
        session_destroy();
        header("location: " . base_url);
    }

    public function bucarCli($client)
    {
        $data = $this->model->getPro($client);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

}
?>