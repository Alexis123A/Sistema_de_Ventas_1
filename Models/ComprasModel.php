<?php
class ComprasModel extends Query
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


   public function registrarCompra(int $id_producto, int $id_usuario, string $precio, int $cantidad, string $sub_total)
   {
      $sql = "INSERT INTO detalle(id_producto, id_usuario, precio, cantidad, sub_total) VALUES (?,?,?,?,?)";
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
      $sql = "SELECT d.*, p.id AS id_Pro, p.descripcion FROM detalle d INNER JOIN productos p ON d.id_producto = p.id WHERE d.id_usuario = $id";
      $data = $this->selectAll($sql);
      return $data;
   }
   public function calcularCompra(int $id_usuario)
   {
      $sql = "SELECT sub_total, SUM(sub_total) AS total FROM detalle WHERE id_usuario = $id_usuario";
      $data = $this->select($sql);
      return $data;
   }

   public function deteteDetlle(int $id)
   {
      $sql = "DELETE FROM detalle WHERE id = ?";
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
      $sql = "SELECT * FROM detalle WHERE id_producto = $id_producto AND id_usuario = $id_usuario";
      $data = $this->select($sql);
      return $data;
   }


   public function actualizarCompra(string $precio, int $cantidad, string $sub_total, int $id_producto, int $id_usuario)
   {
      $sql = "UPDATE detalle SET  precio=?, cantidad=?, sub_total=? WHERE id_producto = ? AND id_usuario = ?";
      $datos = array($precio, $cantidad, $sub_total, $id_producto, $id_usuario);
      $data = $this->save($sql, $datos);
      if ($data == 1) {
         $res = "modificado";
      } else {
         $res = "error";
      }
      return $res;
   }


   public function registrar(string $total)
   {

      $sql = "INSERT INTO compras (total) VALUES (?)";
      $datos = array($total);
      $data = $this->save($sql, $datos);
      if ($data == 1) {
         $res = "ok";
      } else {
         $res = "error";
      }
      return $res;


   }

   public function id_compra()
   {
      $sql = "SELECT MAX(id) AS id FROM compras";
      $data = $this->select($sql);
      return $data;
   }

   public function regisraDetalleCompra(int $id_compra, int $id_producto, int $cantidad, string $precio, string $sub_total)
   {
      $sql = "INSERT INTO detalle_compras (id_compra, id_producto, cantidad, precio, sub_total) VALUES (?,?,?,?,?)";
      $datos = array($id_compra, $id_producto, $cantidad, $precio, $sub_total);
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
      $sql = "DELETE FROM detalle WHERE id_usuario = ?";
      $datos = array($id_usuario);
      $data = $this->save($sql, $datos);
      if ($data == 1) {
         $res = "ok";
      } else {
         $res = "error";
      }
      return $res;

   }


   public function getProC(int $id_compra)
   {
      $sql = "SELECT c.*, d.*, p.id AS id_Pro, p.descripcion FROM compras c INNER JOIN detalle_compras d ON c.id = d.id_compra INNER JOIN productos p ON p.id = d.id_producto WHERE c.id = $id_compra";
      $data = $this->selectAll($sql);
      return $data;
   }


   public function getHistorial()
   {
      $sql = "SELECT * FROM compras";
      $data = $this->selectAll($sql);
      return $data;
   }

   public function actualizarCantidad(int $id_producto, int $pro_total)
   {
      $sql = "UPDATE productos SET cantidad=? WHERE id = ?";
      $datos = array($pro_total, $id_producto);
      $data = $this->save($sql, $datos);
      return $data;
   }
   public function verificarPermiso(int $id_user, string $nombre)
    {
        $sql = "SELECT p.id, p.permiso, d.id, d.id_usuario, d.id_permisos FROM permisos p INNER JOIN detalle_permisos d ON p.id = d.id_permisos WHERE d.id_usuario = $id_user AND p.permiso = '$nombre'";
        $data = $this->selectAll($sql);
        return $data;
    }
}