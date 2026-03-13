<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Agregar producto</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>

<header>
    <h1>Agregar producto</h1>
    <nav>
        <a href="index.php">Inicio</a>
        <a href="productos.php">Productos</a>
        <a href="pedidos.php">Pedidos</a>
    </nav>
</header>

<div class="contenedor">
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

<footer>
    ATI SPORTWEAR
</footer>

</body>
</html>