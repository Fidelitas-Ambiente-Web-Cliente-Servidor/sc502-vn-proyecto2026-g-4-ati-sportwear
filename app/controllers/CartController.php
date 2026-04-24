<?php

require_once './config/database.php';
require_once './app/models/Product.php';

class CartController
{
    private $productModel;

    public function __construct()
    {
        $database = new Database();
        $db = $database->connect();
        $this->productModel = new Product($db);
    }

    public function index()
    {
        require_once './app/views/cart/carrito.php';
    }

    public function addToCart()
    {
        $idProducto = $_POST['id_producto'] ?? 0;
        $cantidad = $_POST['cantidad'] ?? 1;

        if ($idProducto == 0 || $cantidad <= 0) {
            echo json_encode([
                'response' => '01',
                'message' => 'Producto no válido'
            ]);
            exit;
        }

        $product = $this->productModel->getById($idProducto);

        if (!$product) {
            echo json_encode([
                'response' => '01',
                'message' => 'Producto no encontrado'
            ]);
            exit;
        }

        if ($product['estado'] == 'agotado' || $product['cantidad'] <= 0) {
            echo json_encode([
                'response' => '01',
                'message' => 'Producto agotado'
            ]);
            exit;
        }

        if ($cantidad > $product['cantidad']) {
            echo json_encode([
                'response' => '01',
                'message' => 'No hay suficiente stock disponible'
            ]);
            exit;
        }

        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = [];
        }

        if (isset($_SESSION['carrito'][$idProducto])) {
            $nuevaCantidad = $_SESSION['carrito'][$idProducto]['cantidad'] + $cantidad;

            if ($nuevaCantidad > $product['cantidad']) {
                echo json_encode([
                    'response' => '01',
                    'message' => 'No puede agregar más unidades que las disponibles'
                ]);
                exit;
            }

            $_SESSION['carrito'][$idProducto]['cantidad'] = $nuevaCantidad;
            $_SESSION['carrito'][$idProducto]['subtotal'] = $nuevaCantidad * $product['precio'];
        } else {
            $_SESSION['carrito'][$idProducto] = [
                'id_producto' => $product['id_producto'],
                'nombre' => $product['nombre'],
                'precio' => $product['precio'],
                'cantidad' => $cantidad,
                'imagen' => $product['imagen'],
                'subtotal' => $cantidad * $product['precio']
            ];
        }

        echo json_encode([
            'response' => '00',
            'message' => 'Producto agregado al carrito'
        ]);
        exit;
    }

    public function getCartJson()
    {
        $carrito = $_SESSION['carrito'] ?? [];

        echo json_encode([
            'response' => '00',
            'data' => array_values($carrito)
        ]);
        exit;
    }

    public function clearCart()
    {
        unset($_SESSION['carrito']);

        echo json_encode([
            'response' => '00',
            'message' => 'Carrito vaciado'
        ]);
        exit;
    }

    public function updateCart()
    {
        $idProducto = $_POST['id_producto'] ?? 0;
        $cantidad = $_POST['cantidad'] ?? 0;

        if ($idProducto == 0 || $cantidad <= 0) {
            echo json_encode([
                'response' => '01',
                'message' => 'Cantidad no válida'
            ]);
            exit;
        }

        if (!isset($_SESSION['carrito'][$idProducto])) {
            echo json_encode([
                'response' => '01',
                'message' => 'Producto no encontrado en el carrito'
            ]);
            exit;
        }

        $product = $this->productModel->getById($idProducto);

        if (!$product || $cantidad > $product['cantidad']) {
            echo json_encode([
                'response' => '01',
                'message' => 'No hay suficiente stock disponible'
            ]);
            exit;
        }

        $_SESSION['carrito'][$idProducto]['cantidad'] = $cantidad;
        $_SESSION['carrito'][$idProducto]['subtotal'] = $cantidad * $_SESSION['carrito'][$idProducto]['precio'];

        echo json_encode([
            'response' => '00',
            'message' => 'Carrito actualizado'
        ]);
        exit;
    }

    public function removeFromCart()
    {
        $idProducto = $_POST['id_producto'] ?? 0;

        if ($idProducto == 0 || !isset($_SESSION['carrito'][$idProducto])) {
            echo json_encode([
                'response' => '01',
                'message' => 'Producto no encontrado'
            ]);
            exit;
        }

        unset($_SESSION['carrito'][$idProducto]);

        echo json_encode([
            'response' => '00',
            'message' => 'Producto eliminado del carrito'
        ]);
        exit;
    }
}