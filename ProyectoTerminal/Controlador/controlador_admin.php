<?php
include"../Modelo/conexion.php";
$con=conectarbd();

$sql="SELECT * FROM usuario";
$query=mysqli_query($con,$sql);
$row=mysqli_fetch_array($query);

?>