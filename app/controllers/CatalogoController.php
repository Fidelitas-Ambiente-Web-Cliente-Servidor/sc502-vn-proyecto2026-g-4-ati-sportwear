<?php

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/Product.php';

class CatalogoController
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
        require __DIR__ . '/../views/catalogo/catalogo.php';
    }
}
