<?php
include "../Modelo/conexion.php";


    if(!empty($_POST["id"])){
        $id=$_POST["id"];
        $sql=$conexion->query("DELETE FROM articulo WHERE Id_Articulo=$id");
        if ($sql==1) {
            header("location: ../Vistas/Mod03Articulos.php");
        } else {
            echo "NIMAYES";
        }
        
    }


?>