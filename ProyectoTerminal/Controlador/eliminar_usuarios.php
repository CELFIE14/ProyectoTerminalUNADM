<?php
include "../Modelo/conexion.php";


    if(!empty($_POST["id"])){
        $id=$_POST["id"];
        $sql=$conexion->query("DELETE FROM usuario WHERE Id_Usuario=$id");
        if ($sql==1) {
            header("location: ../Vistas/Mod01Admin.php");
        } else {
            echo "NIMAYES";
        }
        
    }



?>