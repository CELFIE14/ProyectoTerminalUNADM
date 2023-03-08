<?php
    header("Content-Type: application/xls");
    header("Content-Disposition: attachment; filename=Requisicion_export_" . date('Y:m:d:m:s').".xls");
    header("Pragma: no-cache");
    header("Expires: 0");

    include "../Modelo/conexion.php";

    $output = "";

    if(ISSET($_POST["btnExportar"])){
        $output .="
        <table> 
        <thead> 
        <tr> 
            <th>ID</th>
            <th>Fecha</th>
            <th>Descripción</th>
            <th>Estatus</th>
            <th>Acciones</th>
        </tr> 
        </thead>
        <tbody>
        
        ";
    $query = mysqli_query($conexion, "SELECT * FROM requisicion r INNER JOIN cat_estatus e ON e.Id_Cat_Estatus = r.Id_Cat_Estatus ORDER BY r.Id_Requisicion ASC")
     or die("No se pudo exportar");
    while($fetch = mysqli_fetch_array($query)){

        $output .="
            <tr> 
                <td>".$fetch['Id_Requisicion']."</td>
                <td>".$fetch['Fecha_Requisicion']."</td>
                <td>".$fetch['Descripcion']."</td>
                <td>".$fetch['Id_Cat_Estatus']."</td>
            </tr>
        
        ";
    }
    $output .="
        </tbody>
        </table>
    
    ";

    echo $output;

    }

?>