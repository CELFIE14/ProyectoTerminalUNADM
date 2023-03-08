<?php
                
include "../Modelo/conexion.php";
/* session_start();
$varsesion = $_SESSION['usuario'];
if($varsesion==null || $varsesion=''){
    echo "No tienes autorización";
    die();
}   */


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventarios</title>
    <link rel="stylesheet" href="../css/mod_inv.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<header>
    <div class="container-barra">
        <div class="container-encabezado">
            <h1>Sistema Gestor de Inventarios y Compras</h1>
        </div>
        <div class="content-user">
            <h5>Celina Elizabeth Luevanos Felix</h5>
            <img src="../images/usuario.png" class="rounded float-right" height="30px">
            <a href="../Controlador/cerrar_sesion.php" ><img src="../images/logout.png" class="rounded float-right" height="30px"></a>
        </div>
    </div>
</header>
<body>


<div class="container-fluid">
    <div class="row">
        <nav class="col-lg-4" id="container-menu">
                <ul>
                    <ol>
                    <a href="../Vistas/Mod03Articulos.php">Artículos</a>
                    </ol><br>
                    <ol>
                    <a href="../Vistas/Mod04Requisiciones.php">Requisiciones</a>
                    </ol><br>
                    <ol>
                    <a href="../Vistas/Mod05Bitacora.php">Bitácora</a>
                    </ol><br>
                    <br><br>
            </ul>           
        </nav>
        <div class="col-lg-8 text-center" id="imgsgic">
            <img src="../images/LOGO2.png" alt="" id="imgcentro" >
            <!-- <img src="../images/EncabezadoActualizado (Pequeño) (1).png" alt=""> -->
        </div>
    </div>
</div>

<!-- <div class="container-admin">
    <nav class="container-menu">
            <ul>
                <li>
                <a href="../Vistas/Mod03Articulos.php">Artículos</a>
                </li><br>
                <li>
                <a href="../Vistas/Mod04Requisiciones.php">Requisiciones</a>
                </li><br>
                <li>
                <a href="../Vistas/Mod05Bitacora.php">Bitácora</a>
                </li><br>
                <br><br>
           </ul>           
    </nav>
    
</div>

<div class="container-fluid">
    <div class="row">
    <img src="../images/LOGO2.png" alt="">
    </div>

</div> -->

</body>
</html>