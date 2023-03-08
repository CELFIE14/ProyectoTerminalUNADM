<?php
                
include "../Modelo/conexion.php";
session_start();
$varsesion = $_SESSION['usuario'];
if($varsesion==null || $varsesion=''){
    echo "No tienes autorización";
    die();
}  

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventarios/Requisiciones</title>
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
               
        <form class="busqueda" method= "POST" action="../Vistas/Mod04Requisiciones.php">
   
            <label for="">Requisición:</label>
            <input class="fcontroles" type="text" name="idRequisicion" value="">
            <label for="">Estatus:</label>
            <select name="buscarEstatus" id="buscarEstatus" class="fcontroles">
                <option value="0">Seleccione el estatus</option>
                <?php
                include "../Modelo/conexion.php";
   
                $sql = $conexion ->query("SELECT * FROM cat_estatus");
                 while ($valores = mysqli_fetch_array($sql)){
                    echo '<option value="'.$valores['Id_Cat_Estatus'].'">'.$valores['Estatus'].'</option>';
                               }
                               ?>
   
            </select>
            <label for="">Fecha:</label>
            <input class="fcontroles" type="date" name="fechaAlta" value="">
            <a href="../Vistas/Mod03Articulos.php"><input class="buttonBuscar" type="submit" name="btnBuscar" value="Buscar"></a>
        </form>
        </div>
<!--       GRID ARTICULOS PRINCIPAL -->
        <div class="container-acciones">
            <table class="tabla"> 
                <thead class="tcabecera"> 
                    <tr> 
                        <th>ID</th>
                        <th>Fecha</th>
                        <th>Descripción</th>
                        <th>Estatus</th>
                        <th>Acciones</th>
                    </tr> 
                </thead> 
                <tbody class="filas">
                    <?php
                    include "../Modelo/conexion.php";
                    include "../Controlador/eliminar_requisiciones.php";


                    $sql=$conexion->query("SELECT * FROM requisicion r INNER JOIN cat_estatus e ON e.Id_Cat_Estatus = r.Id_Cat_Estatus ORDER BY r.Id_Requisicion ASC");
                    while($datos=$sql->fetch_object()){?>
                    <tr>
                        <td><?= $datos->Id_Requisicion ?></td>
                        <td><?= $datos->Fecha_Requisicion ?></td>
                        <td><?= $datos->Descripcion?></td>
                        <td><?= $datos->Estatus ?></td>
                        <td>
                            <a href="../Vistas/modalEditRequisicion.php?id=<?= $datos->Id_Requisicion?>"><i class="Icon-edit" name = "Icon-edit"><img src="../images/editar.png" alt=""></i></a>
                            <a href="../Vistas/alert_requis.php?id=<?= $datos->Id_Requisicion?>"><i class="Icon-trash"><img src="../images/trash.png" alt=""></i></a>
                        </td>
                    </tr>

                    <?php }
                    ?>
                </tbody> 
                </table>

                <div class="reg-exp">

                    <input class="btnRegistrar" type="submit" name="btnRegistrar" value="Registrar requisición">
                    <form action="../Controlador/exportarrequis_excel.php" method="post" class="exportar">
                        <input class="btnExportar" type="submit" name="btnExportar" value="Exportar (Excel)">
                    </form>
                </div>
        </div>
<!--       MODAL DE EDICION DE REQUISICIONES -->
        <section class="modalEdit" id="modalEdit">
            <div class="modal_container_edit">
                <h2 class="tiulo_modal">Edición de Requisiciones</h2>

                <form action="../Controlador/edicion_requisicion.php" class="edicionRequisicion" id="form" method="POST" <?php $_SERVER['PHP_SELF']; ?>>
                <?php
                include "../Modelo/conexion.php";
                include "../Controlador/edicion_articulos.php";
                $id = $_GET["id"];
                
                $sql = $conexion->query("SELECT * FROM requisicion r INNER JOIN cat_estatus e ON e.Id_Cat_Estatus = r.Id_Cat_Estatus WHERE Id_Requisicion = $id");
                while ($datos=$sql ->fetch_object()){?>

                    <label for="">Fecha de requisición:</label>
                    <input class="icamposeditar" type="date" name="fechareq" id="fechareq" value="<?=$datos->Fecha_Requisicion?>" required><br>
                    <label for="">Descripción:</label>
                    <textarea class="icamposeditarrd" cols="100" rows="10" name="descripcion" id="descripcion" maxlength = "100" value="<?=$datos->Descripcion?>" required></textarea><br>
                    <input class="btnGuardar" id= "btnModal" type="submit" name="btnGuardar" value="Guardar">
                    <a href="../Vistas/Mod04Requisiciones.php"><input class="btnCancelarEdit" id= "btnModalEditar" type="button" name="btnCancelarEdit" value="Cancelar"></a>

                <?php }
                ?>


                </form>
            </div>
        </section>


    
    </div>
    <script src="../js/modalRegistro.js"></script>
</body>
</html>