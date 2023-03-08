<?php             
    include "../Modelo/conexion.php";

if(!empty($_POST["btnGuardar"])){

    if(!empty($_POST["articulo"])) {
        }else{
            echo "El campo artículo no puede estar vacío";
        }
    if(!empty($_POST["precio"])) { 
        }else{
           echo "El precio no puede estar vacío";
        }
    
    if(!empty($_POST["descripcion"])) { 
        }else{
       echo "La descripción no puede estar vacía";
    }

    if(!empty($_POST["fechareq"])) { 
        }else{
       echo "La fecha no puede estar vacía";
    }


/*     $articulo=$_POST["articulo"];
    $cantidadSol=$_POST["cantidadSol"];
    $categoria=$_POST["catCategoria"];
    $proveedor=$_POST["catProveedor"];
    $precio=$_POST["precio"];
    $umedida=$_POST["catUmedida"]; */
    $fechareq=$_POST["fechareq"];
    $usuario='35';
    $descripcion=$_POST["descripcion"];
    $estatusInicial = '2';


    $sql=$conexion->query("INSERT INTO requisicion(Fecha_Requisicion, Id_Usuario, Descripcion, Id_Cat_Estatus)
    values('$fechareq', '$usuario', '$descripcion','$estatusInicial')");
    if($sql== 1){
        header("location: ../Vistas/Mod04Requisiciones.php");
    
    
}else{
    echo "Los campos no pueden ser vacíos";
}
}
?>