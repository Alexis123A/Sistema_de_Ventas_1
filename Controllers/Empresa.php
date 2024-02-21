<?php

class Empresa extends Controller
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
        $id_user = $_SESSION['id_usuario'];
        $verificar = $this->model->verificarPermiso($id_user, 'empresa');
        if (!empty($verificar) || $id_user == 1) {
               $data = $this->model->getEmpresa();
        $this->views->getView($this, "index", $data);
        } else {
            header('Location: ' . base_url . 'Errors/permisos');
        }
    
    }
    public function home()
    {
        //$data = $this->model->getEmpresa();
        $data['usuarios'] = $this->model->getDatos('usuarios');
        $data['clientes'] = $this->model->getDatos('clientes');
        $data['cajas'] = $this->model->getDatos('caja');
        $data['categorias'] = $this->model->getDatos('categorias');
        $data['productos'] = $this->model->getDatos('productos');
        $data['proveedor'] = $this->model->getDatos('proveedor');
        $data['ventas'] = $this->model->getVentas();
        $data['compras'] = $this->model->getCompras();
        $this->views->getView($this, "home", $data);
    }
    public function modificar()
    {
        $ident = $_POST['identificacion'];
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];
        $direccion = $_POST['direccion'];
        $descripcion = $_POST['descripcion'];
        $id = $_POST['id'];
        $data = $this->model->modificar($ident, $nombre, $telefono, $direccion, $descripcion, $id);
        if($data == 'ok'){
            $msg = 'ok';
        }else{
            $msg = 'error';
        }

        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function reportesStock()
    {
        $data = $this->model->getStockMinimo();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function masVendidos()
    {
        $data = $this->model->getMasVendidos();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }



}