<?php

require_once './config/database.php';
require_once './app/models/Order.php';
require_once './app/models/User.php';

class AdminController
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->connect();
    }

    public function index()
    {
        require_once './app/views/admin/index.php';
    }

    public function dashboardView()
    {
        require_once './app/views/admin/dashboard.php';
    }

    public function productsView()
    {
        require_once './app/views/admin/products.php';
    }

    public function categoriesView()
    {
        require_once './app/views/admin/categories.php';
    }

    public function ordersView()
    {
        require_once './app/views/admin/orders.php';
    }

    public function usersView()
    {
        require_once './app/views/admin/users.php';
    }

    public function rolesView()
    {
        require_once './app/views/admin/roles.php';
    }

    public function dashboardJson()
    {
        header('Content-Type: application/json');

        $orderModel = new Order($this->db);
        $userModel = new User($this->db);

        $usuarios = count($userModel->getAllAdmin());
        $pedidos = $orderModel->countAll();
        $pedidosProcesando = $orderModel->countByStatus('procesando');
        $pedidosCancelados = $orderModel->countByStatus('cancelado');

        echo json_encode([
            'response' => '00',
            'data' => [
                'usuarios' => $usuarios,
                'pedidos' => $pedidos,
                'procesando' => $pedidosProcesando,
                'cancelados' => $pedidosCancelados
            ]
        ]);
        exit;
    }
}