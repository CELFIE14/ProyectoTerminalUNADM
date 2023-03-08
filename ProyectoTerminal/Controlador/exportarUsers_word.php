<?php
    header("Content-Type: application/vnd.ms-word");
    header("Content-Disposition: attachment; filename=Usuario_Export" . date('Y:m:d:m:s').".doc");
    header("Pragma: no-cache");
    header("Expires: 0");

    include "../Modelo/conexion.php";

    $output = "";

    if(ISSET($_POST["btnExportarWord"])){
        $output .="
        <table> 
        <thead> 
            <tr> 
                <th>Nombre de usuario</th>
                <th>Área</th>
                <th>Rol</th>
                <th>Correo</th>
            </tr> 
        </thead>
        <tbody>
        
        ";
    $query = mysqli_query($conexion, "SELECT * FROM usuario u INNER JOIN cat_area c ON c.Id_Area = u.Id_Area INNER JOIN cat_rol r ON r.Id_Rol = u.Id_Rol ") or die("No se pudo exportar");
    while($fetch = mysqli_fetch_array($query)){

        $output .="
            <tr> 
                <td>".$fetch['Nombre']."</td>
                <td>".$fetch['Area']."</td>
                <td>".$fetch['Rol']."</td>
                <td>".$fetch['Correo']."</td>
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