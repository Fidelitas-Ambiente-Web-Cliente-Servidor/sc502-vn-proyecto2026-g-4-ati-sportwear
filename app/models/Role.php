<?php

class Role
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll()
    {
        $stmt = $this->conn->prepare("SELECT id_rol, nombre, descripcion
            FROM roles
            ORDER BY id_rol");

        $stmt->execute();

        return $stmt->get_result();
    }

    public function getById($id)
    {
        $stmt = $this->conn->prepare("SELECT id_rol, nombre, descripcion
        FROM roles
        WHERE id_rol = ?");

        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function create($nombre, $descripcion)
    {
        $stmt = $this->conn->prepare("INSERT INTO roles
            (nombre, descripcion)
        VALUES (?, ?)");

        $stmt->bind_param("ss", $nombre, $descripcion);

        return $stmt->execute();
    }

    public function update($id, $nombre, $descripcion)
    {
        $stmt = $this->conn->prepare("UPDATE roles
        SET nombre = ?,
            descripcion = ?
        WHERE id_rol = ?");

        $stmt->bind_param("ssi", $nombre, $descripcion, $id);

        return $stmt->execute();
    }

    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM roles WHERE id_rol = ?");
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }
}