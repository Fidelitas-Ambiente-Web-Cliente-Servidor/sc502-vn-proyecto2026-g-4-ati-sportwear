<?php

require_once './config/database.php';
require_once './app/models/Category.php';

class CategoryController
{
    private $model;

    public function __construct()
    {
        $database = new Database();
        $db = $database->connect();
        $this->model = new Category($db);
    }

    public function getAllJson()
    {
        $result = $this->model->getAll();

        $categories = [];

        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }

        echo json_encode($categories);
        exit;
    }
}