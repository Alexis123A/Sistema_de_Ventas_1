<?php
class Categorias extends Controller
{
    const permisosModel = "permisos";
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
        $id_user = $_SESSION['id_usuario'];
        $verificar = $this->model->verificarPermiso($id_user, 'categorias');
        if (!empty($verificar) || $id_user == 1) {
            $this->views->getView($this, "index");
        } else {
            header('Location: ' . base_url . 'Errors/permisos');
        }

    }


    public function listar()
    {
        $data = $this->model->getCategorias();
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge badge-primary" style="background-color: green" >Activo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-primary" type="button" onclick="btnEditarCategorias(' . $data[$i]['id'] . ');"><i class="fas fa-edit"></i></button>
                <button class="btn btn-danger" type="button" onclick="btnEliminarCategorias(' . $data[$i]['id'] . ');"    ><i class="fas fa-trash-alt">></i></button>';
            } else {
                $data[$i]['estado'] = '<span class="badge badge-danger" style="background-color: red">Inactivo</span>';

                $data[$i]['acciones'] = '<div>
               <button class="btn btn-success" type="button" onclick="btnReingresarCategorias(' . $data[$i]['id'] . ');"    ><i class="fas fa-redo">></i></button>
               <div/>';
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrar()
    {
        $categorias = $_POST['categorias'];
        $id = $_POST['idies'];
        if (empty($categorias)) {
            $msg = "Todos los Campos son Obligatorios";
        } else {
            if ($id == "") {
                $data = $this->model->registrarCategorias($categorias);
                if ($data == 'ok') {
                    $msg = 'Si';
                } else if ($data == "existe") {
                    $msg = "La Categoria ya Existe";
                } else {
                    $msg = "Error al Regitrar la Categoria";
                }
            } else {
                $data = $this->model->modificarCategorias($categorias, $id);
                if ($data == "modificado") {
                    $msg = "modificado";
                } else {
                    $msg = "Error al modificar la Categoria";
                }
            }

        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function editar(int $id)
    {
        $data = $this->model->editarCategorias($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();

    }

    public function eliminar(int $id)
    {
        $data = $this->model->eliminarCategorias($id);
        if ($data == 1) {
            $msg = 'ok';
        } else {
            $msg = "Error al Eliminar la Categoria";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function reingresar(int $id)
    {
        $data = $this->model->reingresarCategorias($id);
        if ($data == 1) {
            $msg = 'ok';
        } else {
            $msg = "Error al Reingresar la Categoria";
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