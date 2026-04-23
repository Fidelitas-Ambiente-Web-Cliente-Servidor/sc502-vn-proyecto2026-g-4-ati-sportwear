<?php

require_once __DIR__ . '/../models/Products.php';

class ProductController
{
    private $productsModel;

    public function __construct()
    {
        $this->productsModel = new Products();
    }

    public function getProductsJson()
    {
        $search = trim((string) ($_GET['search'] ?? ''));
        $category = trim((string) ($_GET['category'] ?? ''));

        $this->sendJson([
            'ok' => true,
            'products' => $this->productsModel->getProducts($search, $category),
            'categories' => $this->productsModel->getCategories(),
        ]);
    }

    public function getProductDetailJson()
    {
        $productId = (int) ($_GET['id'] ?? 0);

        if ($productId <= 0) {
            $this->sendJson([
                'ok' => false,
                'message' => 'Producto invalido.',
            ], 400);
        }

        $product = $this->productsModel->getProductById($productId);

        if ($product === null) {
            $this->sendJson([
                'ok' => false,
                'message' => 'Producto no encontrado.',
            ], 404);
        }

        $this->sendJson([
            'ok' => true,
            'product' => $product,
        ]);
    }

    public function addToCartJson()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        $productId = (int) ($_POST['product_id'] ?? $_GET['product_id'] ?? 0);
        $quantity = max(1, (int) ($_POST['quantity'] ?? $_GET['quantity'] ?? 1));

        if ($productId <= 0) {
            $this->sendJson([
                'ok' => false,
                'message' => 'Producto invalido.',
            ], 400);
        }

        $product = $this->productsModel->getProductById($productId);

        if ($product === null) {
            $this->sendJson([
                'ok' => false,
                'message' => 'Producto no encontrado.',
            ], 404);
        }

        if ((int) $product['stock'] <= 0 || $product['estado'] === 'agotado') {
            $this->sendJson([
                'ok' => false,
                'message' => 'Este producto esta agotado.',
            ], 409);
        }

        if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        $_SESSION['cart'][$productId] = ($_SESSION['cart'][$productId] ?? 0) + $quantity;

        $cartCount = array_sum($_SESSION['cart']);

        $this->sendJson([
            'ok' => true,
            'message' => 'Producto agregado al carrito.',
            'cartCount' => $cartCount,
        ]);
    }

    private function sendJson(array $payload, $statusCode = 200)
    {
        header('Content-Type: application/json; charset=UTF-8');
        http_response_code($statusCode);
        echo json_encode($payload, JSON_UNESCAPED_UNICODE);
        exit;
    }
}
