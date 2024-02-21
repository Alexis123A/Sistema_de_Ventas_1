<?php
class UsuariosModel extends Query
{
   private $usuario, $correo, $nombre, $pass, $id_caja, $id;
   public function __construct()
   {
      parent::__construct();
   }
   public function getUsuario(string $usuario, string $pass)
   {
      $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND clave = '$pass'";
      $data = $this->select($sql);
      return $data;
   }
   public function getDetallePermisos(int $id)
   {
      $sql = "SELECT * FROM detalle_permisos WHERE id_usuario = $id";
      $data = $this->selectAll($sql);
      return $data;
   }
   public function getPermisos()
   {
      $sql = "SELECT * FROM permisos";
      $data = $this->selectAll($sql);
      return $data;
   }
   public function getCajas()
   {
      $sql = "SELECT * FROM caja WHERE estado = 1";
      $data = $this->selectAll($sql);
      return $data;
   }
   public function verificarPermiso(int $id_user, string $nombre)
    {
        $sql = "SELECT p.id, p.permiso, d.id, d.id_usuario, d.id_permisos FROM permisos p INNER JOIN detalle_permisos d ON p.id = d.id_permisos WHERE d.id_usuario = $id_user AND p.permiso = '$nombre'";
        $data = $this->selectAll($sql);
        return $data;
    }
   public function getUsuarios()
   {
      $sql = "SELECT u.*, c.id as id_caja, c.caja FROM usuarios u INNER JOIN caja c WHERE u.id_caja = c.id";
      $data = $this->selectAll($sql);
      return $data;
   }
   public function registrarUsuario(string $usuario, string $correo, string $nombre, string $pass, int $id_caja)
   {
      $this->usuario = $usuario;
      $this->correo = $correo;
      $this->nombre = $nombre;
      $this->pass = $pass;
      $this->id_caja = $id_caja;
      $verificar = "SELECT * FROM usuarios WHERE usuario = '$this->usuario'";
      $existe = $this->select($verificar);
      if (empty($existe)) {
         $sql = "INSERT INTO usuarios(usuario, correo, nombre, clave, id_caja) VALUES (?,?,?,?,?)";
         $datos = array($this->usuario, $this->correo, $this->nombre, $this->pass, $this->id_caja);
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

   public function modificarUsuario(string $usuario, string $correo, string $nombre, int $id_caja, int $id)
   {
      $this->usuario = $usuario;
      $this->correo = $correo;
      $this->nombre = $nombre;
      $this->id_caja = $id_caja;
      $this->id = $id;
      $sql = "UPDATE usuarios SET usuario=?, correo=?, nombre=?, id_caja=? WHERE id = ?";
      $datos = array($this->usuario, $this->correo, $this->nombre, $this->id_caja, $this->id);
      $data = $this->save($sql, $datos);
      if ($data == 1) {
         $res = "modificado";
      } else {
         $res = 'error';
      }
      return $res;
   }


   public function editarUser(int $id)
   {
      $sql = "SELECT * FROM usuarios WHERE id = $id";
      $data = $this->select($sql);
      return $data;
   }

   public function getPass(string $clave, int $id)
   {
      $sql = "SELECT * FROM usuarios WHERE clave = '$clave' AND id = $id";
      $data = $this->select($sql);
      return $data;
   }

   public function eliminarUser(int $id)
   {
      $this->id = $id;
      $sql = "UPDATE usuarios SET estado = 0 WHERE id = ?";
      $datos = array($this->id);
      $data = $this->save($sql, $datos);
      return $data;
   }

   public function reingresarUser(int $id)
   {
      $this->id = $id;
      $sql = "UPDATE usuarios SET estado = 1 WHERE id = ?";
      $datos = array($this->id);
      $data = $this->save($sql, $datos);
      return $data;
   }

   public function modificarPass(string $clave, int $id)
   {
      $sql = "UPDATE usuarios SET clave = ? WHERE id = ?";
      $datos = array($clave, $id);
      $data = $this->save($sql, $datos);
      return $data;
   }

   public function registrarPermisos(int $id, int $id_per)
   {
      $sql = "INSERT INTO detalle_permisos (id_usuario, id_permisos) VALUES (?,?)";
      $datos = array($id, $id_per);
      $data = $this->save($sql, $datos);
      if ($data == 1) {
         $res = 'ok';
      } else {
         $res = 'error';
      }
      return $res;
   }
   public function eliminarPermisos(int $id)
   {
      $sql = "DELETE FROM detalle_permisos WHERE id_usuario = ?";
      $datos = array($id);
      $data = $this->save($sql, $datos);
      if ($data == 1) {
         $res = 'ok';
      } else {
         $res = 'error';
      }
      return $res;
   }


}



?>