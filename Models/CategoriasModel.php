<?php 
class CategoriasModel extends Query
{
   private $categorias, $id, $estado;
   public function __construct()
   {
      parent::__construct();
   }
   
   public function getCategorias()
   {
      $sql = "SELECT * FROM categorias";
      $data = $this->selectAll($sql);
      return $data;
   }

   public function registrarCategorias(string $categorias)
   {
      $this->categorias = $categorias;
      $verificar = "SELECT * FROM categorias WHERE categorias = '$this->categorias'";
      $existe = $this->select($verificar);
      if (empty($existe)) {
         $sql = "INSERT INTO categorias(categorias) VALUES (?)";
         $datos = array($this->categorias);
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

   public function modificarCategorias(string $categorias, int $id)
   {
      $this->categorias = $categorias;
      $this->id = $id;
      $sql = "UPDATE categorias SET categorias=? WHERE id = ?";
      $datos = array($this->categorias, $this->id);
      $data = $this->save($sql, $datos);
      if ($data == 1) {
         $res = "modificado";
      } else {
         $res = 'error';
      }
      return $res;
   }

   public function editarCategorias(int $id)
   {
      $sql = "SELECT * FROM categorias WHERE id = $id";
      $data = $this->select($sql);
      return $data;
   }

public function eliminarCategorias(int $id)
{
   $this->id = $id;
   $sql = "UPDATE categorias SET estado = 0 WHERE id = ?";
   $datos = array($this->id);
   $data = $this->save($sql, $datos);
   return $data;
  }

  public function reingresarCategorias(int $id)
{
   $this->id = $id;
   $sql = "UPDATE categorias SET estado = 1 WHERE id = ?";
   $datos = array($this->id);
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
?>