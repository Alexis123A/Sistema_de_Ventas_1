<?php
class CajaModel extends Query
{
   private $caja, $id, $estado;
   public function __construct()
   {
      parent::__construct();
   }

   
   public function getArqueo()
   {
      $sql = "SELECT * FROM admin_caja";
      $data = $this->selectAll($sql);
      return $data;
   }
   public function getCaja()
   {
      $sql = "SELECT * FROM caja";
      $data = $this->selectAll($sql);
      return $data;
   }

   public function actualizarArqueo(string $monto_final, string $fecha, int $total_ventas, string $general, int $id)
   {
      $sql = "UPDATE admin_caja SET monto_final = ?, fecha_cierre = ?, total_ventas = ? , monto_total = ?, estado = ? WHERE id = ?";
      $datos = array($monto_final, $fecha, $total_ventas, $general, 0, $id);
      $data = $this->save($sql, $datos);
      if ($data == 1) {
         $res = 'ok';
      } else {
         $res = 'error';
      }
      return $res;
   }

   public function actualizarApertura(int $id)
   {

      $sql = "UPDATE ventas SET apertura = ? WHERE id_usuario = ?";
      $datos = array(0, $id);
      $this->save($sql, $datos);
   }

   public function registrarArqueo(int $id_usuario, string $monto, string $fecha)
   {

      $verificar = "SELECT * FROM admin_caja WHERE id_usuario = $id_usuario AND estado = 1";
      $existe = $this->select($verificar);
      if (empty($existe)) {
         $sql = "INSERT INTO admin_caja(id_usuario, monto_inicial, fecha_apertura) VALUES (?,?,?)";
         $datos = array($id_usuario, $monto, $fecha);
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
   public function registrarCaja(string $caja)
   {

      $this->caja = $caja;
      $verificar = "SELECT * FROM caja WHERE caja = '$this->caja'";
      $existe = $this->select($verificar);
      if (empty($existe)) {
         $sql = "INSERT INTO caja(caja) VALUES (?)";
         $datos = array($this->caja);
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

   public function modificarCaja(string $caja, int $id)
   {
      $this->caja = $caja;
      $this->id = $id;
      $sql = "UPDATE caja SET caja=? WHERE id = ?";
      $datos = array($this->caja, $this->id);
      $data = $this->save($sql, $datos);
      if ($data == 1) {
         $res = "modificado";
      } else {
         $res = 'error';
      }
      return $res;
   }

   public function editarCaja(int $id)
   {
      $sql = "SELECT * FROM caja WHERE id = $id";
      $data = $this->select($sql);
      return $data;
   }

   public function eliminarCaja(int $id)
   {
      $this->id = $id;
      $sql = "UPDATE caja SET estado = 0 WHERE id = ?";
      $datos = array($this->id);
      $data = $this->save($sql, $datos);
      return $data;
   }

   public function reingresarCaja(int $id)
   {
      $this->id = $id;
      $sql = "UPDATE caja SET estado = 1 WHERE id = ?";
      $datos = array($this->id);
      $data = $this->save($sql, $datos);
      return $data;
   }

   public function getVentas(int $id_user)
   {
      $sql = "SELECT SUM(total) AS total FROM ventas WHERE id_usuario = $id_user AND estado = 1 AND apertura = 1";
      $data = $this->select($sql);
      return $data;
   }
   public function getTotalVentas(int $id_user)
   {
      $sql = "SELECT COUNT(total) AS total FROM ventas WHERE id_usuario = $id_user AND estado = 1 AND apertura = 1";
      $data = $this->select($sql);
      return $data;
   }
   public function getMontoInicial(int $id_user)
   {
      $sql = "SELECT id, monto_inicial FROM admin_caja WHERE id_usuario = $id_user AND estado = 1";
      $data = $this->select($sql);
      return $data;
   }

   public function verificarPermiso(int $id_user, string $nombre)
   {
      $sql = "SELECT p.id, p.permiso, d.id, d.id_usuario, d.id_permisos FROM permisos p INNER JOIN detalle_permisos d ON p.id = d.id_permisos WHERE d.id_usuario = $id_user AND p.permiso = '$nombre'";
      $data = $this->selectAll($sql);
      return $data;
   }



   public function getMontoInicialA(int $id)
   {
      $sql = "SELECT SUM(monto_inicial) AS monto_inicial FROM admin_caja WHERE id_usuario = $id" ;
      $data = $this->select($sql);
      return $data;
   }
  
   public function getMontoTotal(int $id)
   {
      $sql = "SELECT SUM(monto_total) AS monto_total FROM admin_caja WHERE id_usuario = $id" ;
      $data = $this->select($sql);
      return $data;
   }


   public function getMovimiento(int $id)
   {
      $sql = "SELECT a.id_usuario, a.monto_inicial, a.monto_total, SUM(a.monto_inicial) AS monto, SUM(a.monto_total) AS total FROM admin_caja a WHERE a.id_usuario = $id";
      $data = $this->selectAll($sql);
      return $data;
   }
}

?>