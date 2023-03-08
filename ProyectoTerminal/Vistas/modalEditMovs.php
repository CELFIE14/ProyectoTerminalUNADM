<?php
                
include "../Modelo/conexion.php";
/* session_start();
$varsesion = $_SESSION['usuario'];
if($varsesion==null || $varsesion=''){
    echo "No tienes autorización";
    die();
} */  

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventarios/Bitácora</title>
    <link rel="stylesheet" href="../css/mod_art.css">
</head>
<header>
    <div class="container-barra">
        <div class="container-encabezado">
            <h1>Sistema Gestor de Inventarios y Compras</h1>
        </div>
        <div class="content-user">
        <!-- <img src="../images/foto.jpg" alt=""> -->
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
                <a href="../Controlador/cerrar_sesion.php"><input class="btnCerrar" type="submit" name="btnCerrar" value="Cerrar Sesion"></a>
           </ul>           
        </nav>
<!--       FILTROS DE BUSQUEDA -->
        <div class="container-busqueda">
               
        <form class="busqueda" method= "POST" action="../Vistas/Mod05Bitacora.php">
   
            <label for="">Tipo de movimiento:</label>
            <select name="buscarMovimiento" id="buscarMovimiento" class="fcontroles">
                <option value="0">Seleccione el movimiento</option>
                <?php
                include "../Modelo/conexion.php";
   
                $sql = $conexion ->query("SELECT * FROM cat_tipo_movimiento");
                 while ($valores = mysqli_fetch_array($sql)){
                    echo '<option value="'.$valores['Id_Cat_Mov'].'">'.$valores['Tipo_Movimiento'].'</option>';
                            }
                            ?>
            </select>
            <label for="">Fecha de movimiento:</label>
            <input type="date" name="fechaMovimiento" id="fechaMovimiento" class="fcontroles">
            <br>
            <a href="../Vistas/Mod05Bitacora.php"><input class="buttonBuscar" type="submit" name="btnBuscar" value="Buscar"></a>
        </form>
        </div><br><br>
<!--       GRID ARTICULOS PRINCIPAL -->
        <div class="container-acciones">
            <table class="tabla"> 
                <thead class="tcabecera"> 
                    <tr> 
                        <th>ID</th>
                        <th>Fecha</th>
                        <th>Movimiento</th>
                        <th>Artículo</th>
                        <th>Cantidad</th>
                        <th>Acciones</th>
                    </tr> 
                </thead> 
                <tbody class="filas">
                    <?php
                    include "../Modelo/conexion.php";
                    include "../Controlador/eliminar_movimiento.php";

                    $sql=$conexion->query("SELECT * FROM movimientos_almacen m INNER JOIN cat_tipo_movimiento c ON m.Id_Cat_Mov = c.Id_Cat_Mov 
                    INNER JOIN articulo a ON a.Id_Articulo = m.Id_Articulo ORDER BY m.Id_Mov_Almacen ASC");
                    while($datos=$sql->fetch_object()){?>
                    <tr>
                        <td><?= $datos->Id_Mov_Almacen ?></td>
                        <td><?= $datos->Fecha_Movimiento ?></td>
                        <td><?= $datos->Tipo_Movimiento ?></td>
                        <td><?= $datos->Articulo?></td>
                        <td><?= $datos->Cantidad ?></td>
                        <td>
                            <a href="../Vistas/modalEditMovs.php?id=<?= $datos->Id_Mov_Almacen?>"><i class="Icon-edit" name = "Icon-edit"><img src="../images/editar.png" alt=""></i></a>
                            <a href="../Vistas/alert_movs.php?id=<?= $datos->Id_Mov_Almacen?>"><i class="Icon-trash"><img src="../images/trash.png" alt=""></i></a>
                        </td>
                    </tr>

                    <?php }
                    ?>
                </tbody> 
                </table>

                <div class="reg-exp">

                    <input class="btnRegistrar" type="submit" name="btnRegistrar" value="Registrar movimiento">
                    <form action="../Controlador/exportarMovs_excel.php" method="post" class="exportar">
                        <input class="btnExportar" type="submit" name="btnExportar" value="Exportar (Excel)">
                    </form>
                </div>
        </div>
<!--       MODAL DE EDICION DE MOVIMIENTOS -->
        <section class="modalEdit" id="modalEdit">
            <div class="modal_container_edit">
                <h2 class="tiulo_modal">Edición de movimientos de almacén</h2>

                <form action="../Controlador/edicion_movimientos.php" class="edicionMovimientos" id="form" method="POST" <?php $_SERVER['PHP_SELF']; ?>>
                <input class="icamposeditar" type="hidden" name="id" value="<?=$_GET["id"]?>">
                <?php
                include "../Modelo/conexion.php";
                include "../Controlador/edicion_movimientos.php";
                $id = $_GET["id"];

                $sql = $conexion->query("SELECT * FROM movimientos_almacen m INNER JOIN cat_tipo_movimiento c ON m.Id_Cat_Mov = c.Id_Cat_Mov 
                    INNER JOIN articulo a ON a.Id_Articulo = m.Id_Articulo WHERE Id_Mov_Almacen = $id");
                while ($datos=$sql ->fetch_object()){?>

                    <label for="">Tipo de movimiento:</label>
                    <select name="catMovimiento" id="catMovimiento" class="icamposarticulos" required>
                        <option value="<?=$datos->Id_Cat_Mov?>"><?=$datos->Tipo_Movimiento?></option>
                        <?php
                            $sql = $conexion ->query("SELECT * FROM cat_tipo_movimiento");
                            while ($valores = mysqli_fetch_array($sql)){
                                echo '<option value="'.$valores['Id_Cat_Mov'].'">'.$valores['Tipo_Movimiento'].'</option>';
                            }
                        ?>
                    </select><br>
                    <label for="">Articulo:</label>
                    <select name="catArticulo" id="catArticulo" class="icamposarticulos"  required>
                        <option value="<?=$datos->Id_Articulo?>"><?=$datos->Articulo?></option>
                        <?php
                            $sql = $conexion ->query("SELECT * FROM articulo");
                            while ($valores = mysqli_fetch_array($sql)){
                                echo '<option value="'.$valores['Id_Articulo'].'">'.$valores['Articulo'].'</option>';
                            }
                        ?>
                    </select>
                    <label for="">Cantidad:</label>
                    <input type="text" name="cantidad" id="cantidad" class="icamposarticulos" value="<?=$datos->Cantidad?>" required><br><br>
                    <input class="btnGuardarEdit" id= "btnModalEditar" type="submit" name="btnGuardarEdit" value="Guardar">
                    <a href="../Vistas/Mod05Bitacora.php"><input class="btnCancelarEdit" id= "btnModalEditar" type="button" name="btnCancelarEdit" value="Cancelar"></a>

                <?php }
                ?>

                </form>
            </div>
        </section>


    
    </div>
    <script src="../js/modalRegistro.js"></script>
</body>
</html>