<!DOCTYPE html>
<html lang="es">
<?php include "../fragmentos/head.php"; ?>

<body>

    <?php include "../fragmentos/header.php"; ?>

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

    <?php include "../fragmentos/footer.php"; ?>

</body>

</html>