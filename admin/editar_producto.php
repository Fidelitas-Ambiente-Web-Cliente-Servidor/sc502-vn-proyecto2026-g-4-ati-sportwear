<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar producto</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>

<header>
    <h1>Editar producto</h1>
    <nav>
        <a href="index.php">Inicio</a>
        <a href="productos.php">Productos</a>
        <a href="pedidos.php">Pedidos</a>
    </nav>
</header>

<div class="contenedor">
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

<footer>
    ATI SPORTWEAR
</footer>

</body>
</html>