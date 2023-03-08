<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventarios/Articulos</title>
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
           </ul>           
        </nav>
<!--       FILTROS DE BUSQUEDA -->
        <div class="container-busqueda">
               
        <form class="busqueda" method= "POST" action="../Vistas/Mod03Articulos.php">
   
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
            <label for="">Unidad de medida:</label>
            <select name="buscarUmedida" id="buscarUmedida" class="fcontroles">
                <option value="0">Seleccione la unida de medida</option>
                <?php
   
                $sql = $conexion ->query("SELECT * FROM cat_unidad");
                while ($valores = mysqli_fetch_array($sql)){
                                   echo '<option value="'.$valores['Id_Cat_Unidad'].'">'.$valores['Unidad'].'</option>';
                }
                ?>
            </select><br>
            <a href="../Vistas/Mod03Articulos.php"><input class="buttonBuscar" type="submit" name="btnBuscar" value="Buscar"></a>
        </form>
        </div>
<!--       GRID ARTICULOS PRINCIPAL -->
        <div class="container-acciones">
            <table class="tabla"> 
                <thead class="tcabecera"> 
                    <tr> 
                        <th>ID</th>
                        <th>Artículo</th>
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


                    $sql=$conexion->query("SELECT * FROM articulo a INNER JOIN proveedor p ON p.Id_Proveedor = a.Id_Proveedor 
                    INNER JOIN cat_unidad c ON c.Id_Cat_Unidad = a.Id_Cat_Unidad ORDER BY a.Id_Articulo ASC");
                    while($datos=$sql->fetch_object()){?>
                    <tr>
                        <td><?= $datos->Id_Articulo ?></td>
                        <td><?= $datos->Articulo ?></td>
                        <td><?= $datos->Precio_Unitario?></td>
                        <td><?= $datos->Unidad ?></td>
                        <td><?= $datos->Proveedor ?></td>
                        <td>
                            <a href=""><i class="Icon-edit" name = "Icon-edit"><img src="../images/editar.png" alt=""></i></a>
                            <a href=""><i class="Icon-trash"><img src="../images/trash.png" alt=""></i></a>
                        </td>
                    </tr>

                    <?php }
                    ?>
                </tbody> 
                </table>

                <div class="reg-exp">

                    <input class="btnRegistrar" type="submit" name="btnRegistrar" value="Registrar artículo">
                    <form action="../Controlador/exportar_excel.php" method="post" class="exportar">
                        <input class="btnExportar" type="submit" name="btnExportar" value="Exportar (Excel)">
                    </form>
                </div>
        </div>
<!--       MODAL DE EDICION DE ARTICULOS -->
        <section class="modalEdit" id="modalEdit">
            <div class="modal_container_edit">
                <h2 class="tiulo_modal">Edición de artículos</h2>

                <form action="../Controlador/edicion_articulos.php" class="edicionArticulos" method="POST">
                <input class="icamposeditar" type="hidden" name="id" value="<?=$_GET["id"]?>">
                <?php
                include "../Modelo/conexion.php";
                include "../Controlador/edicion_articulos.php";
                $id = $_GET["id"];
                
                $sql = $conexion->query("SELECT * FROM articulo a INNER JOIN proveedor p ON p.Id_Proveedor = a.Id_Proveedor 
                INNER JOIN cat_unidad c ON c.Id_Cat_Unidad = a.Id_Cat_Unidad INNER JOIN categoria ca ON ca.Id_Categoria = a.Id_Categoria 
                INNER JOIN usuario u ON u.Id_Usuario = a.Id_Usuario WHERE Id_Articulo = $id");
                while ($datos=$sql ->fetch_object()){?>

                    <label class="editLabel" for="">Artículo:</label>
                    <input class="icamposeditar" type="text" name="articulo" id="articulo" value="<?=$datos->Articulo?>" pattern="[a-zA-Z[:space:]]{3,50}" maxlength="50" required>
                    <label class="editLabel" for="">Categoria:</label>
                    <select name="catCategoria" id="catCategoria" class="icamposeditar" required>
                        <option value="<?=$datos->Id_Categoria?>"><?=$datos->Categoria?></option>
                        <?php
                            $sql = $conexion ->query("SELECT * FROM categoria");
                            while ($valores = mysqli_fetch_array($sql)){
                                echo '<option value="'.$valores['Id_Categoria'].'">'.$valores['Categoria'].'</option>';
                            }
                        ?>
                    </select><br>
                    <label class="editLabel" for="">Proveedor:</label>
                    <select name="catProveedor" id="catProveedor" class="icamposeditar"  required>
                        <option value="<?=$datos->Id_Proveedor?>"><?=$datos->Proveedor?></option>
                        <?php
                            $sql = $conexion ->query("SELECT * FROM proveedor");
                            while ($valores = mysqli_fetch_array($sql)){
                                echo '<option value="'.$valores['Id_Proveedor'].'">'.$valores['Proveedor'].'</option>';
                            }
                        ?>
                    </select>
                    <label class="editLabel" for="">Precio unitario:</label>
                    <input class="icamposeditar" type="number" step="any" name="precio" id="precio" value="<?=$datos->Precio_Unitario?>" pattern="" required><br>
                    <label class="editLabel" for="">Unidad de medida:</label>
                    <select name="catUmedida" id="catUmedida" class="icamposeditar"  required>
                        <option value="<?=$datos->Id_Cat_Unidad?>"><?=$datos->Unidad?></option>
                        <?php
                            $sql = $conexion ->query("SELECT * FROM cat_unidad");
                            while ($valores = mysqli_fetch_array($sql)){
                                echo '<option value="'.$valores['Id_Cat_Unidad'].'">'.$valores['Unidad'].'</option>';
                            }
                        ?>
                    </select><br>
                    <input class="btnGuardarEdit" id= "btnModalEditar" type="submit" name="btnGuardarEdit" value="Guardar">
                    <a href="../Vistas/Mod03Articulos.php"><input class="btnCancelarEdit" id= "btnModalEditar" type="button" name="btnCancelarEdit" value="Cancelar"></a>

                <?php }
                ?>
                </form>
            </div>
        </section>
        


    
    </div>

</body>
</html>