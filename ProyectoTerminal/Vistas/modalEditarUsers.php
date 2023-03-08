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
    <title>SGIC-Administración</title>
    <link rel="stylesheet" href="../css/mod_Admin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

</head>
<header>
        <div class="container-barra">
                <div class="container-encabezado">
                    <h2>Sistema Gestor de Inventarios y Compras</h2>
                </div>
                <div class="content-user">
                    <h5>Celina Elizabeth Luevanos Felix</h5>
                    <img src="../images/usuario.png" class="rounded float-right" height="30px">
                    <a href="../Controlador/cerrar_sesion.php" ><img src="../images/logout.png" class="rounded float-right" height="30px"></a>
                </div>
        </div>
</header>
<body>


    <div class="container-admin">
        <nav class="container-menu">
            <ul><br>
                <ol>
                    <a href="">Administración</a>
                </ol>
                <br><br>
                <!-- <a href="../Controlador/cerrar_sesion.php"><input class="btnCerrar" type="submit" name="btnCerrar" value="Cerrar Sesion"></a> -->
            </ul>
            
        </nav>

<!--       FORMULARIO DE BUSQUEDA -->
        <div class="container-busqueda">
               
            <form class="busqueda" method= "GET" action="./Mod01Admin.php">

                        <label for="">Nombre:</label>
                        <input class="fcontroles" type="text" name="nombre" value="">
                        <label for="">Area:</label>
                        <select name="buscarArea" id="buscarArea" class="fcontroles">
                            <option value="0">Seleccione el área</option>
                            <?php
                            include "../Modelo/conexion.php";

                            $sql = $conexion ->query("SELECT * FROM cat_area");
                            while ($valores = mysqli_fetch_array($sql)){
                                echo '<option value="'.$valores['Id_Area'].'">'.$valores['Area'].'</option>';
                            }
                            ?>

                        </select>
                        <label for="">Rol:</label>
                        <select name="buscarRol" id="buscarRol" class="fcontroles">
                            <option value="0">Seleccione el rol</option>
                            <?php

                            $sql = $conexion ->query("SELECT * FROM cat_rol");
                            while ($valores = mysqli_fetch_array($sql)){
                                echo '<option value="'.$valores['Id_Rol'].'">'.$valores['Rol'].'</option>';
                            }
                            ?>
                        </select><br>

                        <a href="../Vistas/Mod01Admin.php"><input class="buttonBuscar" type="submit" name="btnBuscar" value="Buscar"></a>
            </form>
        </div>
        <?php
            $msg1 =empty($_SESSION['log_requeridos'])?"":$_SESSION['log_requeridos'];
            echo "<div>$msg1</div>";
            
            $msg2 =empty($_SESSION['log_invalidos'])?"":$_SESSION['log_invalidos'];
            echo "<div>$msg2</div>";
            
            $msg3 =empty($_SESSION['log_reg'])?"":$_SESSION['log_reg'];
            echo "<div>$msg3</div>";
        ?>
<!--       GRID DE USUARIOS -->
        <div class="container-acciones">
            <table class="tabla"> 
                <thead class="tcabecera"> 
                    <tr> 
                        <th>No. Usuario</th>
                        <th>Nombre</th>
                        <th>Área</th>
                        <th>Rol</th>
                        <th>Correo</th>
                        <th>Acciones</th>
                    </tr> 
                </thead> 
                <tbody class="filas">
                <?php
                    include "../Modelo/conexion.php";
                    include "../Controlador/eliminar_usuarios.php";
                    include "../Controlador/paginacion.php";
                    $condicionales = "";
                    $hayCondicionales = false;

                    if (isset($_GET['nombre']) && $_GET['nombre'] != "") {
                        echo $_GET['nombre'];
                        $hayCondicionales = true;
                        $condicionales .= " u.nombre like \"%".$_GET['nombre']."%\" ";
                    }

                    if (isset($_GET['buscarArea']) && $_GET['buscarArea'] != 0) {
                        $hayCondicionales = true;
                        if ($condicionales == "") {
                            $condicionales .= " u.Id_Area = ".$_GET['buscarArea']." ";
                        } else {
                            $condicionales .= " AND u.Id_Area = ".$_GET['buscarArea']." ";
                        }
                    }

                    if (isset($_GET['buscarRol']) && $_GET['buscarRol'] != 0) {
                        $hayCondicionales = true;
                        if ($condicionales == "") {
                            $condicionales .= " u.Id_Rol = ".$_GET['buscarRol']." ";
                        } else {
                            $condicionales .= " AND u.Id_Rol = ".$_GET['buscarRol']." ";
                        }
                    }


                    if ($hayCondicionales) {
                        $condicionales = "WHERE ".$condicionales;
                    }

                    $query = "SELECT * FROM usuario u 
                              INNER JOIN cat_area c ON c.Id_Area = u.Id_Area 
                              INNER JOIN cat_rol r ON r.Id_Rol = u.Id_Rol 
                              ".$condicionales."
                              ORDER BY u.Id_Usuario ASC LIMIT $desde, $por_pagina";


                    $sql=$conexion->query($query);
                    while($datos=$sql->fetch_object()){?>
                    <tr>
                        <td><?= $datos->Id_Usuario ?></td>
                        <td><?= $datos->Nombre ?></td>
                        <td><?= $datos->Area?></td>
                        <td><?= $datos->Rol ?></td>
                        <td><?= $datos->Correo ?></td>
                        <td>
                            <a href="../Vistas/modalEditarUsers.php?id=<?= $datos->Id_Usuario?>"><i class="Icon-edit"><img src="../images/editar.png" alt=""></i></a>
                            <a href="../Vistas/alert_users.php?id=<?= $datos->Id_Usuario?>"><i class="Icon-trash"><img src="../images/trash.png" alt=""></i></a>
                        </td>
                    </tr>

                    <?php }
                    ?>
                </tbody> 
                </table><br>
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <?php
                            if($pagina != 1)
                            {
                        ?>
                            <li class="page-item"><a class="paginacion" href="?pagina=<?php echo 1; ?>">inicio</a></li>
                            <li class="page-item"><a class="paginacion" href="?pagina=<?php echo $pagina-1; ?>">anterior</a></li>
                        <?php
                        }
                        for ($i = 1; $i <= $total_paginas; $i++){
                            if($i == $pagina){
                                echo '<li class= "pageSelected">'.$i.'</li>';
                            }else{
                                echo '<li><a href= "?pagina='.$i.'">'.$i.'</a></li>';
                            }
                        }
                            if($pagina != $total_paginas){
                        ?>
                        <li class="page-item"><a class="paginacion" href="?pagina=<?php echo $pagina + 1; ?>">siguiente</a></li>       
                        <li class="page-item"><a class="paginacion" href="?pagina=<?php echo $total_paginas; ?>">final</a></li>  
                    <?php  } ?>
                    </ul>
                </nav>

                <div class="reg-exp">

                    <input class="btnRegistrar" type="submit" name="btnRegistrar" value="Registrar usuario">
                    <form action="../Controlador/exportar_excel.php" method="post" class="exportar">
                        <input class="btnExportar" type="submit" name="btnExportar" value="Exportar (Excel)">
                    </form>
                </div>
        </div>
    <section class="modalEdit" id="modalEdit">

            <div class="modal_container_edit">
                <h2 class="tiulo_modal">Modificación de usuarios</h2>

                <form action="../Controlador/edicion_usuarios.php" class="edicionUsuarios" method="POST">
                    <input class="icamposeditar" type="hidden" name="id" value="<?=$_GET["id"]?>">
                    <?php
                    include "../Modelo/conexion.php";
                    include "../Controlador/edicion_usuarios.php";

                    $id = $_GET["id"];
                    
                    $sql=$conexion->query("SELECT * FROM usuario u INNER JOIN cat_area c ON c.Id_Area = u.Id_Area 
                    INNER JOIN cat_rol r ON r.Id_Rol = u.Id_Rol WHERE u.Id_Usuario = $id");
                    while ($datos=$sql->fetch_object()){ ?>


                        <label class="editLabel" for="">Nombre de usuario:</label>
                        <input class="icamposeditar" type="text" name="nombre" value="<?=$datos->Nombre?>">
                        <label class="editLabel" for="">Area:</label>
                        <select class="icamposeditar" name="area" id="area">
                        <option value="<?= $datos->Id_Area?>"><?= $datos->Area?> ></option>
                        <?php
                            $sql = $conexion ->query("SELECT * FROM cat_area");
                            while ($valores = mysqli_fetch_array($sql)){
                                echo '<option value="'.$valores['Id_Area'].'" >'.$valores['Area'].'</option>';
                            }
                        ?>
                        </select><br>
                        <label class="editLabel" for="">Rol:</label>
                        <select name="rol" id="rol" class="icamposeditar">
                        <option value="<?= $datos->Id_Rol?>"><?= $datos->Rol?></option>
                        <?php
                            $sql = $conexion ->query("SELECT * FROM cat_rol");
                            while ($valores = mysqli_fetch_array($sql)){
                                echo '<option value="'.$valores['Id_Rol'].'">'.$valores['Rol'].'</option>';
                            }
                        ?>
                        </select>
                        <label class="editLabel" for="">Correo:</label>
                        <input class="icamposeditar" type="search" name="correo" value="<?=$datos->Correo?>"><br>
                        <label class="editLabel" for="">Contraseña:</label>
                        <input class="icamposeditar" type="password" name="password" value=""><br>
                        <input class="btnGuardarEdicion" id= "btnModalEditar" type="submit" name="btnGuardarEdicion" value="Editar usuario">
                        <!-- <a href="../Controlador/exportarUsers_word.php"><input class="btnExportar" id= "btnModalEditar" type="button" name="btnExportarWord" value="Exportar (Word)"></a>  -->
                        <a href="../Vistas/Mod01Admin.php"><input class="btnCancelarEdicion" id= "btnModalEditar" type="button" name="btnCancelarEdicion" value="Cancelar"></a> 
                    <?php }

                    ?>


                </form>
            </div>
        </section>
    <!-- <script src="../js/modalEditar.js"></script> -->
</body>
</html> 
