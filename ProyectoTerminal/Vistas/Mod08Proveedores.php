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
    <title>Proveedores</title>
    <link rel="stylesheet" href="../css/mod_art.css">
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
                    <ol>
                    <a href="../Vistas/Mod07Compras.php">Compras</a>
                    </ol><br>
                    <ol>
                    <a href="../Vistas/Mod08Proveedores.php">Proveedores</a>
                    </ol><br>
                    <ol>
                    <a href="../Vistas/Mod09Ordenes.php">Órdenes de compra</a>
                    </ol><br>
                    <ol>
                    <a href="../Vistas/Mod10Facturas.php">Facturas</a>
                    </ol><br>
                    <br><br>
            </ul>           
        </nav>
<!--       FILTROS DE BUSQUEDA -->
        <div class="container-busqueda">
               
        <form class="busqueda" method= "POST" action="../Vistas/Mod04Requisiciones.php">
   
            <label for="">Nombre:</label>
            <select name="buscarEstatus" id="buscarEstatus" class="fcontroles">
                <option value="0">Seleccione el proveedor</option>
                <?php
                include "../Modelo/conexion.php";
   
                $sql = $conexion ->query("SELECT * FROM proveedor");
                 while ($valores = mysqli_fetch_array($sql)){
                    echo '<option value="'.$valores['Id_Proveedor'].'">'.$valores['Proveedor'].'</option>';
                               }
                               ?>
   
            </select>
            <label for="">RFC:</label>
            <input class="fcontroles" type="text" name="idRequisicion" value=""><br>
            <a href="../Vistas/Mod08Proveedores.php"><input class="buttonBuscar" type="submit" name="btnBuscar" value="Buscar"></a>
        </form>
        <a href="./Mod06Compras.php"><img src="../images/home.png" class="rounded float-right" height="50px"></a>
        </div>
<!--       GRID ARTICULOS PRINCIPAL -->
        <div class="container-acciones">
            <table class="tabla"> 
                <thead class="tcabecera"> 
                    <tr> 
                        <th>No. Requisición</th>
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
<!--       MODAL DE REGISTRO DE REQUISICIONES -->
        <section class="modal" id="modal">
            <div class="modal_container">
                <h2 class="tiulo_modal">Registro de Requisiciones</h2>

                <form action="../Controlador/registro_requisiciones.php" class="registroRequisicion" id="form" method="POST" <?php $_SERVER['PHP_SELF']; ?>>
                <?php
                include "../Modelo/conexion.php";
                ?>

                    <label for="">Fecha de requisición:</label>
                    <input class="icamposrequis" type="date" name="fechareq" id="fechareq" value="" required><br>
                    <label for="">Descripción:</label>
                    <p><textarea class="icamposrequisd" cols="100" rows="10" name="descripcion" id="descripcion" maxlength = "100" value="" required></textarea></p><br>
                    <input class="btnGuardar" id= "btnModal" type="submit" name="btnGuardar" value="Guardar">
                    <input class="btnCancelar" id= "btnModal" type="button" name="btnCancelar" value="Cancelar">

                </form>
            </div>
        </section>


    
    </div>
    <script src="../js/modalRegistro.js"></script>
</body>
</html>