<?php

require_once './config/database.php';
require_once './app/models/Order.php';
require_once './app/models/Product.php';

class OrderController
{
    private $model;
    private $productModel;

    public function __construct()
    {
        $database = new Database();
        $db = $database->connect();

        $this->model = new Order($db);
        $this->productModel = new Product($db);
    }

    public function getAllOrdersJson()
    {
        $result = $this->model->getAllAdmin();

        $orders = [];

        while ($row = $result->fetch_assoc()) {
            $orders[] = $row;
        }

        echo json_encode([
            'response' => '00',
            'data' => $orders
        ]);
        exit;
    }

    public function getOrderDetailJson()
    {
        $idPedido = $_GET['id_pedido'] ?? 0;

        $header = $this->model->getHeaderById($idPedido);
        $result = $this->model->getDetail($idPedido);

        $details = [];

        while ($row = $result->fetch_assoc()) {
            $details[] = $row;
        }

        echo json_encode([
            'response' => '00',
            'pedido' => $header,
            'detalle' => $details
        ]);
        exit;
    }

    public function changeOrderStatus()
    {
        $idPedido = $_POST['id_pedido'] ?? 0;
        $estado = $_POST['estado'] ?? '';

        if ($idPedido == 0 || $estado == '') {
            echo json_encode([
                'response' => '01',
                'message' => 'Datos incompletos'
            ]);
            exit;
        }

        $result = $this->model->changeStatus($idPedido, $estado);

        if ($result) {
            echo json_encode([
                'response' => '00',
                'message' => 'Estado actualizado correctamente'
            ]);
        } else {
            echo json_encode([
                'response' => '01',
                'message' => 'No se pudo actualizar el estado'
            ]);
        }

        exit;
    }

    //apoyo de IA para esta función.
    public function checkout()
    {
        if (!isset($_SESSION['user'])) {
            echo json_encode([
                'response' => '01',
                'message' => 'Debe iniciar sesión para finalizar la compra'
            ]);
            exit;
        }

        if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
            echo json_encode([
                'response' => '01',
                'message' => 'El carrito está vacío'
            ]);
            exit;
        }

        $idUsuario = $_SESSION['user']['id_usuario'];
        $carrito = $_SESSION['carrito'];

        $total = 0;

        foreach ($carrito as $item) {
            $producto = $this->productModel->getById($item['id_producto']);

            if (!$producto) {
                echo json_encode([
                    'response' => '01',
                    'message' => 'Uno de los productos ya no existe'
                ]);
                exit;
            }

            if ($producto['estado'] == 'agotado' || $producto['cantidad'] <= 0) {
                echo json_encode([
                    'response' => '01',
                    'message' => 'El producto ' . $producto['nombre'] . ' está agotado'
                ]);
                exit;
            }

            if ($item['cantidad'] > $producto['cantidad']) {
                echo json_encode([
                    'response' => '01',
                    'message' => 'No hay suficiente stock para ' . $producto['nombre']
                ]);
                exit;
            }

            $total += $item['subtotal'];
        }

        $idPedido = $this->model->createOrder($idUsuario, $total);

        if (!$idPedido) {
            echo json_encode([
                'response' => '01',
                'message' => 'No se pudo crear el pedido'
            ]);
            exit;
        }

        foreach ($carrito as $item) {
            $this->model->createOrderDetail(
                $idPedido,
                $item['id_producto'],
                $item['cantidad'],
                $item['precio'],
                $item['subtotal']
            );

            $this->model->decreaseStock($item['id_producto'], $item['cantidad']);
            $this->model->updateProductStatusIfEmpty($item['id_producto']);
        }

        unset($_SESSION['carrito']);

        echo json_encode([
            'response' => '00',
            'message' => 'Pedido realizado correctamente',
            'id_pedido' => $idPedido
        ]);
        exit;
    }

    public function getMyOrdersJson()
    {
        $idUsuario = $_SESSION['user']['id_usuario'];

        $result = $this->model->getByUser($idUsuario);

        $orders = [];

        while ($row = $result->fetch_assoc()) {
            $orders[] = $row;
        }

        echo json_encode([
            'response' => '00',
            'data' => $orders
        ]);
        exit;
    }

    public function myOrdersView()
    {
        require_once './app/views/orders/mis_pedidos.php';
    }

    public function getMyOrderDetailJson()
    {
        $idPedido = $_GET['id_pedido'] ?? 0;
        $idUsuario = $_SESSION['user']['id_usuario'];

        $result = $this->model->getMyOrderDetail($idPedido, $idUsuario);

        $details = [];

        while ($row = $result->fetch_assoc()) {
            $details[] = $row;
        }

        echo json_encode([
            'response' => '00',
            'data' => $details
        ]);
        exit;
    }
}