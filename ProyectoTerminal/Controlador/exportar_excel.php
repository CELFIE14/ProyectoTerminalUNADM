<?php
    header("Content-Type: application/xls");
    header("Content-Disposition: attachment; filename=Users_export_" . date('Y:m:d:m:s').".xls");
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
                <th>Nombre</th>
                <th>Área</th>
                <th>Rol</th>
                <th>Correo</th>
                <th>Fecha de alta</th>
            </tr> 
        </thead>
        <tbody>
        
        ";
    $query = mysqli_query($conexion, "SELECT * FROM usuario u INNER JOIN cat_area c ON c.Id_Area = u.Id_Area INNER JOIN cat_rol r ON r.Id_Rol = u.Id_Rol") or die("No se pudo exportar");
    while($fetch = mysqli_fetch_array($query)){

        $output .="
            <tr> 
                <td>".$fetch['Id_Usuario']."</td>
                <td>".$fetch['Nombre']."</td>
                <td>".$fetch['Area']."</td>
                <td>".$fetch['Rol']."</td>
                <td>".$fetch['Correo']."</td>
                <td>".$fetch['Fecha_Alta']."</td>
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