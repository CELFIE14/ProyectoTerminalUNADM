<?php
include "../Modelo/conexion.php";

    if(!empty($_POST["id"])){
        $id=$_POST["id"];
        $sql=$conexion->query("DELETE FROM movimientos_almacen WHERE Id_Mov_Almacen=$id");
        if ($sql==1) {
            header("location: ../Vistas/Mod05Bitacora.php");
        } else {
            echo "NIMAYES";
        }
        
    }


?>