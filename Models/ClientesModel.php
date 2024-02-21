<?php
class ClientesModel extends Query
{
   private $identificacion, $nombre, $telefono, $direccion, $id, $estado;
   public function __construct()
   {
      parent::__construct();
   }

   public function getClientes()
   {
      $sql = "SELECT * FROM clientes";
      $data = $this->selectAll($sql);
      return $data;
   }

   public function registrarCli(string $identificacion, string $nombre, string $telefono, string $direccion)
   {
      $this->identificacion = $identificacion;
      $this->nombre = $nombre;
      $this->telefono = $telefono;
      $this->direccion = $direccion;
      $verificar = "SELECT * FROM clientes WHERE cc = '$this->identificacion'";
      $existe = $this->select($verificar);
      if (empty($existe)) {
         $sql = "INSERT INTO clientes(cc, nombre, telefono, direccion) VALUES (?,?,?,?)";
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

   public function modificarCli(string $identificacion, string $nombre, string $telefono, string $direccion, int $id)
   {
      $this->identificacion = $identificacion;
      $this->nombre = $nombre;
      $this->telefono = $telefono;
      $this->direccion = $direccion;
      $this->id = $id;
      $sql = "UPDATE clientes SET cc=?, nombre=?, telefono=?, direccion=? WHERE id = ?";
      $datos = array($this->identificacion, $this->nombre, $this->telefono, $this->direccion, $this->id);
      $data = $this->save($sql, $datos);
      if ($data == 1) {
         $res = "modificado";
      } else {
         $res = 'error';
      }
      return $res;
   }

   public function editarCli(int $id)
   {
      $sql = "SELECT * FROM clientes WHERE id = $id";
      $data = $this->select($sql);
      return $data;
   }

   public function eliminarCli(int $id)
   {
      $this->id = $id;
      $sql = "UPDATE clientes SET estado = 0 WHERE id = ?";
      $datos = array($this->id);
      $data = $this->save($sql, $datos);
      return $data;
   }

   public function reingresarCli(int $id)
   {
      $this->id = $id;
      $sql = "UPDATE clientes SET estado = 1 WHERE id = ?";
      $datos = array($this->id);
      $data = $this->save($sql, $datos);
      return $data;
   }
   public function getCli(string $client)
   {

      $sql = "SELECT * FROM clientes WHERE cc = '$client'";
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