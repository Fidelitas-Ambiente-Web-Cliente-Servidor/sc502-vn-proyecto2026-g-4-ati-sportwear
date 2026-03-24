<?php

require_once __DIR__ . '/../../config/database.php';

class HomeController
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->connect();
    }

    public function index()
    {
        // Aquí después puedes traer datos (productos destacados, etc.)
        // Por ahora lo dejamos simple

        require __DIR__ . '/../views/index.php';
    }
}
