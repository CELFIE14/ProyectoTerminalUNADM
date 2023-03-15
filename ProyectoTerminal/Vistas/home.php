<?php
session_start();

if(!isset($_SESSION['usuario'])) {
    header('Location: ./login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGIC</title>
    <link rel="stylesheet" href="../css/home.css">
</head>
<body>
    <h1>SGIC</h1>
    <h2>Sistema Gestor de Inventarios y Compras</h2>
    <h3>by Yektik Soft S.A. de C.V.</h3>

    <div class="contenedor-modulos">
        <div class="mod-container">
            <a href="../Vistas/Mod01Admin.php"><img src="../images/administracion.png" alt=""></a>
            <h5>Administración</h5>
        </div>
        <div class="mod-container">
            <a href="../Vistas/Mod02Inventario.php"><img src="../images/inventario.png" alt=""></a>
            <h5>Inventarios</h5>
        </div>
        <div class="mod-container">
            <a href="../Vistas/Mod06Compras.php"><img src="../images/compras.png" alt=""></a>
            <h5>Compras</h5>
        </div>
        <div class="mod-container">
            <a href=""><img src="../images/reportes.png" alt=""></a>
            <h5>Reportes</h5>
        </div>
    </div>

    
</body>
<footer>

</footer>
</html>