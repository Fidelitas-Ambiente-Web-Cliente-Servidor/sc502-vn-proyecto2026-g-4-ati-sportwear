<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Carrito</title>
    <link rel="stylesheet" href="../css/estilos.css">
    <script src="../js/app.js" defer></script>
</head>
<body>

<header>
    <h1>ATI SPORTWEAR</h1>
    <nav>
        <a href="../index.php">Inicio</a>
        <a href="index.php">Carrito</a>
        <a href="../admin/index.php">Admin</a>
    </nav>
</header>

<div class="contenedor">
    <h2>Carrito de compras</h2>

    <div class="carrito-item">
        <p><b>Rashguard Negra</b></p>
        <p>Precio: 18000</p>

        <button class="restar">-</button>
        <span class="cantidad">1</span>
        <button class="sumar">+</button>
    </div>

    <div class="carrito-item">
        <p><b>Pantaloneta Jiu Jitsu</b></p>
        <p>Precio: 16500</p>

        <button class="restar">-</button>
        <span class="cantidad">1</span>
        <button class="sumar">+</button>
    </div>

    <h3>Total: 34500</h3>

    <button class="boton">Finalizar compra</button>
</div>

<footer>
    ATI SPORTWEAR
</footer>

</body>
</html>