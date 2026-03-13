<!DOCTYPE html>
<html lang="es">
<?php include "../fragmentos/head.php"; ?>

<body>

    <?php include "../fragmentos/header.php"; ?>

    <div class="contenedor">
        <ul class="listaPanel">
            <li><a class="boton" href="admin.php">Volver a Modo Admin</a></li>
            <br>
            <li><a class="boton" href="productos.php">Volver a Productos</a></li>
            <br>
        </ul>

        <h2>Agregar producto</h2>

        <form class="formulario">
            <label>Nombre</label>
            <input type="text">

            <label>Descripcion</label>
            <textarea></textarea>

            <label>Categoria</label>
            <select>
                <option>Camisetas</option>
                <option>Pantalonetas</option>
                <option>Gorras</option>
                <option>Accesorios</option>
            </select>

            <label>Precio</label>
            <input type="number">

            <label>Stock</label>
            <input type="number">

            <label>Imagen</label>
            <input type="file">

            <button type="submit">Guardar</button>
        </form>
    </div>

    <?php include "../fragmentos/footer.php"; ?>

</body>

</html>