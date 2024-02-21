<?php
class Usuarios extends Controller
{
    public function __construct()
    {
        session_start();

        parent::__construct();
    }
    public function index()
    {
        if (empty($_SESSION['activo'])) {
            header("location: " . base_url);
        }
        $id_user = $_SESSION['id_usuario'];
        $verificar = $this->model->verificarPermiso($id_user, 'usuarios');
        if (!empty($verificar) || $id_user == 1) {
            $data['cajas'] = $this->model->getCajas();
            $this->views->getView($this, "index", $data);
        } else {
            header('Location: ' . base_url . 'Errors/permisos');
        }
    }

    public function permisos($id)
    {
        if (empty($_SESSION['activo'])) {
            header("location: " . base_url);
        }
        $data['datos'] = $this->model->getPermisos();
        $permisos = $this->model->getDetallePermisos($id);
        $data['asignados'] = array();
        foreach ($permisos as $permiso) {
            $data['asignados'][$permiso['id_permisos']] = true;
        }
        $data['id_usuario'] = $id;
        $this->views->getView($this, "permisos", $data);
    }

    public function listar()
    {
        $data = $this->model->getUsuarios();
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge badge-primary" style="background-color: green" >Activo</span>';
                if ($data[$i]['id'] == 1) {
                    $data[$i]['acciones'] = '<div>
                 <span class="badge bg-warning">Administrador</span>
                    <div/>';
                } else {
                    $data[$i]['acciones'] = '<div>
                    <button class="btn btn-primary" type="button" onclick="btnEditarUser(' . $data[$i]['id'] . ');"><i class="fas fa-edit"></i></button>
    
                    <button class="btn btn-danger" type="button" onclick="btnEliminarUser(' . $data[$i]['id'] . ');"    ><i class="fas fa-trash-alt">></i></button>
    
                    <a class="btn btn-dark" href="' . base_url . 'Usuarios/permisos/' . $data[$i]['id'] . '"><i class="fas fa-key"></i></a>';
                }

            } else {
                $data[$i]['estado'] = '<span class="badge badge-danger" style="background-color: red">Inactivo</span>';
                $data[$i]['acciones'] = '<div>
               <button class="btn btn-success" type="button" onclick="btnReingresarUser(' . $data[$i]['id'] . ');"    ><i class="fas fa-redo">></i></button>
               <div/>';
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function validar()
    {

        if (empty($_POST["usuario"]) || empty($_POST['pass'])) {
            $msg = "Los campos estan Vacios";
        } else {
            $usuario = $_POST['usuario'];
            $pass = $_POST['pass'];
            $hash = hash("SHA256", $pass);
            $data = $this->model->getUsuario($usuario, $hash);
            if ($data !== "" && $data["estado"] == 0) {
                $msg = "El Usuario esta Inavilitado";
            } else if ($data) {
                $_SESSION['id_usuario'] = $data['id'];
                $_SESSION['usuario'] = $data['usuario'];
                $_SESSION['nombre'] = $data['nombre'];
                $_SESSION['correo'] = $data['correo'];
                $_SESSION['fecha'] = $data['fecha'];
                $_SESSION['estado'] = $data['estado'];
                $_SESSION['activo'] = true;
                $msg = "ok";
            } else {
                $msg = "Usuario Y/O Contraseña Incorecta";
            }


        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function registrar()
    {
        $usuario = $_POST['usuario'];
        $correo = $_POST['correo'];
        $nombre = $_POST['nombre'];
        $pass = $_POST['pass'];
        $confirmar = $_POST['confirmar'];
        $caja = $_POST['caja'];
        $id = $_POST['idies'];
        $hash = hash("SHA256", $pass);
        if (empty($usuario) || empty($nombre) || empty($caja) || empty($correo)) {
            $msg = "Todos los Campos son Obligatorios";
        } else {
            if ($id == "") {
                if ($pass != $confirmar) {
                    $msg = "Las contraseñas no coinciden";
                } else {
                    $data = $this->model->registrarUsuario($usuario, $correo, $nombre, $hash, $caja);
                    if ($data == 'ok') {
                        $msg = 'Si';
                    } else if ($data == "existe") {
                        $msg = "El Usuario ya Existe";
                    } else {
                        $msg = "Error al Regitrar Usuario";
                    }
                }
            } else {
                $data = $this->model->modificarUsuario($usuario, $correo, $nombre, $caja, $id);
                if ($data == "modificado") {
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
        $data = $this->model->editarUser($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();

    }

    public function eliminar(int $id)
    {
        $data = $this->model->eliminarUser($id);
        if ($data == 1) {
            $msg = 'ok';
        } else {
            $msg = "Error al Eliminar el Usuario";
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
    public function change()
    {
        $actual = $_POST['actual'];
        $nueva = $_POST['nueva'];
        $confirmar = $_POST['confirmarC'];
        if (empty($actual) || empty($nueva) || empty($confirmar)) {
            $msg = "Todos los campos son Obligatorios";
        } else {
            if ($nueva != $confirmar) {
                $msg = "Las contraseñas no coinciden";
            } else {
                $id = $_SESSION["id_usuario"];
                $hash = hash("SHA256", $actual);
                $data = $this->model->getPass($hash, $id);
                if (!empty($data)) {
                    $verificar = $this->model->modificarPass(hash("SHA256", $nueva), $id);
                    if ($verificar == 1) {
                        $msg = "Contraseña Modificada";
                    } else
                        $msg = "Error al Modificar la Contraseña";
                } else {
                    $msg = "La contraseña actual es Incorecta";
                }
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrarPermisos()
    {
        $msg = "";
        $id_user = $_POST['id_usuario'];
        $eliminar = $this->model->eliminarPermisos($id_user);
        if ($eliminar == 'ok') {
            foreach ($_POST['permisos'] as $id_permiso) {
                $msg = $this->model->registrarPermisos($id_user, $id_permiso);
            }
            if ($msg == 'ok') {
                $msg = 'Permisos Asignados';
            } else {
                $msg = 'Error';
            }

        } else {
            $msg = "Error al registrar los Permisos";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);

    }

    public function salir()
    {
        session_destroy();
        header("location: " . base_url);
    }

}
?>