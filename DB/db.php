<?php
class Conectar{
    public static function conexion(){
        $conexion=new mysqli("161.132.38.229", "root", "Upt2024", "DBSOSA");
        $conexion->query("SET NAMES 'utf8'");
        return $conexion;
    }
}
?>
