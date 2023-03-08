<?php
    include "../Modelo/conexion.php";
    
if(!empty($_POST["btnGuardarEdit"])){
    $id = $_POST["id"];
    $articulo = $_POST["articulo"];
    $categoria = $_POST["catCategoria"];
    $proveedor = $_POST["catProveedor"];
    $precio = $_POST["precio"];
    $unidad = $_POST["catUmedida"];
    
    
    $condiciones = "";
    if (isset($articulo) && $articulo != "") {
        $condiciones = " SET Articulo = '".$articulo."'";
    }
    
    if ($categoria > 0) {
        if ($condiciones != "") {
            $condiciones .= ", Id_Categoria = ".$categoria."";
        } else {
            $condiciones = " SET Id_Categoria = ".$categoria."";
        }
    }

    if ($proveedor > 0) {
        if ($condiciones != "") {
            $condiciones .= ", Id_Proveedor = ".$proveedor."";
        } else {
            $condiciones = " SET Id_Proveedor = ".$proveedor."";
        }
    }

    if ($precio != "") {
        if ($condiciones != "") {
            $condiciones .= ", Precio_Unitario = '".$precio."'";
        } else {
            $condiciones = " SET Precio_Unitario = '".$precio."'";
        }
    }

    if ($unidad > 0) {
        if ($condiciones != "") {
            $condiciones .= ", Id_Cat_Unidad = '".$unidad."'";
        } else {
            $condiciones = " SET Id_Cat_Unidad = '".$unidad."'";
        }
    }

    if ($condiciones != "") {
        $query = "UPDATE articulo ".$condiciones." WHERE Id_Articulo = ".$id;
        $sql = $conexion->query($query);

        if ($sql == 1) {
            header("location: ../Vistas/Mod03Articulos.php");
        } else {
            echo "No se pudo guardar";
        }
    } else {
        header("location: ../Vistas/Mod03Articulos.php");
    }
}

?>