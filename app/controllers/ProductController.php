<?php

require_once './config/database.php';
require_once './app/models/Product.php';

class ProductController
{
    private $model;

    public function __construct()
    {
        $database = new Database();
        $db = $database->connect();
        $this->model = new Product($db);
    }

    public function index()
    {
        require_once './app/views/products/catalogo.php';
    }

    public function getProductsJson()
    {
        $search = trim($_GET['search'] ?? '');
        $category = trim($_GET['category'] ?? '');

        $result = $this->model->getAll($search, $category);

        $products = [];

        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }

        echo json_encode($products);
        exit;
    }

    public function detail()
    {
        $id = $_GET['id'] ?? 0;

        $product = $this->model->getById($id);

        require_once './app/views/products/detail.php';
    }
}