<?php
class Info extends Controller
{
    public function __construct()
    {
        session_start();
        if (empty($_SESSION['activo'])) {
            header("location: " . base_url);
        }
        parent::__construct();
    }
    public function index()
    {
        $id_user = $_SESSION['id_usuario'];
        $verificar = $this->model->verificarPermiso($id_user, 'Info');
        if (!empty($verificar) || $id_user == 1) {
            $data = $this->model->getEmpresa();
            $this->views->getView($this, "index", $data);
        } else {
            header('Location: ' . base_url . 'Errors/permisos');
        }
    }
}