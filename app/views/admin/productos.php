<!DOCTYPE html>
<html lang="es">
<?php include "../fragmentos/head.php"; ?>

<body>

    <?php include "../fragmentos/header.php"; ?>

    <div class="contenedor">
        <a class="boton" href="admin.php">Volver a Modo Admin</a>

        <h2>Productos</h2>

        <a class="boton" href="agregar_producto.php">Nuevo producto</a>

        <table>
            <tr>
                <th>ID</th>
                <th>Producto</th>
                <th>Categoria</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Acciones</th>
            </tr>

            <tr>
                <td>1</td>
                <td>Rashguard Negra</td>
                <td>Camisetas</td>
                <td>18000</td>
                <td>12</td>
                <td><a href="editar_producto.php">Editar</a></td>
            </tr>

            <tr>
                <td>2</td>
                <td>Pantaloneta Jiu Jitsu</td>
                <td>Pantalonetas</td>
                <td>16500</td>
                <td>8</td>
                <td><a href="editar_producto.php">Editar</a></td>
            </tr>

            <tr>
                <td>3</td>
                <td>Gorra Deportiva</td>
                <td>Gorras</td>
                <td>9500</td>
                <td>15</td>
                <td><a href="editar_producto.php">Editar</a></td>
            </tr>
        </table>
    </div>

    <?php include "../fragmentos/footer.php"; ?>

</body>

</html>