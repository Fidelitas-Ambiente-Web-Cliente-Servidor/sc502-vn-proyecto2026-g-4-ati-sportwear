<!DOCTYPE html>
<html lang="es">

<?php include "../fragmentos/head.php"; ?>

<body>

    <?php include "../fragmentos/header.php"; ?>

    <div class="contenedor">
        <a class="boton" href="admin.php">Volver a Modo Admin</a>

        <h2>Pedidos</h2>

        <table>
            <tr>
                <th>Pedido</th>
                <th>Cliente</th>
                <th>Total</th>
                <th>Estado</th>
            </tr>

            <tr>
                <td>#001</td>
                <td>Maria</td>
                <td>34500</td>
                <td>En proceso</td>
            </tr>

            <tr>
                <td>#002</td>
                <td>Juan</td>
                <td>18000</td>
                <td>Procesado</td>
            </tr>

            <tr>
                <td>#003</td>
                <td>Ana</td>
                <td>16500</td>
                <td>Cancelado</td>
            </tr>
        </table>
    </div>

    <?php include "../fragmentos/footer.php"; ?>

</body>

</html>