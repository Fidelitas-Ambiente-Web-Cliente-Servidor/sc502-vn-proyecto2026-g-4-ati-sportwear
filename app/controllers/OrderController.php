<?php

require_once './config/database.php';
require_once './app/models/Order.php';

class OrderController
{
    private $model;

    public function __construct()
    {
        $database = new Database();
        $db = $database->connect();
        $this->model = new Order($db);
    }

    public function getAllOrdersJson()
    {
        header('Content-Type: application/json');

        $orders = $this->model->getAllAdmin();

        echo json_encode([
            'response' => '00',
            'data' => $orders
        ]);
        exit;
    }

    public function getOrderDetailJson()
    {
        header('Content-Type: application/json');

        $idPedido = intval($_POST['id_pedido'] ?? 0);

        if ($idPedido <= 0) {
            echo json_encode([
                'response' => '01',
                'message' => 'Pedido inválido'
            ]);
            exit;
        }

        $order = $this->model->getById($idPedido);
        $detail = $this->model->getDetail($idPedido);

        if (!$order) {
            echo json_encode([
                'response' => '01',
                'message' => 'Pedido no encontrado'
            ]);
            exit;
        }

        echo json_encode([
            'response' => '00',
            'pedido' => $order,
            'detalle' => $detail
        ]);
        exit;
    }

    public function changeOrderStatus()
    {
        header('Content-Type: application/json');

        $idPedido = intval($_POST['id_pedido'] ?? 0);
        $estado = trim($_POST['estado'] ?? '');

        $estadosPermitidos = ['enviado', 'procesando', 'entregado', 'cancelado'];

        if ($idPedido <= 0 || !in_array($estado, $estadosPermitidos)) {
            echo json_encode([
                'response' => '01',
                'message' => 'Datos inválidos'
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
}