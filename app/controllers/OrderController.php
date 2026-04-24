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
}