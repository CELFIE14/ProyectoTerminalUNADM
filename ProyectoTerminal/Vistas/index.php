<?php
    session_start();

    $baseUrl = "http://".$_SERVER['HTTP_HOST']."/proyectoIUnadm/ProyectoTerminal/";
    $varsesion = $_SESSION['usuario'];

    if($varsesion == null || $varsesion = ''){
        header('Location: '.$baseUrl.'vistas/login.php');
        exit;
    }
    
    header('Location: '.$baseUrl.'vistas/home.php');
    exit;
?>