<?php

class Order
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function countAll()
    {
        $sql = "SELECT COUNT(*) AS total FROM pedidos";
        $result = $this->conn->query($sql);
        return $result->fetch_assoc()['total'] ?? 0;
    }

    public function countByStatus($estado)
    {
        $stmt = $this->conn->prepare("SELECT COUNT(*) AS total FROM pedidos WHERE estado = ?");
        $stmt->bind_param("s", $estado);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc()['total'] ?? 0;
    }

    public function getAllAdmin()
    {
        $sql = "SELECT 
                    p.id_pedido,
                    p.fecha,
                    p.total,
                    p.estado,
                    u.nombre,
                    u.apellidos,
                    u.email
                FROM pedidos p
                INNER JOIN usuarios u ON p.id_usuario = u.id_usuario
                ORDER BY p.id_pedido DESC";

        $result = $this->conn->query($sql);

        $orders = [];
        while ($row = $result->fetch_assoc()) {
            $orders[] = $row;
        }

        return $orders;
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

    public function getDetail($idPedido)
    {
        $stmt = $this->conn->prepare("SELECT 
                    pd.id_detalle,
                    pd.id_producto,
                    pd.cantidad,
                    pd.precio_unitario,
                    pd.subtotal,
                    pr.nombre AS producto
                FROM pedido_detalle pd
                INNER JOIN productos pr ON pd.id_producto = pr.id_producto
                WHERE pd.id_pedido = ?");

        $stmt->bind_param("i", $idPedido);
        $stmt->execute();
        $result = $stmt->get_result();

        $details = [];
        while ($row = $result->fetch_assoc()) {
            $details[] = $row;
        }

        return $details;
    }

    public function changeStatus($idPedido, $estado)
    {
        $stmt = $this->conn->prepare("UPDATE pedidos SET estado = ? WHERE id_pedido = ?");
        $stmt->bind_param("si", $estado, $idPedido);
        return $stmt->execute();
    }
}