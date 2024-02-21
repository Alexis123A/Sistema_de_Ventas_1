<?php
class Caja extends Controller
{
    public function __construct()
    {
        session_start();
        if (empty($_SESSION['activo'])) {
            header("location: " . base_url);
        }
        parent::__construct();
    }

    public function movimientos()
    {
        $id_user = $_SESSION['id_usuario'];
        $verificar = $this->model->verificarPermiso($id_user, 'cajas');
        if (!empty($verificar) || $id_user == 1) {



            $data['monto_ini'] = $this->model->getMontoInicialA($id_user);
            $data['monto_to'] = $this->model->getMontoTotal($id_user);

            $this->views->getView($this, "movimientos",  $data);





        } else {
            header('Location: ' . base_url . 'Errors/permisos');
        }

    }
    public function index()
    {
        $id_user = $_SESSION['id_usuario'];
        $verificar = $this->model->verificarPermiso($id_user, 'cajas');
        if (!empty($verificar) || $id_user == 1) {
            $this->views->getView($this, "index");
        } else {
            header('Location: ' . base_url . 'Errors/permisos');
        }

    }
    public function arqueo()
    {
        $id_user = $_SESSION['id_usuario'];
        $verificar = $this->model->verificarPermiso($id_user, 'cajas');
        if (!empty($verificar) || $id_user == 1) {
            $this->views->getView($this, "arqueo");
        } else {
            header('Location: ' . base_url . 'Errors/permisos');
        }
     
    }

    public function listarArqueo()
    {
        $data = $this->model->getArqueo();
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge badge-primary" style="background-color: green" >Activo</span>';

            } else {
                $data[$i]['estado'] = '<span class="badge badge-danger" style="background-color: red">Inactivo</span>';
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function listar()
    {
        $data = $this->model->getCaja();
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge badge-primary" style="background-color: green" >Activo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-primary" type="button" onclick="btnEditarCaja(' . $data[$i]['id'] . ');"><i class="fas fa-edit"></i></button>
                <button class="btn btn-danger" type="button" onclick="btnEliminarCaja(' . $data[$i]['id'] . ');"    ><i class="fas fa-trash-alt">></i></button>';
            } else {
                $data[$i]['estado'] = '<span class="badge badge-danger" style="background-color: red">Inactivo</span>';

                $data[$i]['acciones'] = '<div>
               <button class="btn btn-success" type="button" onclick="btnReingresarCaja(' . $data[$i]['id'] . ');"    ><i class="fas fa-redo">></i></button>
               <div/>';
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function abrirArqueo()
    {
        $monto = $_POST['monto'];
        $fecha = date('Y-m-d');
        $id_usuario = $_SESSION['id_usuario'];
        $id = $_POST['id'];
        if (empty($monto)) {
            $msg = "Todos los Campos son Obligatorios";
        } else {
            if ($id == '') {
                $data = $this->model->registrarArqueo($id_usuario, $monto, $fecha);
                if ($data == "ok") {
                    $msg = "Caja abierta";
                } else if ($data == "existe") {
                    $msg = "La caja ya esta Abierta";
                } else {
                    $msg = "Error al abrir la caja";
                }
            } else {
                $monto_final = $this->model->getVentas($id_usuario);
                $total_ventas = $this->model->getTotalVentas($id_usuario);
                $monto_inicial = $this->model->getMontoInicial($id_usuario);
                $general = $monto_final['total'] + $monto_inicial['monto_inicial'];
                $data = $this->model->actualizarArqueo($monto_final['total'], $fecha, $total_ventas['total'], $general, $monto_inicial['id']);
                if ($data == "ok") {
                    $this->model->actualizarApertura($id_usuario);
                    $msg = "Caja Cerrada";
                } else {
                    $msg = "Error al Cerrar la Caja";
                }
            }
        }

        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrar()
    {
        $caja = $_POST['caja'];
        $id = $_POST['idies'];
        if (empty($caja)) {
            $msg = "Todos los Campos son Obligatorios";
        } else {
            if ($id == "") {
                $data = $this->model->registrarCaja($caja);
                if ($data == 'ok') {
                    $msg = 'Si';
                } else if ($data == "existe") {
                    $msg = "La Caja ya Existe";
                } else {
                    $msg = "Error al Regitrar la Caja";
                }
            } else {
                $data = $this->model->modificarCaja($caja, $id);
                if ($data == "modificado") {
                    $msg = "modificado";
                } else {
                    $msg = "Error al modificar la Caja";
                }
            }

        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function editar(int $id)
    {
        $data = $this->model->editarCaja($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();

    }

    public function eliminar(int $id)
    {
        $data = $this->model->eliminarCaja($id);
        if ($data == 1) {
            $msg = 'ok';
        } else {
            $msg = "Error al Eliminar la Caja";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function reingresar(int $id)
    {
        $data = $this->model->reingresarCaja($id);
        if ($data == 1) {
            $msg = 'ok';
        } else {
            $msg = "Error al Reingresar la Caja";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function getVentas()
    {
        $id_user = $_SESSION['id_usuario'];
        $data['monto_total'] = $this->model->getVentas($id_user);
        $data['total_ventas'] = $this->model->getTotalVentas($id_user);
        $data['inicial'] = $this->model->getMontoInicial($id_user);
        $data['monto_general'] = $data['monto_total']['total'] + $data['inicial']['monto_inicial'];
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();

    }

    public function salir()
    {
        session_destroy();
        header("location: " . base_url);
    }
}
?>