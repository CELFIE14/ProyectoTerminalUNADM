<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGIC-Administración</title>
    <link rel="stylesheet" href="../css/mod_Admin.css">

</head>
<body>
    <section class="alertEliminar" id="alertEliminar">
            <div class="alert_container_eliminar">
                <h2 class="tiulo_alert">¿Desea eliminar el registro?</h2>

                <form action="../Controlador/eliminar_bitacora.php" class="eliminarRegistro" method="POST">
                        <input  type="hidden" name="id" value="<?=$_GET["id"]?>">
                        <input class="btnEliminarRegistro" id= "btnEliminar" type="submit" name="btnEliminar" value="Eliminar">
                        <a href="../Vistas/Mod05Bitacora.php"><input class="btnCancelar" id= "btnCancelarEliminar" type="button" name="btnCancelarEdicion" value="Cancelar"></a> 
                    <?php

                    ?>
                </form>
            </div>
        </section>
         
</body>
</html>