<?php
 
class Product
{
    private $conn;
 
    public function __construct($db)
    {
        $this->conn = $db;
    }
 
    public function getAll($search = '', $category = '')
    {
        $sql = "SELECT
                    p.id_producto,
                    p.nombre,
                    p.descripcion,
                    p.precio,
                    p.cantidad,
                    p.imagen,
                    c.nombre AS categoria
                FROM productos p
                INNER JOIN categorias c ON p.id_categoria = c.id_categoria
                WHERE 1=1";
 
        $params = [];
        $types = "";
 
        if ($search !== '') {
            $sql .= " AND p.nombre LIKE ?";
            $params[] = "%" . $search . "%";
            $types .= "s";
        }
 
        if ($category !== '') {
            $sql .= " AND p.id_categoria = ?";
            $params[] = $category;
            $types .= "i";
        }
 
        $stmt = $this->conn->prepare($sql);
 
        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }
 
        $stmt->execute();
 
        return $stmt->get_result();
    }
 
    public function getById($id)
    {
        $stmt = $this->conn->prepare("SELECT
        p.id_producto,
        p.nombre,
        p.descripcion,
        p.precio,
        p.cantidad,
        p.imagen,
        c.nombre AS categoria
        FROM productos p
        INNER JOIN categorias c ON p.id_categoria = c.id_categoria
        WHERE p.id_producto = ?");
 
        $stmt->bind_param("i", $id);
        $stmt->execute();
 
        return $stmt->get_result()->fetch_assoc();
    }
}