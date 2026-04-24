<?php

require_once './config/database.php';
require_once './app/models/Order.php';
require_once './app/models/User.php';
require_once './app/models/Product.php';
require_once './app/models/Category.php';

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

    //Para esta función se utilizó apoyo de IA.
    public function dashboardJson()
    {
        header('Content-Type: application/json');

        $orderModel = new Order($this->db);
        $userModel = new User($this->db);
        $productModel = new Product($this->db);
        $categoryModel = new Category($this->db);

        $usuarios = $userModel->countAll();
        $productos = $productModel->countAll();
        $categorias = $categoryModel->countAll();

        $pedidos = $orderModel->countAll();
        $enviados = $orderModel->countByStatus('enviado');
        $procesando = $orderModel->countByStatus('procesando');
        $entregados = $orderModel->countByStatus('entregado');
        $cancelados = $orderModel->countByStatus('cancelado');

        $porcentajeEnviados = $pedidos > 0 ? ($enviados / $pedidos) * 100 : 0;
        $porcentajeProcesando = $pedidos > 0 ? ($procesando / $pedidos) * 100 : 0;
        $porcentajeEntregados = $pedidos > 0 ? ($entregados / $pedidos) * 100 : 0;
        $porcentajeCancelados = $pedidos > 0 ? ($cancelados / $pedidos) * 100 : 0;

        echo json_encode([
            'response' => '00',
            'data' => [
                'usuarios' => $usuarios,
                'productos' => $productos,
                'categorias' => $categorias,
                'pedidos' => $pedidos,
                'enviados' => $enviados,
                'procesando' => $procesando,
                'entregados' => $entregados,
                'cancelados' => $cancelados,
                'porcentaje_enviados' => $porcentajeEnviados,
                'porcentaje_procesando' => $porcentajeProcesando,
                'porcentaje_entregados' => $porcentajeEntregados,
                'porcentaje_cancelados' => $porcentajeCancelados
            ]
        ]);
        exit;
    }
}