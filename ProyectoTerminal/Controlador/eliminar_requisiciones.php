<?php
include "../Modelo/conexion.php";

if(!empty($_POST["btnEliminar"])){
    if(!empty($_GET["id"])){
        $id=$_GET["id"];
        $sql=$conexion->query("DELETE FROM requisicion WHERE Id_Requisicion=$id");
        if ($sql==1) {
            header("location: ../Vistas/Mod04Requisiciones.php");
        } else {
            echo "No fue posible borrar";
        }
        
    }
}


?>