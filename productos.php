<?php
require_once 'conexion.php';
require_once 'ListaDoble.php';
if (isset($_POST['guardar'])) {
    $id = $_POST['id_producto'];
    $nombre = $_POST['nombre'];
    $categoria = $_POST['categoria'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    if ($id == "") {
        $conexion->query("INSERT INTO productos VALUES (NULL, '$nombre', '$categoria', '$precio', '$stock')");
    } else {
        $conexion->query("UPDATE productos SET nombre='$nombre', categoria='$categoria', precio='$precio', stock='$stock' WHERE id_producto=$id");
    }
    header("Location: productos.php");
}
if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];
    $conexion->query("DELETE FROM productos WHERE id_producto = $id");
    header("Location: productos.php");
}
$lista = new ListaDoble();
$res = $conexion->query("SELECT * FROM productos");
$lista->cargarDesdeMySQL($res);

if (isset($_GET['ordenar'])) {
    $lista->ordenarPor($_GET['ordenar']);
}
$edit = null;
if (isset($_GET['editar'])) {
    $id = $_GET['editar'];
    $edit = $conexion->query("SELECT * FROM productos WHERE id_producto = $id")->fetch_assoc();
}
?>
<!DOCTYPE html>
<html>
<head><title>Productos</title></head>
<body>
    <a href="index.php">← Menú</a>
    <h2>Productos</h2>

    <form method="POST" action="productos.php">
        <input type="hidden" name="id_producto" value="<?php echo $edit['id_producto'] ?? ''; ?>">
        <input type="text" name="nombre" placeholder="Nombre" value="<?php echo $edit['nombre'] ?? ''; ?>" required>
        <input type="text" name="categoria" placeholder="Categoría" value="<?php echo $edit['categoria'] ?? ''; ?>" required>
        <input type="number" step="0.01" name="precio" placeholder="Precio" value="<?php echo $edit['precio'] ?? ''; ?>" required>
        <input type="number" name="stock" placeholder="Stock" value="<?php echo $edit['stock'] ?? ''; ?>" required>
        <button type="submit" name="guardar">Guardar</button>
    </form>
    <hr>
    <p>
        <strong>Ordenar:</strong> 
        <a href="productos.php?ordenar=id_producto">ID</a> | 
        <a href="productos.php?ordenar=nombre">Nombre</a> | 
        <a href="productos.php?ordenar=precio">Precio</a>
    </p>
    <table border="1">
        <tr>
            <th>ID</th><th>Nombre</th><th>Categoría</th><th>Precio</th><th>Stock</th><th>Acciones</th>
        </tr>
        <?php
        $actual = $lista->cabeza;
        while ($actual != null) {
            $p = $actual->data;
            echo "<tr>
                <td>{$p['id_producto']}</td>
                <td>{$p['nombre']}</td>
                <td>{$p['categoria']}</td>
                <td>{$p['precio']}</td>
                <td>{$p['stock']}</td>
                <td>
                    <a href='productos.php?editar={$p['id_producto']}'>Editar</a> | 
                    <a href='productos.php?eliminar={$p['id_producto']}'>Eliminar</a>
                </td>
            </tr>";
            $actual = $actual->siguiente;
        }
        ?>
    </table>
</body>
</html>