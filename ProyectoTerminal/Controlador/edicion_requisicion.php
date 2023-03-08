<?php
    include "../Modelo/conexion.php";
    
if(!empty($_POST["btnGuardarEdit"])){
    if(!empty($_POST["articulo"]) and !empty($_POST["precio"]) and !empty($_POST["fechareq"]) 
    and !empty($_POST["descripcion"]))
    {
        $id=$_POST["id"];
        $articulo=$_POST["articulo"];
        $descripcion=$_POST["descripcion"];
        $fecha=$_POST["fechareq"];


        $sql = $conexion->query("UPDATE requisicion set Id_Articulo= '$articulo', Descripcion='$descripcion', 
        Fecha_Requisicion='$fecha' WHERE Id_Requisicion =$id ");

        if ($sql==1) {
            header("location: ../Vistas/Mod04Rquisicion.php");
        } else {
            echo "No se pudo guardar";
        }
        
    }else{
        echo "campos vacios";
    }
}

?>