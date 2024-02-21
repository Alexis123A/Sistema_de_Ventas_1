<?php
class VentasModel extends Query
{
    private $categorias, $id, $estado;
    public function __construct()
    {
        parent::__construct();
    }

    public function getCod(string $cod)
    {
        $sql = "SELECT * FROM productos WHERE codigo = '$cod'";
        $data = $this->select($sql);
        return $data;
    }

    function getProductos(int $id)
    {
        $sql = "SELECT * FROM productos WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }

    public function registrarVenta(int $id_producto, int $id_usuario, string $precio, int $cantidad, string $sub_total)
    {
        $sql = "INSERT INTO detalle_tmp(id_producto, id_usuario, precio, cantidad, sub_total) VALUES (?,?,?,?,?)";
        $datos = array($id_producto, $id_usuario, $precio, $cantidad, $sub_total);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function getDetalle(int $id)
    {
        $sql = "SELECT d.*, p.id AS id_Pro, p.descripcion FROM detalle_tmp d INNER JOIN productos p ON d.id_producto = p.id WHERE d.id_usuario = $id";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function calcularVenta(int $id_usuario)
    {
        $sql = "SELECT sub_total, SUM(sub_total) AS total FROM detalle_tmp WHERE id_usuario = $id_usuario";
        $data = $this->select($sql);
        return $data;
    }
    public function calcularAbonado(int $id_usuario)
    {
        $sql = "SELECT abonado FROM ventas WHERE id_usuario = $id_usuario";
        $data = $this->select($sql);
        return $data;
    }

    public function deleteDetlleV(int $id)
    {
        $sql = "DELETE FROM detalle_tmp WHERE id = ?";
        $datos = array($id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }


    public function consultar(int $id_producto, int $id_usuario)
    {
        $sql = "SELECT * FROM detalle_tmp WHERE id_producto = $id_producto AND id_usuario = $id_usuario";
        $data = $this->select($sql);
        return $data;
    }


    public function actualizarVenta(string $precio, int $cantidad, string $sub_total, int $id_producto, int $id_usuario)
    {
        $sql = "UPDATE detalle_tmp SET  precio=?, cantidad=?, sub_total=? WHERE id_producto = ? AND id_usuario = ?";
        $datos = array($precio, $cantidad, $sub_total, $id_producto, $id_usuario);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;
    }


    public function actualizarDesc(string $desc, string $sub_total, int $id)
    {

        $sql = "UPDATE detalle_tmp SET descuento = ?, sub_total = ? WHERE id = ?";
        $datos = array($desc, $sub_total, $id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;


    }

    public function verificarDesc(int $id)
    {
        $sql = "SELECT * FROM detalle_tmp WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }
    public function registrar(int $id_user, string $total, string $cliente, string $pago,  string $restante)
    {

        $sql = "INSERT INTO ventas (id_usuario, total, cliente, pago, restante) VALUES (?,?,?,?,?)";
        $datos = array($id_user, $total, $cliente, $pago, $restante);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;


    }

    public function id_venta()
    {
        $sql = "SELECT MAX(id) AS id FROM ventas";
        $data = $this->select($sql);
        return $data;
    }

    public function regisraDetalleVenta(int $id_compra, int $id_producto, int $cantidad, string $desc, string $precio, string $sub_total)
    {
        $sql = "INSERT INTO detalle_ventas (id_venta, id_producto, cantidad, descuento, precio, sub_total) VALUES (?,?,?,?,?,?)";
        $datos = array($id_compra, $id_producto, $cantidad, $desc, $precio, $sub_total);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;

    }

    public function getEmpresa()
    {
        $sql = "SELECT * FROM config";
        $data = $this->select($sql);
        return $data;
    }

    public function vaciar(int $id_usuario)
    {
        $sql = "DELETE FROM detalle_tmp WHERE id_usuario = ?";
        $datos = array($id_usuario);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;

    }


    public function getProV(int $id_venta)
    {
        $sql = "SELECT v.*, d.*, p.id AS id_Pro, p.descripcion FROM ventas v INNER JOIN detalle_ventas d ON v.id = d.id_venta INNER JOIN productos p ON p.id = d.id_producto WHERE v.id = $id_venta";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function AnularVenta(int $id_venta)
    {
        $sql = "SELECT v.*, d.* FROM ventas v INNER JOIN detalle_ventas d ON v.id = d.id_venta WHERE v.id = $id_venta";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function total(int $id)
    {
        $sql = "SELECT * FROM ventas WHERE id = $id";
        $data = $this->select($sql);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function abonar(int $id, string $abonado)
    {
        $sql = "UPDATE ventas SET abonado = ? WHERE id = ?";
        $datos = array($abonado, $id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function restante(int $id, string $full)
    {
        $sql = "UPDATE ventas SET restante = ? WHERE id = ?";
        $datos = array($full, $id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function Anular(int $id_venta)
    {
        $sql = "UPDATE ventas SET estado = ? WHERE id = ?";
        $datos = array(0, $id_venta);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }


    public function getHistorial()
    {
        $sql = "SELECT * FROM ventas";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getHistorialCS()
    {
        $sql = "SELECT * FROM ventas WHERE pago = 'Credito'";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getVentasCs($id)
    {
        $sql = "SELECT * FROM ventas WHERE pago = 'Credito' AND id = $id";
        $data = $this->select($sql);
        return $data;
    }

    public function actualizarCantidad(int $id_producto, int $pro_total)
    {
        $sql = "UPDATE productos SET cantidad=? WHERE id = ?";
        $datos = array($pro_total, $id_producto);
        $data = $this->save($sql, $datos);
        return $data;
    }

    public function getDesc(int $id_venta)
    {
        $sql = "SELECT descuento, SUM(descuento) AS total FROM detalle_ventas WHERE id_venta = $id_venta";
        $data = $this->select($sql);
        return $data;
    }
    public function verificarPermiso(int $id_user, string $nombre)
    {
        $sql = "SELECT p.id, p.permiso, d.id, d.id_usuario, d.id_permisos FROM permisos p INNER JOIN detalle_permisos d ON p.id = d.id_permisos WHERE d.id_usuario = $id_user AND p.permiso = '$nombre'";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function verificarCaja(int $id)
    {
        $sql = "SELECT * FROM admin_caja WHERE id_usuario = $id AND estado = 1";
        $data = $this->select($sql);
        return $data;
    }
    public function verificarProductos()
    {
        $sql = "SELECT * FROM productos WHERE estado = 1";
        $data = $this->selectAll($sql);
        return $data;
    }



}