<?php
$action = $_GET['action'] ?? $_POST['action'] ?? null;

if ($action !== null) {
    require_once __DIR__ . '/controllers/ProductController.php';

    switch ($action) {
        case 'productos_json':
            $controller = new ProductController();
            $controller->getProductsJson();
            break;

        case 'producto_detalle_json':
            $controller = new ProductController();
            $controller->getProductDetailJson();
            break;

        case 'agregar_carrito_json':
            $controller = new ProductController();
            $controller->addToCartJson();
            break;

        default:
            header('Content-Type: application/json; charset=UTF-8');
            http_response_code(404);
            echo json_encode([
                'ok' => false,
                'message' => 'Accion no encontrada.',
            ], JSON_UNESCAPED_UNICODE);
            exit;
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<?php include "fragmentos/head.php"; ?>

<body>
    <?php include "fragmentos/header.php"; ?>

    <section class="landing">

        <div class="landing-contenido">

            <h1>ATI SPORTWEAR</h1>
            <p>Discipline · Precision · Power</p>

            <a href="catalogo/catalogo.php" class="btn btn-dark btn-lg">
                Ver Catalogo
            </a>

        </div>

    </section>


    <?php include "fragmentos/footer.php"; ?>

</body>

</html>
