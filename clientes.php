<?php
require_once 'conexion.php';
require_once 'ListaDoble.php';
if (isset($_POST['guardar'])) {
    $id = $_POST['id_cliente'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $edad = $_POST['edad'];
    if ($id == "") {
        $conexion->query("INSERT INTO clientes VALUES (NULL, '$nombre', '$email', '$edad')");
    } else {
        $conexion->query("UPDATE clientes SET nombre='$nombre', email='$email', edad='$edad' WHERE id_cliente=$id");
    }
    header("Location: clientes.php");
}
if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];
    $conexion->query("DELETE FROM clientes WHERE id_cliente = $id");
    header("Location: clientes.php");
}
$lista = new ListaDoble();
$res = $conexion->query("SELECT * FROM clientes");
$lista->cargarDesdeMySQL($res);

if (isset($_GET['ordenar'])) {
    $lista->ordenarPor($_GET['ordenar']);
}
$edit = null;
if (isset($_GET['editar'])) {
    $edit = $conexion->query("SELECT * FROM clientes WHERE id_cliente = " . $_GET['editar'])->fetch_assoc();
}
?>
<!DOCTYPE html>
<html>
<head><title>Clientes</title></head>
<body>
    <a href="index.php">← Menú</a>
    <h2>Clientes</h2>
    <form method="POST" action="clientes.php">
        <input type="hidden" name="id_cliente" value="<?php echo $edit['id_cliente'] ?? ''; ?>">
        <input type="text" name="nombre" placeholder="Nombre" value="<?php echo $edit['nombre'] ?? ''; ?>" required>
        <input type="email" name="email" placeholder="Email" value="<?php echo $edit['email'] ?? ''; ?>" required>
        <input type="number" name="edad" placeholder="Edad" value="<?php echo $edit['edad'] ?? ''; ?>" required>
        <button type="submit" name="guardar">Guardar</button>
    </form>
    <hr>
    <p>
        <strong>Ordenar:</strong> 
        <a href="clientes.php?ordenar=id_cliente">ID</a> | 
        <a href="clientes.php?ordenar=nombre">Nombre</a> | 
        <a href="clientes.php?ordenar=edad">Edad</a>
    </p>
    <table border="1">
        <tr>
            <th>ID</th><th>Nombre</th><th>Email</th><th>Edad</th><th>Acciones</th>
        </tr>
        <?php
        $actual = $lista->cabeza;
        while ($actual !== null) {
            $c = $actual->data;
            echo "<tr>
                <td>{$c['id_cliente']}</td>
                <td>{$c['nombre']}</td>
                <td>{$c['email']}</td>
                <td>{$c['edad']}</td>
                <td>
                    <a href='clientes.php?editar={$c['id_cliente']}'>Editar</a> | 
                    <a href='clientes.php?eliminar={$c['id_cliente']}'>Eliminar</a>
                </td>
            </tr>";
            $actual = $actual->siguiente;
        }
        ?>
    </table>
</body>
</html>