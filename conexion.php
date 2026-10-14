<?php
$db = "tienda_colque";

// 1. Intentar conectar localmente en XAMPP (puerto 3308) con root
mysqli_report(MYSQLI_REPORT_OFF);
$conexion = @new mysqli("127.0.0.1", "root", "", $db, 3308);

// 2. Si no es root local, probar credenciales del docente en la IP 10.0.40.85
if ($conexion->connect_error) {
    $conexion = @new mysqli("10.0.40.85", "u_colque_gerald", "Rio#26B8kP4", $db, 3306);
}

// 3. Si sigue fallando, probar credenciales del docente localmente (puerto 3308)
if ($conexion->connect_error) {
    $conexion = @new mysqli("127.0.0.1", "u_colque_gerald", "Rio#26B8kP4", $db, 3308);
}

if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}
?>