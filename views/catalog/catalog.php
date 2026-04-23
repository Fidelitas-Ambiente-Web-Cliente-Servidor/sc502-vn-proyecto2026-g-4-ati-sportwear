<!DOCTYPE html>
<html lang="es">

<?php include __DIR__ . '/../../fragmentos/head.php'; ?>

<body>

    <?php include __DIR__ . '/../../fragmentos/header.php'; ?>

    <section class="container my-4">
        <div class="row g-3 align-items-start">
            <div class="col-md-6">
                <input
                    id="product-search"
                    type="text"
                    class="form-control"
                    placeholder="Buscar producto"
                    autocomplete="off">
            </div>

            <div class="col-md-6 d-flex gap-2 flex-wrap" id="category-filters">
                <button type="button" class="btn btn-outline-dark catalog-filter is-active" data-category="">Todas</button>
                <button type="button" class="btn btn-outline-dark catalog-filter" data-category="Camisetas">Camisetas</button>
                <button type="button" class="btn btn-outline-dark catalog-filter" data-category="Pantalones">Pantalones</button>
                <button type="button" class="btn btn-outline-dark catalog-filter" data-category="Shorts">Shorts</button>
                <button type="button" class="btn btn-outline-dark catalog-filter" data-category="Accesorios">Accesorios</button>
            </div>
        </div>
    </section>

    <section class="container pb-4">
        <div id="catalog-feedback" class="alert alert-light border catalog-feedback visually-hidden" role="status"></div>
        <div id="products-grid" class="row g-4"></div>

        <noscript>
            <div class="alert alert-warning mt-3">
                Activa JavaScript para cargar el catalogo.
            </div>
        </noscript>
    </section>

    <div id="product-detail-modal" class="product-modal" hidden>
        <div class="product-modal__dialog">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="mb-0">Detalle del producto</h3>
                <button type="button" id="close-product-modal" class="product-modal__close">Cerrar</button>
            </div>

            <div id="product-detail-content"></div>
        </div>
    </div>

    <?php include __DIR__ . '/../../fragmentos/footer.php'; ?>

    <script>
        window.ATI_BASE_URL = "/sc502-vn-proyecto2026-g-4-ati-sportwear";
    </script>
    <script src="/sc502-vn-proyecto2026-g-4-ati-sportwear/js/products.js" defer></script>
</body>

</html>
