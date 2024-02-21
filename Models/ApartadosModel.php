<?php
class ApartadosModel extends Query
{
   public function __construct()
   {
      parent::__construct();
   }

   public function verificarPermiso(int $id_user, string $nombre)
   {
      $sql = "SELECT p.id, p.permiso, d.id, d.id_usuario, d.id_permisos FROM permisos p INNER JOIN detalle_permisos d ON p.id = d.id_permisos WHERE d.id_usuario = $id_user AND p.permiso = '$nombre'";
      $data = $this->selectAll($sql);
      return $data;
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

   public function consultar(int $id_producto, int $id_usuario)
   {
      $sql = "SELECT * FROM detalle_a WHERE id_producto = $id_producto AND id_usuario = $id_usuario";
      $data = $this->select($sql);
      return $data;
   }

   public function registrarApartado(int $id_producto, int $id_usuario, string $precio, int $cantidad, string $sub_total)
   {
      $sql = "INSERT INTO detalle_a(id_producto, id_usuario, precio, cantidad, sub_total) VALUES (?,?,?,?,?)";
      $datos = array($id_producto, $id_usuario, $precio, $cantidad, $sub_total);
      $data = $this->save($sql, $datos);
      if ($data == 1) {
         $res = "ok";
      } else {
         $res = "error";
      }
      return $res;
   }

   public function actualizarApartado(string $precio, int $cantidad, string $sub_total, int $id_producto, int $id_usuario)
   {
      $sql = "UPDATE detalle_a SET  precio=?, cantidad=?, sub_total=? WHERE id_producto = ? AND id_usuario = ?";
      $datos = array($precio, $cantidad, $sub_total, $id_producto, $id_usuario);
      $data = $this->save($sql, $datos);
      if ($data == 1) {
         $res = "modificado";
      } else {
         $res = "error";
      }
      return $res;
   }

   public function getDetalle(int $id)
   {
      $sql = "SELECT d.*, p.id AS id_Pro, p.descripcion FROM detalle_a d INNER JOIN productos p ON d.id_producto = p.id WHERE d.id_usuario = $id";
      $data = $this->selectAll($sql);
      return $data;
   }

   public function calcularApartado(int $id_usuario)
   {
      $sql = "SELECT sub_total, SUM(sub_total) AS total FROM detalle_a WHERE id_usuario = $id_usuario";
      $data = $this->select($sql);
      return $data;
   }

   public function deleteDetlleA(int $id)
   {
      $sql = "DELETE FROM detalle_a WHERE id = ?";
      $datos = array($id);
      $data = $this->save($sql, $datos);
      if ($data == 1) {
         $res = "ok";
      } else {
         $res = "error";
      }
      return $res;
   }
   public function registrar(int $id_user, string $total, string $cliente, string $abonado, string $fecha, string $nota)
   {

      $sql = "INSERT INTO apartados (id_usuario, total, cliente, abonado, nota, fecha) VALUES (?,?,?,?,?,?)";
      $datos = array($id_user, $total, $cliente, $abonado, $nota, $fecha);
      $data = $this->save($sql, $datos);
      if ($data == 1) {
         $res = "ok";
      } else {
         $res = "error";
      }
      return $res;


   }
   public function id_apartado()
   {
      $sql = "SELECT MAX(id) AS id FROM apartados";
      $data = $this->select($sql);
      return $data;
   }

   public function regisraDetalleApartado(int $id_apartado, int $id_producto, int $cantidad, string $desc, string $precio, string $sub_total)
   {
      $sql = "INSERT INTO detalle_apartado (id_apartado, id_producto, cantidad, descuento, precio, sub_total) VALUES (?,?,?,?,?,?)";
      $datos = array($id_apartado, $id_producto, $cantidad, $desc, $precio, $sub_total);
      $data = $this->save($sql, $datos);
      if ($data == 1) {
         $res = "ok";
      } else {
         $res = "error";
      }
      return $res;

   }

   public function actualizarCantidad(int $id_producto, int $pro_total)
   {
      $sql = "UPDATE productos SET cantidad=? WHERE id = ?";
      $datos = array($pro_total, $id_producto);
      $data = $this->save($sql, $datos);
      return $data;
   }

   public function vaciar(int $id_usuario)
   {
      $sql = "DELETE FROM detalle_a WHERE id_usuario = ?";
      $datos = array($id_usuario);
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
      $sql = "SELECT * FROM apartados";
      $data = $this->selectAll($sql);
      return $data;
   }
   public function getCliIden(int $id)
   {
      $sql = "SELECT (cliente) FROM apartados WHERE id = $id";
      $data = $this->select($sql);
      return $data;
   }
   public function getCli(int $cli)
   {
      if ($cli == "Nuevo Cliente") {

      } else {
         $sql = "SELECT * FROM clientes WHERE cc = '$cli'";
         $data = $this->select($sql);
         return $data;
      }

   }
   public function getApar(int $id)
   {

      $sql = "SELECT * FROM detalle_apartado WHERE id_apartado = $id";
      $data = $this->selectAll($sql);
      return $data;


   }
   public function getFecha(int $id)
   {

      $sql = "SELECT * FROM apartados WHERE id = $id";
      $data = $this->select($sql);
      return $data;


   }


}