<!DOCTYPE html>
<html lang="es">

<?php require_once './app/views/fragments/head.php'; ?>

<body>

    <?php require_once './app/views/fragments/header.php'; ?>

    <div class="container my-5">

        <h1 class="mb-4">Mis pedidos</h1>

        <div id="contenedorMisPedidos"></div>

    </div>

    <div class="modal fade" id="modalDetalleMiPedido" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Detalle del pedido</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <table class="table table-bordered align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio unitario</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>

                        <tbody id="tablaDetalleMiPedido"></tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>

    <?php require_once './app/views/fragments/footer.php'; ?>

    <script src="public/js/orders.js"></script>

</body>

</html>