<?php
include "../Modelo/conexion.php";

session_start();

/* if(!empty($_POST["btningresar"])){
    if (!empty($_POST["usuario"]) and ($_POST["contrasena"])) {
        $usuario=$_POST["usuario"];
        $contrasena=$_POST["contrasena"]; */
/*         $passwordFuerte = password_hash($contrasena, PASSWORD_DEFAULT); */
       /*  $query = mysqli_query($conexion, "SELECT * FROM usuario WHERE Correo= '$usuario'"); */


        // Mysql_num_row is counting table row
/*         $rows = mysqli_fetch_assoc($query);
        $hash = $rows['Contrasena'];

        if(password_verify($contrasena, $rows['Contrasena'])){
            $_SESSION['usuario']=$usuario;
            if($rows['Id_Rol']==1){
                header("Location: ../Vistas/Mod01Admin.php");
            
            }elseif ($rows['Id_Rol']==3){
                header("Location: ../Vistas/home.php");
            }elseif ($rows['Id_Rol']==2 ||$rows['Id_Area']==3){
                header("Location: ../Vistas/Mod02Inventario.php");
            }
        } else {
            $_SESSION['msgsession']="ACCESO DENEGADO";
            header("Location: ../Vistas/login.php");
        }
       
    } else {
        echo "Los campos no pueden ser vacíos";
    }
}
?> */