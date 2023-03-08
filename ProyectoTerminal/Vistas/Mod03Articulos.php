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
    <title>Inventarios/Articulos</title>
    <link rel="stylesheet" href="../css/mod_art.css">
</head>
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

    <div class="container-admin">
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
<!--       FILTROS DE BUSQUEDA -->
        <div class="container-busqueda">
               
            <form class="busqueda" method= "GET" action="./Mod03Articulos.php">
    
                <label for="">Artículos:</label>
                <input class="fcontroles" type="text" name="articulos" value="">
                <label for="">Proveedor:</label>
                <select name="buscarProveedor" id="buscarProveedor" class="fcontroles">
                    <option value="0">Seleccione el proveedor</option>
                    <?php
                    include "../Modelo/conexion.php";
    
                    $sql = $conexion ->query("SELECT * FROM proveedor");
                    while ($valores = mysqli_fetch_array($sql)){
                        echo '<option value="'.$valores['Id_Proveedor'].'">'.$valores['Proveedor'].'</option>';
                                }
                                ?>
    
                </select>
                <label for="">Categoría:</label>
                <select name="buscarCategoria" id="buscarCategoria" class="fcontroles">
                    <option value="0">Seleccione la categoría</option>
                    <?php
    
                    $sql = $conexion ->query("SELECT * FROM categoria");
                    while ($valores = mysqli_fetch_array($sql)){
                        echo '<option value="'.$valores['Id_Categoria'].'">'.$valores['Categoria'].'</option>';
                    }
                    ?>
                </select><br><br>

                <a href="../Vistas/Mod03Articulos.php"><input class="buttonBuscar" type="submit" name="btnBuscar" value="Buscar"></a>
            </form>
            <a href="./Mod02Inventario.php"><img src="../images/home.png" class="rounded float-right" height="50px"></a>
        </div>
<!--       GRID ARTICULOS PRINCIPAL -->
        <div class="container-acciones">
            <table class="tabla"> 
                <thead class="tcabecera"> 
                    <tr> 
                        <th>No. Artículo</th>
                        <th>Artículo</th>
                        <th>Categoría</th>
                        <th>Precio Unitario</th>
                        <th>Unidad</th>
                        <th>Proveedor</th>
                        <th>Acciones</th>
                    </tr> 
                </thead> 
                <tbody class="filas">
                    <?php
                    include "../Modelo/conexion.php";
                    include "../Controlador/eliminar_articulos.php";
                    include "../Controlador/paginacionart.php";

                    $condicionales = "";

                    if (isset($_GET['articulos']) && $_GET['articulos'] != "") {
                        $condicionales .= " a.articulo like \"%".$_GET['articulos']."%\" ";
                    }

                    if (isset($_GET['buscarProveedor']) && $_GET['buscarProveedor'] != 0) {
                        if ($condicionales == "") {
                            $condicionales .= " a.Id_Proveedor = ".$_GET['buscarProveedor']." ";
                        } else {
                            $condicionales .= " AND a.Id_Proveedor = ".$_GET['buscarProveedor']." ";
                        }
                    }

                    if (isset($_GET['buscarCategoria']) && $_GET['buscarCategoria'] != 0) {
                        if ($condicionales == "") {
                            $condicionales .= " a.Id_Categoria = ".$_GET['buscarCategoria']." ";
                        } else {
                            $condicionales .= " AND a.Id_Categoria = ".$_GET['buscarCategoria']." ";
                        }
                    }


                    if ($condicionales != "") {
                        $condicionales = " WHERE ".$condicionales;
                    }

                    $query = "SELECT * FROM articulo a 
                    INNER JOIN proveedor p ON p.Id_Proveedor = a.Id_Proveedor
                    INNER JOIN cat_unidad c ON c.Id_Cat_Unidad = a.Id_Cat_Unidad
                    INNER JOIN categoria ca ON ca.Id_Categoria = a.Id_Categoria 
                    ".$condicionales."
                    ORDER BY a.Id_Articulo ASC LIMIT $desde, $por_pagina";

                    $sql=$conexion->query($query);
                    while($datos=$sql->fetch_object()){?>
                    <tr>
                        <td><?= $datos->Id_Articulo ?></td>
                        <td><?= $datos->Articulo ?></td>
                        <td><?= $datos->Categoria ?></td>
                        <td><?= $datos->Precio_Unitario?></td>
                        <td><?= $datos->Unidad ?></td>
                        <td><?= $datos->Proveedor ?></td>
                        <td>
                            <a href="../Vistas/modalEditArticles.php?id=<?= $datos->Id_Articulo?>"><i class="Icon-edit" name = "Icon-edit"><img src="../images/editar.png" alt=""></i></a>
                            <a href="../Vistas/alert_articles.php?id=<?= $datos->Id_Articulo?>"><i class="Icon-trash"><img src="../images/trash.png" alt=""></i></a>
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

                    <input class="btnRegistrar" type="submit" name="btnRegistrar" value="Registrar artículo">
                    <form action="../Controlador/exportarArts_excel.php" method="post" class="exportar">
                        <input class="btnExportar" type="submit" name="btnExportar" value="Exportar (Excel)">
                    </form>
                </div>
        </div>
<!--       MODAL DE REGISTRO DE ARTICULOS -->
        <section class="modal" id="modal">
            <div class="modal_container">
                <h2 class="tiulo_modal">Registro de artículos</h2>

                <form action="../Controlador/registro_articulos.php" class="registroArticulos" id="form" method="POST" <?php $_SERVER['PHP_SELF']; ?>>
                <?php
                include "../Modelo/conexion.php";
                ?>
                    <label for="">Artículo:</label>
                    <input class="icamposarticulos" type="text" name="articulo" id="articulo" value="" pattern="[a-zA-Z[:space:]]{3,50}" maxlength="50" required>
                    <label for="">Categoria:</label>
                    <select name="catCategoria" id="catCategoria" class="icamposarticulos" required>
                        <option value="0">Seleccione la Categoría</option>
                        <?php
                            $sql = $conexion ->query("SELECT * FROM categoria");
                            while ($valores = mysqli_fetch_array($sql)){
                                echo '<option value="'.$valores['Id_Categoria'].'">'.$valores['Categoria'].'</option>';
                            }
                        ?>
                    </select><br>
                    <label for="">Proveedor:</label>
                    <select name="catProveedor" id="catProveedor" class="icamposarticulos"  required>
                        <option value="0">Seleccione el proveedor</option>
                        <?php
                            $sql = $conexion ->query("SELECT * FROM proveedor");
                            while ($valores = mysqli_fetch_array($sql)){
                                echo '<option value="'.$valores['Id_Proveedor'].'">'.$valores['Proveedor'].'</option>';
                            }
                        ?>
                    </select>
                    <label for="">Precio unitario:</label>
                    <input class="icamposarticulos" type="number" step="any" name="precio" id="correo" value="" pattern="" required><br>
                    <label for="">Unidad de medida:</label>
                    <select name="catUmedida" id="catUmedida" class="icamposarticulos"  required>
                        <option value="0">Seleccione la unidad de medida</option>
                        <?php
                            $sql = $conexion ->query("SELECT * FROM cat_unidad");
                            while ($valores = mysqli_fetch_array($sql)){
                                echo '<option value="'.$valores['Id_Cat_Unidad'].'">'.$valores['Unidad'].'</option>';
                            }
                        ?>
                    </select><br>

                    <input class="btnGuardar" id= "btnModal" type="submit" name="btnGuardar" value="Guardar">
                    <input class="btnCancelar" id= "btnModal" type="button" name="btnCancelar" value="Cancelar">

                </form>
            </div>
        </section>


    
    </div>
    <script src="../js/modalRegistro.js"></script>
</body>
</html>