<!DOCTYPE html>
<html lang="es">
<?php include "../fragmentos/head.php"; ?>

<body>

    <?php include "../fragmentos/header.php"; ?>

    <div class="contenedor">
        <a class="boton" href="productos.php">Volver a Productos</a>

        <h2>Editar producto</h2>

        <form class="formulario">
            <label>Nombre</label>
            <input type="text" value="Rashguard Negra">

            <label>Descripcion</label>
            <textarea>Rashguard deportiva</textarea>

            <label>Categoria</label>
            <select>
                <option selected>Camisetas</option>
                <option>Pantalonetas</option>
                <option>Gorras</option>
                <option>Accesorios</option>
            </select>

            <label>Precio</label>
            <input type="number" value="18000">

            <label>Stock</label>
            <input type="number" value="12">

            <button type="submit">Actualizar</button>
        </form>
    </div>

    <?php include "../fragmentos/footer.php"; ?>

</body>

</html>