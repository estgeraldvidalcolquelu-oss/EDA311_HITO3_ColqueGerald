<?php
require_once 'conexion.php';
require_once 'ListaDoble.php';
if (isset($_POST['guardar'])) {
    $id = $_POST['id_pedido'];
    $id_cliente = $_POST['id_cliente'];
    $fecha = $_POST['fecha'];
    $total = $_POST['total'];
    if ($id == "") {
        $conexion->query("INSERT INTO pedidos VALUES (NULL, '$id_cliente', '$fecha', '$total')");
    } else {
        $conexion->query("UPDATE pedidos SET id_cliente='$id_cliente', fecha='$fecha', total='$total' WHERE id_pedido=$id");
    }
    header("Location: pedidos.php");
}
if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];
    $conexion->query("DELETE FROM pedidos WHERE id_pedido = $id");
    header("Location: pedidos.php");
}
$lista = new ListaDoble();
$res = $conexion->query("SELECT * FROM pedidos");
$lista->cargarDesdeMySQL($res);

if (isset($_GET['ordenar'])) {
    $lista->ordenarPor($_GET['ordenar']);
}
$edit = null;
if (isset($_GET['editar'])) {
    $id = $_GET['editar'];
    $edit = $conexion->query("SELECT * FROM pedidos WHERE id_pedido = $id")->fetch_assoc();
}
?>
<!DOCTYPE html>
<html>
<head><title>Pedidos</title></head>
<body>
    <a href="index.php">← Menú</a>
    <h2>Pedidos</h2>

    <form method="POST" action="pedidos.php">
        <input type="hidden" name="id_pedido" value="<?php echo $edit['id_pedido'] ?? ''; ?>">
        <input type="number" name="id_cliente" placeholder="ID Cliente" value="<?php echo $edit['id_cliente'] ?? ''; ?>" required>
        <input type="date" name="fecha" value="<?php echo $edit['fecha'] ?? ''; ?>" required>
        <input type="number" step="0.01" name="total" placeholder="Total" value="<?php echo $edit['total'] ?? ''; ?>" required>
        <button type="submit" name="guardar">Guardar</button>
    </form>
    <hr>
    <p>
        <strong>Ordenar:</strong> 
        <a href="pedidos.php?ordenar=id_pedido">ID Pedido</a> | 
        <a href="pedidos.php?ordenar=total">Total</a>
    </p>
    <table border="1">
        <tr>
            <th>ID Pedido</th><th>ID Cliente</th><th>Fecha</th><th>Total</th><th>Acciones</th>
        </tr>
        <?php
        $actual = $lista->cabeza;
        while ($actual != null) {
            $ped = $actual->data;
            echo "<tr>
                <td>{$ped['id_pedido']}</td>
                <td>{$ped['id_cliente']}</td>
                <td>{$ped['fecha']}</td>
                <td>{$ped['total']}</td>
                <td>
                    <a href='pedidos.php?editar={$ped['id_pedido']}'>Editar</a> | 
                    <a href='pedidos.php?eliminar={$ped['id_pedido']}'>Eliminar</a>
                </td>
            </tr>";
            $actual = $actual->siguiente;
        }
        ?>
    </table>
</body>
</html>