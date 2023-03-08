<?php
    include "../Modelo/conexion.php";
    
if(!empty($_POST["btnGuardarEdit"])){

        $id=$_POST["id"];
        $movimiento=$_POST["catMovimiento"];
        $articulo=$_POST["catArticulo"];
        $cantidad=$_POST["cantidad"];


        $condiciones = "";

        if ($movimiento > 0) {
            if ($condiciones != "") {
                $condiciones .= ", Id_Cat_Mov = ".$movimiento."";
            } else {
                $condiciones = " SET Id_Cat_Mov = ".$movimiento."";
            }
        }
        
        if ($articulo > 0) {
            if ($condiciones != "") {
                $condiciones .= ", Id_Articulo = ".$articulo."";
            } else {
                $condiciones = " SET Id_Articulo = ".$articulo."";
            }
        }
        if ($cantidad != "") {
            if ($condiciones != "") {
            $condiciones .= ", Cantidad = '".$cantidad."'";
        } else {
            $condiciones = " SET Cantidad = '".$cantidad."'";
        }
    }
    
    if ($condiciones != "") {
        $query = "UPDATE movimientos_almacen ".$condiciones." WHERE Id_Mov_Almacen = ".$id;
        $sql = $conexion->query($query);

        if ($sql == 1) {
            header("location: ../Vistas/Mod05Bitacora.php");
        } else {
            echo "No se pudo guardar";
        }
    } else {
        header("location: ../Vistas/Mod05Bitacora.php");
    }

}
?>