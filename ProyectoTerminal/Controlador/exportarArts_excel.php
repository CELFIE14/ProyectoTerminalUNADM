<?php
    header("Content-Type: application/xls");
    header("Content-Disposition: attachment; filename=Articles_export_" . date('Y:m:d:m:s').".xls");
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
                <th>Articulo</th>
                <th>Precio Unitario</th>
                <th>Unidad</th>
                <th>Proveedor</th>
            </tr> 
        </thead>
        <tbody>
        
        ";
    $query = mysqli_query($conexion, "SELECT * FROM articulo a INNER JOIN proveedor p ON p.Id_Proveedor = a.Id_Proveedor 
    INNER JOIN cat_unidad c ON c.Id_Cat_Unidad = a.Id_Cat_Unidad ORDER BY a.Id_Articulo ASC") or die("No se pudo exportar");
    while($fetch = mysqli_fetch_array($query)){

        $output .="
            <tr> 
                <td>".$fetch['Id_Articulo']."</td>
                <td>".$fetch['Articulo']."</td>
                <td>".$fetch['Precio_Unitario']."</td>
                <td>".$fetch['Unidad']."</td>
                <td>".$fetch['Proveedor']."</td>
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