<?php
class ProveedorModel extends Query
{
   private $identificacion, $nombre, $telefono, $direccion, $id, $estado;
   public function __construct()
   {
      parent::__construct();
   }

   public function getProveedor()
   {
      $sql = "SELECT * FROM proveedor";
      $data = $this->selectAll($sql);
      return $data;
   }

   public function registrarPro(string $identificacion, string $nombre, string $telefono, string $direccion)
   {
      $this->identificacion = $identificacion;
      $this->nombre = $nombre;
      $this->telefono = $telefono;
      $this->direccion = $direccion;
      $verificar = "SELECT * FROM proveedor WHERE cc = '$this->identificacion'";
      $existe = $this->select($verificar);
      if (empty($existe)) {
         $sql = "INSERT INTO proveedor(cc, nombre, telefono, direccion) VALUES (?,?,?,?)";
         $datos = array($this->identificacion, $this->nombre, $this->telefono, $this->direccion);
         $data = $this->save($sql, $datos);
         if ($data == 1) {
            $res = 'ok';
         } else {
            $res = 'error';
         }
      } else {
         $res = "existe";
      }

      return $res;
   }

   public function modificarPro(string $identificacion, string $nombre, string $telefono, string $direccion, int $id)
   {
      $this->identificacion = $identificacion;
      $this->nombre = $nombre;
      $this->telefono = $telefono;
      $this->direccion = $direccion;
      $this->id = $id;
      $sql = "UPDATE proveedor SET cc=?, nombre=?, telefono=?, direccion=? WHERE id = ?";
      $datos = array($this->identificacion, $this->nombre, $this->telefono, $this->direccion, $this->id);
      $data = $this->save($sql, $datos);
      if ($data == 1) {
         $res = "modificado";
      } else {
         $res = 'error';
      }
      return $res;
   }

   public function editarPro(int $id)
   {
      $sql = "SELECT * FROM proveedor WHERE id = $id";
      $data = $this->select($sql);
      return $data;
   }

   public function eliminarPro(int $id)
   {
      $this->id = $id;
      $sql = "UPDATE proveedor SET estado = 0 WHERE id = ?";
      $datos = array($this->id);
      $data = $this->save($sql, $datos);
      return $data;
   }

   public function reingresarPro(int $id)
   {
      $this->id = $id;
      $sql = "UPDATE proveedor SET estado = 1 WHERE id = ?";
      $datos = array($this->id);
      $data = $this->save($sql, $datos);
      return $data;
   }
   public function getPro(string $client)
   {

      $sql = "SELECT * FROM proveedor WHERE cc = '$client'";
      $data = $this->select($sql);
      return $data;

   }
   public function verificarPermiso(int $id_user, string $nombre)
    {
        $sql = "SELECT p.id, p.permiso, d.id, d.id_usuario, d.id_permisos FROM permisos p INNER JOIN detalle_permisos d ON p.id = d.id_permisos WHERE d.id_usuario = $id_user AND p.permiso = '$nombre'";
        $data = $this->selectAll($sql);
        return $data;
    }

}
?>