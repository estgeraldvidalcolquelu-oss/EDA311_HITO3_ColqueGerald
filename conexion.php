<?php
$db = "tienda_colque";
mysqli_report(MYSQLI_REPORT_OFF);
$conexion = @new mysqli("127.0.0.1", "root", "", $db, 3308);
if ($conexion->connect_error) {
    $conexion = @new mysqli("10.0.40.85", "u_colque_gerald", "Rio#26B8kP4", $db, 3306);
}
if ($conexion->connect_error) {
    $conexion = @new mysqli("127.0.0.1", "u_colque_gerald", "Rio#26B8kP4", $db, 3308);
}
if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}
?>