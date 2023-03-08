<?php             
    include "../Modelo/conexion.php";

if(!empty($_POST["btnGuardar"])){

    if(!empty($_POST["catMovimiento"])) {
        }else{
            echo "El campo de tipo de movimiento no puede estar vacío";
        }
    if(!empty($_POST["fechaMov"])) { 
        }else{
           echo "La fecha no puede estar vacía";
        }


    if(!empty($_POST["cantidad"])) { 
        }else{
           echo "La cantidad no puede estar vacía";
        }


    $tipoMov=$_POST["catMovimiento"];
    $fecha=$_POST["fechaMov"];
    $articulo=$_POST["catArticulo"];
    $cantidad=$_POST["cantidad"];
    $usuario='35';


    $sql=$conexion->query("INSERT INTO movimientos_almacen(Id_Cat_Mov, Fecha_Movimiento, Id_Articulo, Cantidad, Id_Usuario)
    values('$tipoMov', '$fecha', '$articulo', '$cantidad', '$usuario')");
    if($sql== 1){
        header("location: ../Vistas/Mod05Bitacora.php");
    
    
}else{
    echo "Los campos no pueden ser vacíos";
}
}
?>