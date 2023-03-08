<?php
include "../Modelo/conexion.php";

/* if (isset($_POST['btnBuscar'])) {

    $nombre = $_POST['nombre'];
    $area = $_POST['buscarArea'];
    $rol = $_POST['buscarRol'];
    $fecha = $_POST['fechaAlta'];

    $sql =$conexion->query("SELECT * FROM usuario u INNER JOIN cat_area c ON c.Id_Area = u.Id_Area INNER JOIN cat_rol r ON r.Id_Rol = u.Id_Rol WHERE u.Nombre = $nombre ") ;
    $numeroSql=mysqli_num_rows($sql);




    if (mysqli_num_rows($sql) > 0) {
        $row_count = 0;
        echo "<br><br>Resultados encontrados: ";
        echo "<br><table class='table table-striped'>";
        While($row = mysqli_fetch_all($sql)) {   
            $row_count++;                         
            echo "<tr><td>".$row_count." </td><td>". $row['Nombre'] . "</td><td>". $row['Area'] . "</td><td>". $row['Rol'] . "</td><td>". $row['Fecha_Alta'] . "</td></tr>";
        }
        echo "</table>";
    }
    else {
        //Si no hay registros encontrados
        echo "<br>Resultados encontrados: Ninguno";
    }

} */



?>