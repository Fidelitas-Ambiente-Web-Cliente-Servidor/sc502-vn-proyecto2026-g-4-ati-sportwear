<?php

class Order
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }


    public function getById($idPedido)
    {
        $stmt = $this->conn->prepare("SELECT 
                    p.id_pedido,
                    p.fecha,
                    p.total,
                    p.estado,
                    u.id_usuario,
                    u.nombre,
                    u.apellidos,
                    u.email
                FROM pedidos p
                INNER JOIN usuarios u ON p.id_usuario = u.id_usuario
                WHERE p.id_pedido = ?");

        $stmt->bind_param("i", $idPedido);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function getAllAdmin()
    {
        $stmt = $this->conn->prepare("SELECT 
            p.id_pedido,
            p.fecha,
            p.total,
            p.estado,
            u.nombre,
            u.apellidos,
            u.email
        FROM pedidos p
        INNER JOIN usuarios u ON p.id_usuario = u.id_usuario
        ORDER BY p.id_pedido");

        $stmt->execute();

        return $stmt->get_result();
    }

    public function getDetail($idPedido)
    {
        $stmt = $this->conn->prepare("SELECT 
            pd.id_detalle,
            pd.id_pedido,
            pd.id_producto,
            pr.nombre AS producto,
            pd.cantidad,
            pd.precio_unitario,
            pd.subtotal
        FROM pedido_detalle pd
        INNER JOIN productos pr ON pd.id_producto = pr.id_producto
        WHERE pd.id_pedido = ?");

        $stmt->bind_param("i", $idPedido);
        $stmt->execute();

        return $stmt->get_result();
    }

    public function getHeaderById($idPedido)
    {
        $stmt = $this->conn->prepare("SELECT 
            p.id_pedido,
            p.fecha,
            p.total,
            p.estado,
            u.nombre,
            u.apellidos,
            u.email
        FROM pedidos p
        INNER JOIN usuarios u ON p.id_usuario = u.id_usuario
        WHERE p.id_pedido = ?");

        $stmt->bind_param("i", $idPedido);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function changeStatus($idPedido, $estado)
    {
        $stmt = $this->conn->prepare("UPDATE pedidos
        SET estado = ?
        WHERE id_pedido = ?");

        $stmt->bind_param("si", $estado, $idPedido);

        return $stmt->execute();
    }

    public function countAll()
    {
        $stmt = $this->conn->prepare("SELECT COUNT(*) AS total FROM pedidos");
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return $row['total'];
    }

    public function countByStatus($estado)
    {
        $stmt = $this->conn->prepare("SELECT COUNT(*) AS total 
        FROM pedidos 
        WHERE estado = ?");

        $stmt->bind_param("s", $estado);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return $row['total'];
    }

    public function createOrder($idUsuario, $total)
    {
        $stmt = $this->conn->prepare("INSERT INTO pedidos
            (id_usuario, fecha, total, estado)
        VALUES (?, NOW(), ?, 'procesando')");

        $stmt->bind_param("id", $idUsuario, $total);

        if ($stmt->execute()) {
            return $this->conn->insert_id;
        }

        return false;
    }

    public function createOrderDetail($idPedido, $idProducto, $cantidad, $precioUnitario, $subtotal)
    {
        $stmt = $this->conn->prepare("INSERT INTO pedido_detalle
            (id_pedido, id_producto, cantidad, precio_unitario, subtotal)
        VALUES (?, ?, ?, ?, ?)");

        $stmt->bind_param("iiidd", $idPedido, $idProducto, $cantidad, $precioUnitario, $subtotal);

        return $stmt->execute();
    }

    public function decreaseStock($idProducto, $cantidad)
    {
        $stmt = $this->conn->prepare("UPDATE productos
        SET cantidad = cantidad - ?
        WHERE id_producto = ?");

        $stmt->bind_param("ii", $cantidad, $idProducto);

        return $stmt->execute();
    }

    public function updateProductStatusIfEmpty($idProducto)
    {
        $stmt = $this->conn->prepare("UPDATE productos
        SET estado = 'agotado'
        WHERE id_producto = ? AND cantidad <= 0");

        $stmt->bind_param("i", $idProducto);

        return $stmt->execute();
    }

    public function getByUser($idUsuario)
    {
        $stmt = $this->conn->prepare("SELECT 
            id_pedido,
            fecha,
            total,
            estado
        FROM pedidos
        WHERE id_usuario = ?
        ORDER BY id_pedido DESC");

        $stmt->bind_param("i", $idUsuario);
        $stmt->execute();

        return $stmt->get_result();
    }

    public function getMyOrderDetail($idPedido, $idUsuario)
    {
        $stmt = $this->conn->prepare("SELECT 
            pd.id_detalle,
            pr.nombre AS producto,
            pd.cantidad,
            pd.precio_unitario,
            pd.subtotal
        FROM pedido_detalle pd
        INNER JOIN pedidos p ON pd.id_pedido = p.id_pedido
        INNER JOIN productos pr ON pd.id_producto = pr.id_producto
        WHERE pd.id_pedido = ?
        AND p.id_usuario = ?");

        $stmt->bind_param("ii", $idPedido, $idUsuario);
        $stmt->execute();

        return $stmt->get_result();
    }
}