<!DOCTYPE html>
<html lang="es">

<?php require_once './app/views/fragments/head.php'; ?>

<body>

    <?php require_once './app/views/fragments/header.php'; ?>

    <section class="container my-5">

        <div class="row">

            <div class="col-md-6">
                <img src="public/img/<?php echo $product['imagen']; ?>" class="img-fluid">
            </div>

            <div class="col-md-6">
                <h2><?php echo $product['nombre']; ?></h2>

                <p><?php echo $product['descripcion']; ?></p>

                <p class="precio">₡<?php echo $product['precio']; ?></p>

                <p>
                    <?php if ($product['estado'] == 'agotado' || $product['cantidad'] <= 0): ?>
                        <strong>Agotado</strong>
                    <?php else: ?>
                        <strong>Disponibles:</strong> <?php echo $product['cantidad']; ?>
                    <?php endif; ?>
                </p>

                <?php if ($product['estado'] == 'agotado' || $product['cantidad'] <= 0): ?>

                    <button class="btn btn-secondary" disabled>
                        Agotado
                    </button>

                <?php else: ?>

                    <div class="mb-3">
                        <label class="form-label">Cantidad</label>
                        <input type="number" id="cantidadDetalle" class="form-control" value="1" min="1"
                            max="<?php echo $product['cantidad']; ?>">
                    </div>

                    <button class="btn btn-dark btnAgregarCarritoDetalle" data-id="<?php echo $product['id_producto']; ?>">
                        Agregar al carrito
                    </button>

                <?php endif; ?>
            </div>

        </div>

    </section>

    <?php require_once './app/views/fragments/footer.php'; ?>
    <script src="public/js/products.js"></script>

</body>

</html>