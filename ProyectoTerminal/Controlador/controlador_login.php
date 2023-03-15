<?php
include "../Modelo/conexion.php";

session_start();

if (isset($_POST["usuario"]) && $_POST["usuario"] != '' && isset($_POST["contrasena"]) && $_POST["contrasena"] != '') {
    $usuario = $_POST["usuario"];
    $contrasena = $_POST["contrasena"];

    $query = mysqli_query($conexion, "SELECT * FROM usuario WHERE Correo = '$usuario' LIMIT 1");
    $rows = mysqli_fetch_assoc($query);

    if ($rows) {
        $hash = $rows['Contrasena'];

        if(password_verify($contrasena, $hash)) {
            $_SESSION['usuario'] = $usuario;

            if($rows['Id_Rol'] == 1) {
                $_SESSION['userrol']="1";
                $_SESSION['userarea']="0";
                header("Location: ../Vistas/Mod01Admin.php");
            } else if ($rows['Id_Rol'] == 3) {
                $_SESSION['userrol']="3";
                $_SESSION['userarea']="0";
                header("Location: ../Vistas/home.php");
            } else if ($rows['Id_Rol'] == 2 || $rows['Id_Area'] == 3) {
                $_SESSION['userrol']="2";
                $_SESSION['userarea']="3";
                header("Location: ../Vistas/Mod02Inventario.php");
            }
        } else {
            $_SESSION['msgsession']="Error al iniciar sesión";
            header("Location: ../Vistas/login.php");
        }
    } else {
        $_SESSION['msgsession']="Error al iniciar sesión";
        header("Location: ../Vistas/login.php");
    }
} else {
    $_SESSION['msgsession']="Todos los campos son requeridos";
    header("Location: ../Vistas/login.php");
}
?> 