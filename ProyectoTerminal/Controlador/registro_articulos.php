<?php             
    include "../Modelo/conexion.php";

if(!empty($_POST["btnGuardar"])){

    if(!empty($_POST["articulo"])) {
        if (!preg_match("/^[a-zA-Z[:space:]]{3,50}$/", $_POST['articulo'])){
            echo "El articulo no coincide con el formato solicitado";
            exit();
        }

        }else{
            echo "El campo de nombre no puede estar vacío";
        }
    if(!empty($_POST["catCategoria"])) { 
        }else{
           echo "La categoria no puede estar vacía";
        }
    if(!empty($_POST["catProveedor"])) { 
        }else{
           echo "El proveedor no puede estar vacío";
        }
    if(!empty($_POST["precio"])) { 
        }else{
           echo "El precio no puede estar vacío";
        }
    if(!empty($_POST["catUmedida"])) {
        }else{
            echo "La unidad de medida no puede ser vacía";
    }




    $articulo=$_POST["articulo"];
    $categoria=$_POST["catCategoria"];
    $proveedor=$_POST["catProveedor"];
    $precio=$_POST["precio"];
    $umedida=$_POST["catUmedida"];
    $usuario='35';


    $sql=$conexion->query("INSERT INTO articulo(Articulo, Id_Categoria, Id_Proveedor, Precio_Unitario, Id_Cat_Unidad, Id_Usuario)values('$articulo', '$categoria', '$proveedor', '$precio','$umedida', '$usuario')");
    if($sql== 1){
        header("location: ../Vistas/Mod03Articulos.php");
    
    
}else{
    echo "Los campos no pueden ser vacíos";
}
}
?>