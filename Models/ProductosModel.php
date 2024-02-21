<?php
class ProductosModel extends Query
{
    private $codigo, $descripcion, $precio_compra, $precio_venta, $id_medida, $id_categoria, $imgNombre, $id, $estado;
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
    public function getMedidas()
    {
        $sql = "SELECT * FROM medidas WHERE estado = 1";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function getCategorias()
    {
        $sql = "SELECT * FROM categorias WHERE estado = 1";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getProductos()
    {
        $sql = "SELECT p.*, m.id AS id_medida, m.medidas, c.id AS id_categoria, c.categorias FROM productos p INNER JOIN medidas m ON p.id_medida = m.id INNER JOIN categorias c ON p.id_categoria = c.id";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function registrarProducto(string $codigo, string $descripcion, string $precio_compra, string $precio_venta, int $id_medida, int $id_categoria, string $imgNombre)
    {
        $this->codigo = $codigo;
        $this->descripcion = $descripcion;
        $this->precio_compra = $precio_compra;
        $this->precio_venta = $precio_venta;
        $this->id_medida = $id_medida;
        $this->id_categoria = $id_categoria;
        $this->imgNombre = $imgNombre;
        $verificar = "SELECT * FROM productos WHERE codigo = '$this->codigo'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $sql = "INSERT INTO productos(codigo, descripcion, precio_compra, precio_venta, id_medida, id_categoria, img) VALUES (?,?,?,?,?,?,?)";
            $datos = array($this->codigo, $this->descripcion, $this->precio_compra, $this->precio_venta, $this->id_medida, $this->id_categoria, $this->imgNombre);
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

    public function modificarProductos(string $codigo, string $descripcion, string $precio_compra, string $precio_venta, int $id_medida, int $id_categoria, string $img, int $id)
    {
        $this->codigo = $codigo;
        $this->descripcion = $descripcion;
        $this->precio_compra = $precio_compra;
        $this->precio_venta = $precio_venta;
        $this->id_medida = $id_medida;
        $this->id_categoria = $id_categoria;
        $this->img = $img;
        $this->id = $id;
        $sql = "UPDATE productos SET codigo=?, descripcion=?, precio_compra=?, precio_venta=?, id_medida=?, id_categoria=?, img=? WHERE id = ?";
        $datos = array($this->codigo, $this->descripcion, $this->precio_compra, $this->precio_venta, $this->id_medida, $this->id_categoria, $this->img, $this->id);
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
        $sql = "SELECT * FROM productos WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }

    public function eliminarPro(int $id)
    {
        $this->id = $id;
        $sql = "UPDATE productos SET estado = 0 WHERE id = ?";
        $datos = array($this->id);
        $data = $this->save($sql, $datos);
        return $data;
    }

    public function reingresarUser(int $id)
    {
        $this->id = $id;
        $sql = "UPDATE productos SET estado = 1 WHERE id = ?";
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