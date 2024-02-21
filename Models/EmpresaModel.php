<?php
class EmpresaModel extends Query
{
   private $medidas, $medidas_corto, $id, $estado;
   public function __construct()
   {
      parent::__construct();
   }

   public function getEmpresa()
   {
      $sql = "SELECT * FROM config";
      $data = $this->select($sql);
      return $data;
   }
   public function getDatos(string $table)
   {
      $sql = "SELECT COUNT(*) AS total FROM $table";
      $data = $this->select($sql);
      return $data;
   }
   public function getVentas()
   {
      $sql = "SELECT COUNT(*) AS total FROM ventas WHERE fecha > CURDATE()";
      $data = $this->select($sql);
      return $data;
   }
   public function getCompras()
   {
      $sql = "SELECT COUNT(*) AS total FROM compras WHERE fecha > CURDATE()";
      $data = $this->select($sql);
      return $data;
   }

   public function modificar(string $ident, string $nombre, string $telefono, string $direccion, string $descripcion, int $id)
   {
      $sql = "UPDATE config SET  identificacion=?, nombre=?, telefono=?, direccion=?, descripcion=? WHERE id = ?";
      $datos = array($ident, $nombre, $telefono, $direccion, $descripcion, $id);
      $data = $this->save($sql, $datos);
      if ($data == 1) {
         $res = 'ok';
      } else {
         $res = 'error';
      }

      return $res;
   }

   public function getStockMinimo()
   {
      $sql = "SELECT * FROM productos WHERE cantidad < 15 ORDER BY cantidad DESC LIMIT 10";
      $data = $this->selectAll($sql);
      return $data;
   }
   public function getMasVendidos()
   {
      $sql = "SELECT d.id_producto, d.cantidad, p.id, p.descripcion, SUM(d.cantidad) AS total FROM detalle_ventas d INNER JOIN productos p ON p.id = d.id_producto GROUP BY d.id_producto ORDER BY d.cantidad DESC LIMIT 10";
      $data = $this->selectAll($sql);
      return $data;
   }
   public function verificarPermiso(int $id_user, string $nombre)
    {
        $sql = "SELECT p.id, p.permiso, d.id, d.id_usuario, d.id_permisos FROM permisos p INNER JOIN detalle_permisos d ON p.id = d.id_permisos WHERE d.id_usuario = $id_user AND p.permiso = '$nombre'";
        $data = $this->selectAll($sql);
        return $data;
    }


}
