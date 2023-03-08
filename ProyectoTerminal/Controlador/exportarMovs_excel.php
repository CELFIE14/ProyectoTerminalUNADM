<?php
    header("Content-Type: application/xls");
    header("Content-Disposition: attachment; filename=Movimientos_Almacen_export_" . date('Y:m:d:m:s').".xls");
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
            <th>Movimiento</th>
            <th>Articulo</th>
            <th>Cantidad</th>
        </tr> 
        </thead>
        <tbody>
        
        ";
    $query = mysqli_query($conexion, "SELECT * FROM movimientos_almacen m INNER JOIN cat_tipo_movimiento c ON m.Id_Cat_Mov = c.Id_Cat_Mov 
    INNER JOIN articulo a ON a.Id_Articulo = m.Id_Articulo ORDER BY m.Id_Mov_Almacen ASC") or die("No se pudo exportar");
    while($fetch = mysqli_fetch_array($query)){

        $output .="
            <tr> 
                <td>".$fetch['Id_Mov_Almacen']."</td>
                <td>".$fetch['Fecha_Movimiento']."</td>
                <td>".$fetch['Tipo_Movimiento']."</td>
                <td>".$fetch['Articulo']."</td>
                <td>".$fetch['Cantidad']."</td>
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