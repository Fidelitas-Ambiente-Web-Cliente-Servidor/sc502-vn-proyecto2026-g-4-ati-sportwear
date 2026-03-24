<?php

class Product
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll()
    {
        $sql = "SELECT * FROM products";
        $result = $this->conn->query($sql);

        return $result;
    }
}
