<?php
class Apartados extends Controller
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
    public function historial()
    {
        $this->views->getView($this, "historial");
    }

    public function listar()
    {
        $id_usuario = $_SESSION['id_usuario'];
        $data['detalle'] = $this->model->getDetalle($id_usuario);
        $data['total_pagar'] = $this->model->calcularApartado($id_usuario);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function buscarCli($id)
    {
        $Cli = $data['ventaCli'] = $this->model->getCliIden($id);
        $data['cli'] = $this->model->getCli($Cli['cliente']);
        $data['apar'] = $this->model->getApar($id);
        $data['apar_f'] = $this->model->getFecha($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function buscar($id)
    {
        $data = $this->model->getApar($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function buscarCod($cod)
    {
        $data = $this->model->getCod($cod);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function ingresar()
    {

        $id = $_POST['idPro'];
        $datos = $this->model->getProductos($id);
        $id_producto = $datos['id'];
        $id_usuario = $_SESSION['id_usuario'];
        $precio = $datos['precio_venta'];
        $cantidad = $_POST['cantidad'];
        $comprobar = $this->model->consultar($id_producto, $id_usuario);
        if (empty($comprobar)) {
            if ($datos['cantidad'] >= $cantidad) {
                $sub_total = $precio * $cantidad;
                $data = $this->model->registrarApartado($id_producto, $id_usuario, $precio, $cantidad, $sub_total);
                if ($data == "ok") {
                    $msg = "Producto Ingresado";
                } else {
                    $msg = "Error al ingresar el Producto";
                }
            } else {
                $msg = "Cantidad No Disponible:" . $datos['cantidad'];
            }
        } else {
            $total_cantidad = $comprobar['cantidad'] + $cantidad;
            $sub_total = $total_cantidad * $precio;
            if ($datos['cantidad'] < $total_cantidad) {
                $msg = "Cantidad no Disponible";
            } else {
                $data = $this->model->actualizarApartado($precio, $total_cantidad, $sub_total, $id_producto, $id_usuario);
                if ($data == "modificado") {
                    $msg = "modificado";
                } else {
                    $msg = "Error al Modificar el Producto";
                }
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function delete($id)
    {
        $data = $this->model->deleteDetlleA($id);
        if ($data == 'ok') {
            $msg = 'ok';
        } else {
            $msg = 'error';
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrarApartado()
    {

        $id_usuario = $_SESSION["id_usuario"];
        $total = $this->model->calcularApartado($id_usuario);
        $cliente = $_POST['cliente'];
        $abonado = $_POST['abono'];
        $fecha = $_POST['fecha'];
        $nota = $_POST['nota'];
        $data = $this->model->registrar($id_usuario, $total['total'], $cliente, $abonado, $fecha, $nota);
        if ($data == 'ok') {
            $detalle = $this->model->getDetalle($id_usuario);
            $id_apartado = $this->model->id_apartado();
            foreach ($detalle as $row) {
                $cantidad = $row['cantidad'];
                $desc = $row['descuento'];
                $precio = $row['precio'];
                $id_producto = $row['id_producto'];
                $sub_total = ($cantidad * $precio) - $desc;
                $this->model->regisraDetalleApartado($id_apartado['id'], $id_producto, $cantidad, $desc, $precio, $sub_total);
                $cantidad_pro = $this->model->getProductos($id_producto);
                $pro_total = $cantidad_pro['cantidad'] - $cantidad;
                $this->model->actualizarCantidad($id_producto, $pro_total);
            }
            $vaciar = $this->model->vaciar($id_usuario);
            if ($vaciar == "ok") {

                $msg = array('msg' => 'ok', 'id_compra' => $id_apartado['id']);
            }
        } else {
            $msg = 'Error al Realizar la Compra';
        }

        echo json_encode($msg);
        die();

    }


    public function listar_historial()
    {
        $data = $this->model->getHistorial();
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge badge-primary" style="background-color: green" >Entregado</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-warning" onclick="frmApartado(' . $data[$i]['id'] . ');"><i class="fas fa-eye"></i></button>
            <a class="btn btn-danger" href="' . base_url . "Apartado/generarPdf/" . $data[$i]['id'] . '" target="_blank"><i class="fas fa-file-pdf"></i></a>';
            } else {
                $data[$i]['estado'] = '<span class="badge badge-danger" style="background-color: red">Pendiente</span>';

                $data[$i]['acciones'] = '<div>
            <a class="btn btn-danger" href="' . base_url . "Apartado/generarPdf/" . $data[$i]['id'] . '" target="_blank"><i class="fas fa-file-pdf"></i></a>';

            }


        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();

    }
}