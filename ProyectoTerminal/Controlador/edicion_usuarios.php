<?php
    include "../Modelo/conexion.php";
    
if (!empty($_POST["btnGuardarEdicion"])) {
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $area = $_POST["area"];
    $rol = $_POST["rol"];
    $correo = $_POST["correo"];
    $password = $_POST["password"];

    $condiciones = "";
    if (isset($nombre) && $nombre != "") {
        $condiciones = " SET Nombre = '".$nombre."'";
    }
    
    if ($area > 0) {
        if ($condiciones != "") {
            $condiciones .= ", Id_Area = ".$area."";
        } else {
            $condiciones = " SET Id_Area = ".$area."";
        }
    }

    if ($rol > 0) {
        if ($condiciones != "") {
            $condiciones .= ", Id_Rol = ".$rol."";
        } else {
            $condiciones = " SET Id_Rol = ".$rol."";
        }
    }

    if ($correo != "") {
        if ($condiciones != "") {
            $condiciones .= ", Correo = '".$correo."'";
        } else {
            $condiciones = " SET Correo = '".$correo."'";
        }
    }

    if ($password != "") {
        if ($condiciones != "") {
            $condiciones .= ", Contrasena = '".password_hash($password, PASSWORD_DEFAULT)."'";
        } else {
            $condiciones = " SET Contrasena = '".password_hash($password, PASSWORD_DEFAULT)."'";
        }
    }

    if ($condiciones != "") {
        $query = "UPDATE usuario ".$condiciones." WHERE Id_Usuario = ".$id;
        $sql = $conexion->query($query);

        if ($sql == 1) {
            header("location: ../Vistas/Mod01Admin.php");
        } else {
            echo "No se pudo guardar";
        }
    } else {
        header("location: ../Vistas/Mod01Admin.php");
    }
}

?>