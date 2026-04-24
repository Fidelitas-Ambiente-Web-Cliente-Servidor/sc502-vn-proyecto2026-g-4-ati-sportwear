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
            p.estado,
            c.nombre AS categoria
        FROM productos p
        INNER JOIN categorias c ON p.id_categoria = c.id_categoria
        WHERE p.id_producto = ?");

        $stmt->bind_param("i", $id);
        $stmt->execute();

        return $stmt->get_result()->fetch_assoc();
    }

    public function getAllAdmin()
    {
        $stmt = $this->conn->prepare("SELECT 
            p.id_producto,
            p.nombre,
            p.descripcion,
            p.precio,
            p.cantidad,
            p.imagen,
            p.estado,
            c.nombre AS categoria
        FROM productos p
        INNER JOIN categorias c ON p.id_categoria = c.id_categoria
        ORDER BY p.id_producto");

        $stmt->execute();

        return $stmt->get_result();
    }

    public function countAll()
    {
        $stmt = $this->conn->prepare("SELECT COUNT(*) AS total FROM productos");
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return $row['total'];
    }

    public function getByIdAdmin($id)
    {
        $stmt = $this->conn->prepare("SELECT 
            id_producto,
            nombre,
            descripcion,
            precio,
            cantidad,
            imagen,
            id_categoria,
            estado
        FROM productos
        WHERE id_producto = ?");

        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function create($nombre, $descripcion, $precio, $cantidad, $imagen, $idCategoria, $estado)
    {
        $stmt = $this->conn->prepare("INSERT INTO productos
            (nombre, descripcion, precio, cantidad, imagen, id_categoria, estado)
        VALUES (?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param("ssdisss", $nombre, $descripcion, $precio, $cantidad, $imagen, $idCategoria, $estado);

        return $stmt->execute();
    }

    public function update($id, $nombre, $descripcion, $precio, $cantidad, $imagen, $idCategoria, $estado)
    {
        $stmt = $this->conn->prepare("UPDATE productos
        SET nombre = ?,
            descripcion = ?,
            precio = ?,
            cantidad = ?,
            imagen = ?,
            id_categoria = ?,
            estado = ?
        WHERE id_producto = ?");

        $stmt->bind_param("ssdisssi", $nombre, $descripcion, $precio, $cantidad, $imagen, $idCategoria, $estado, $id);

        return $stmt->execute();
    }

    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM productos WHERE id_producto = ?");
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }
}