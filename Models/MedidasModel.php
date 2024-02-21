<?php 
class MedidasModel extends Query
{
   private $medidas, $medidas_corto, $id, $estado;
   public function __construct()
   {
      parent::__construct();
   }
   
   public function getMedidas()
   {
      $sql = "SELECT * FROM medidas";
      $data = $this->selectAll($sql);
      return $data;
   }

   public function registrarMedidas(string $medidas, string $medidas_corto)
   {
      $this->medidas = $medidas;
      $this->medidas_corto = $medidas_corto;
      $verificar = "SELECT * FROM medidas WHERE medidas = '$this->medidas'";
      $existe = $this->select($verificar);
      if (empty($existe)) {
         $sql = "INSERT INTO medidas(medidas, medidas_corto) VALUES (?,?)";
         $datos = array($this->medidas, $this->medidas_corto);
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

   public function modificarMedidas(string $medidas, string $medidas_corto, int $id)
   {
      $this->medidas = $medidas;
      $this->medidas_corto = $medidas_corto;
      $this->id = $id;
      $sql = "UPDATE medidas SET medidas=?, medidas_corto=? WHERE id = ?";
      $datos = array($this->medidas, $this->medidas_corto, $this->id);
      $data = $this->save($sql, $datos);
      if ($data == 1) {
         $res = "modificado";
      } else {
         $res = 'error';
      }
      return $res;
   }

   public function editarMedidas(int $id)
   {
      $sql = "SELECT * FROM medidas WHERE id = $id";
      $data = $this->select($sql);
      return $data;
   }

public function eliminarMedidas(int $id)
{
   $this->id = $id;
   $sql = "UPDATE medidas SET estado = 0 WHERE id = ?";
   $datos = array($this->id);
   $data = $this->save($sql, $datos);
   return $data;
  }

  public function reingresarMedidas(int $id)
{
   $this->id = $id;
   $sql = "UPDATE medidas SET estado = 1 WHERE id = ?";
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