<?php

class HomeModel extends Query{
    public function __construct()
   {
   }
    public function getEmpresa()
    {
       $sql = "SELECT * FROM config";
       $data = $this->select($sql);
       return $data;
    }
}





?>