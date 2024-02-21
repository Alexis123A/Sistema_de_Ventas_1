<?php

class Ventas extends Controller
{

    public function __construct()
    {
        session_start();
        parent::__construct();
    }

    public function index()
    {
        $id_user = $_SESSION['id_usuario'];
        $verificar = $this->model->verificarPermiso($id_user, 'ventas');
        if (!empty($verificar) || $id_user == 1) {
            $this->views->getView($this, "index");
        } else {
            header('Location: ' . base_url . 'Errors/permisos');
        }
    }
    public function credito()
    {
        $id_user = $_SESSION['id_usuario'];
        $verificar = $this->model->verificarPermiso($id_user, 'credito');
        if (!empty($verificar) || $id_user == 1) {
            $this->views->getView($this, "credito");
        } else {
            header('Location: ' . base_url . 'Errors/permisos');
        }
    }

    public function buscarCod($cod)
    {
        $data = $this->model->getCod($cod);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function ingresar()
    {
        $id = $_POST['id'];
        $datos = $this->model->getProductos($id);
        $id_producto = $datos['id'];
        $id_usuario = $_SESSION['id_usuario'];
        $precio = $datos['precio_venta'];
        $cantidad = $_POST['cantidad'];
        $comprobar = $this->model->consultar($id_producto, $id_usuario);
        if (empty($comprobar)) {
            if ($datos['cantidad'] >= $cantidad) {
                $sub_total = $precio * $cantidad;
                $data = $this->model->registrarVenta($id_producto, $id_usuario, $precio, $cantidad, $sub_total);
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
                $data = $this->model->actualizarVenta($precio, $total_cantidad, $sub_total, $id_producto, $id_usuario);
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

    public function getVentasCs($id)
    {
        $data = $this->model->getVentasCs($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function listar()
    {
        $id_usuario = $_SESSION['id_usuario'];
        $data['detalle'] = $this->model->getDetalle($id_usuario);
        $data['total_pagar'] = $this->model->calcularVenta($id_usuario);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function abonar($id)
    {

        $abonados = $_POST['abonar'];
        $data = $this->model->abonar($id, $abonados);
        $totals = $this->model->total($id);
        $full = $totals['abonado'] - $totals['total'];
        $this->model->restante($id, $full);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);

        die();
    }
    public function delete($id)
    {
        $data = $this->model->deleteDetlleV($id);
        if ($data == 'ok') {
            $msg = 'ok';
        } else {
            $msg = 'error';
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrarVenta($cliente)
    {
        $pago = $_POST['pago'];
        $id_usuario = $_SESSION["id_usuario"];
        $verificar = $this->model->verificarCaja($id_usuario);
        if (empty($verificar)) {
            $msg = "La caja esta Cerrada";
        } else {
            $total = $this->model->calcularVenta($id_usuario);
            $abonado = $this->model->calcularAbonado($id_usuario);
            $restante = $total['total'] - $abonado['abonado'];
            $data = $this->model->registrar($id_usuario, $total['total'], $cliente, $pago, $restante);
            if ($data == 'ok') {
                $detalle = $this->model->getDetalle($id_usuario);
                $id_compra = $this->model->id_venta();
                foreach ($detalle as $row) {
                    $cantidad = $row['cantidad'];
                    $desc = $row['descuento'];
                    $precio = $row['precio'];
                    $id_producto = $row['id_producto'];
                    $sub_total = ($cantidad * $precio) - $desc;
                    $this->model->regisraDetalleVenta($id_compra['id'], $id_producto, $cantidad, $desc, $precio, $sub_total);
                    $cantidad_pro = $this->model->getProductos($id_producto);
                    $pro_total = $cantidad_pro['cantidad'] - $cantidad;
                    $this->model->actualizarCantidad($id_producto, $pro_total);
                }
                $vaciar = $this->model->vaciar($id_usuario);
                if ($vaciar == "ok") {

                    $msg = array('msg' => 'ok', 'id_compra' => $id_compra['id']);
                }
            } else {
                $msg = 'Error al Realizar la Compra';
            }
        }

        echo json_encode($msg);
        die();

    }

    public function generarPdf($id_venta)
    {
        //Recopilacion de los Datos
        $empresa = $this->model->getEmpresa();
        $descuento = $this->model->getDesc($id_venta);
        $productos = $this->model->getProV($id_venta);
        //Ruta de el Pdf
        require('Librerias/fpdf.php');

        //Forma del Pdf
        $pdf = new FPDF('P', 'mm', array(80, 200));
        $pdf->AddPage();
        $pdf->SetMargins(4, 0, 0);
        //Titulo de la Hoja
        $pdf->SetTitle('Reporte Compra');
        //Tamaño del Titulo------------------*
        $pdf->SetFont('Arial', 'B', 14);   //<-* 
        //Titulo de la Factura
        $pdf->Cell(65, 10, utf8_decode($empresa["nombre"]), 0, 1, 'C');
        //Logo                                  Tamaño-  Altura - Tamaños
        $pdf->Image(base_url . "Img/default.png", 50, 16, 25, 25);
        //Datos de la Empresa
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(18, 5, 'Ruc:', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(20, 5, $empresa['identificacion'], 0, 1, 'L');
        //
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(18, 5, utf8_decode('Telefono:'), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(20, 5, $empresa['telefono'], 0, 1, 'L');
        //
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(18, 5, utf8_decode('Dirrecion:'), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(20, 5, utf8_decode($empresa['direccion']), 0, 1, 'L');
        //
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(18, 5, 'Folio:', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(20, 5, $id_venta, 0, 1, 'L');
        $pdf->Ln();
        //Productos de Compras
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(10, 5, 'cant', 0, 0, 'L', true);
        $pdf->Cell(35, 5, utf8_decode('Descripcion'), 0, 0, 'L', true);
        $pdf->Cell(10, 5, utf8_decode('Precio'), 0, 0, 'L', true);
        $pdf->Cell(15, 5, utf8_decode('Sub Total'), 0, 1, 'L', true);
        //  
        $pdf->SetTextColor(0, 0, 0);
        $total = 0.00;
        foreach ($productos as $row) {
            $total = $total + $row['sub_total'];
            $pdf->Cell(10, 5, utf8_decode($row['cantidad']), 0, 0, 'L');
            $pdf->Cell(35, 5, utf8_decode($row['descripcion']), 0, 0, 'L');
            $pdf->Cell(15, 5, utf8_decode($row['precio']), 0, 0, 'L');
            $pdf->Cell(10, 5, number_format($row['sub_total'], 2, '.', ','), 0, 1, 'L');
        }
        $pdf->Ln();


        //Descuento
        $pdf->Cell(70, 5, 'Descuento Total', 0, 1, 'R');
        $pdf->Cell(70, 5, number_format($descuento['total'], 2, '.', ','), 0, 1, 'R');
        //Total
        $pdf->Cell(70, 5, 'Total a Pagar', 0, 1, 'R');
        $pdf->Cell(70, 5, number_format($total, 2, '.', ','), 0, 1, 'R');

        $pdf->Output();
    }
    public function calcularDesc($datos)
    {
        $array = explode(",", $datos);
        $id = $array[0];
        $desc = $array[1];
        if (empty($id) || empty($desc)) {
            $msg = "Error";
        } else {
            $Descu = $this->model->verificarDesc($id);
            $descuento = $Descu['descuento'] + $desc;
            $sub_total = ($Descu['cantidad'] * $Descu['precio']) - $descuento;
            $data = $this->model->actualizarDesc($descuento, $sub_total, $id);
            if ($data == 'ok') {
                $msg = "Descuento Aplicado";
            } else {
                $msg = "Error al agregar el Descuento";
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    //----------------------------------------------------------------------------------
    public function Historial()
    {
        $id_user = $_SESSION['id_usuario'];
        $verificar = $this->model->verificarPermiso($id_user, 'ventas');
        if (!empty($verificar) || $id_user == 1) {
            $this->views->getView($this, "historial");
        } else {
            header('Location: ' . base_url . 'Errors/permisos');
        }
    }

    public function listar_historial()
    {
        $data = $this->model->getHistorial();
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge badge-primary" style="background-color: green" >Completado</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-warning" onclick="btnAnularV(' . $data[$i]['id'] . ')"><i class="fas fa-ban"></i></button>
            <a class="btn btn-danger" href="' . base_url . "Ventas/generarPdf/" . $data[$i]['id'] . '" target="_blank"><i class="fas fa-file-pdf"></i></a>';
            } else {
                $data[$i]['estado'] = '<span class="badge badge-danger" style="background-color: red">Anulado</span>';

                $data[$i]['acciones'] = '<div>
            <a class="btn btn-danger" href="' . base_url . "Ventas/generarPdf/" . $data[$i]['id'] . '" target="_blank"><i class="fas fa-file-pdf"></i></a>';

            }


        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();

    }
    public function listar_ventas_credito()
    {
        $data = $this->model->getHistorialCS();
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge badge-primary" style="background-color: green" >Completado</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-warning" onclick="frmCredito(' . $data[$i]['id'] . ')"><i class="fas fa-ban"></i></button>
            <a class="btn btn-danger" href="' . base_url . "Ventas/generarPdf/" . $data[$i]['id'] . '" target="_blank"><i class="fas fa-file-pdf"></i></a>';
            } else {
                $data[$i]['estado'] = '<span class="badge badge-danger" style="background-color: red">Anulado</span>';

                $data[$i]['acciones'] = '<div>
            <a class="btn btn-danger" href="' . base_url . "Ventas/generarPdf/" . $data[$i]['id'] . '" target="_blank"><i class="fas fa-file-pdf"></i></a>';

            }


        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();

    }

    public function anularVenta($id_venta)
    {

        $data = $this->model->AnularVenta($id_venta);
        $anular = $this->model->Anular($id_venta);

        foreach ($data as $row) {
            $cantidad_pro = $this->model->getProductos($row['id_producto']);
            $pro_total = $cantidad_pro['cantidad'] + $row['cantidad'];
            $this->model->actualizarCantidad($row['id_producto'], $pro_total);
        }
        if ($anular == "ok") {
            $msg = "Venta Anulada";
        } else {
            $msg = "Error al Anular la Venta";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();

    }

}