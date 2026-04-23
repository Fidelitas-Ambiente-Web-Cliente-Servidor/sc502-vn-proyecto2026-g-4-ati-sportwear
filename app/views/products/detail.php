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
                <h2>
                    <?php echo $product['nombre']; ?>
                </h2>

                <p>
                    <?php echo $product['descripcion']; ?>
                </p>

                <p class="precio">₡
                    <?php echo $product['precio']; ?>
                </p>

                <button class="btn btn-dark">Agregar al carrito</button>
            </div>

        </div>
    
    </section>

    <?php require_once './app/views/fragments/footer.php'; ?>

</body>

</html>