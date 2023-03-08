<?php
    include ("../Modelo/conexion.php");
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGIC</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <h1>SGIC</h1>
    <h2>Sistema Gestor de Inventarios y Compras</h2>
    <h3>by Yektik Soft S.A. de C.V.</h3>
    <section class="form-login">
        <h5>Login</h5>
        
        <?php
/*             $msg =empty($_SESSION['msgsession'])?"":$_SESSION['msgsession'];
            echo "<div>$msg</div>" */
        ?>
        <form method="POST" action="../Controlador/controlador_login.php">

            <input class="controles" type="text" name="usuario" value="" placeholder="Usuario">
            <input class="controles" type="password" name="contrasena" value="" placeholder="Contraseña">
            <input class="button" type="submit" name="btningresar" value="Ingresar">
            <!-- <p><a href="">¿Olvidaste la contraseña?</a></p> -->
        </form>
    </section>
</body>
<footer>

</footer>
</html>