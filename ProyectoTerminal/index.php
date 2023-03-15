<?php

session_start();

if(isset($_SESSION['usuario']) && $_SESSION['usuario'] != '') {
    header('Location: ./Vistas/Mod01Admin.php');
} else {
    header('Location: ./Vistas/login.php');
}
?>
