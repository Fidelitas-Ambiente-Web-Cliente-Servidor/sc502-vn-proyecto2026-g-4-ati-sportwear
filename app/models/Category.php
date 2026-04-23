<?php

class Category
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll()
    {
        $stmt = $this->conn->prepare("SELECT id_categoria, nombre
            FROM categorias
            ORDER BY nombre ASC");

        $stmt->execute();

        return $stmt->get_result();
    }
}