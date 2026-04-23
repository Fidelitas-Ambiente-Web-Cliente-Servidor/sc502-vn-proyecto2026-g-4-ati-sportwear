<!DOCTYPE html>
<html lang="es">

<?php require_once './app/views/fragments/head.php'; ?>

<body>

    <?php require_once './app/views/fragments/header.php'; ?>

    <section class="container my-4">

        <div class="row g-3">

            <div class="col-md-6">
                <input type="text" id="inputBuscar" class="form-control" placeholder="Buscar producto">
            </div>

            <div class="col-md-6 d-flex gap-2 flex-wrap" id="contenedorCategorias"></div>

        </div>

    </section>

    <section class="container my-5">
        <div class="row">
            <div class="col-12">
                <h1 class="mb-4">Catálogo</h1>
            </div>
        </div>

        <div class="row g-4" id="contenedorProductos"></div>
    </section>

    <?php require_once './app/views/fragments/footer.php'; ?>
    <script src="public/js/products.js"></script>

</body>

</html>