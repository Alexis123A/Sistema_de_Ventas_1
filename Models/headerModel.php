<?php
class headerModel extends Query
{

    public function Usuarios(int $id)
    {
        $sql = "SELECT * FROM usuarios WHERE id = $id";
        $data = $this->selectAll($sql);
        return $data;
    }
}