<?php
$conexion=new mysqli("localhost", "root", "", "dbsgic");
$conexion->set_charset("utf8");

if($conexion->connect_error){
    die('Error en la conexión' . $conexion->connect_error);
}


?>