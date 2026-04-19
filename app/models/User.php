<?php

class User
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getByEmail($email)
    {
        $stmt = $this->conn->prepare("SELECT 
                    u.id_usuario,
                    u.nombre,
                    u.apellidos,
                    u.email,
                    u.password,
                    u.estado,
                    r.nombre AS rol
                FROM usuarios u
                INNER JOIN roles r ON u.id_rol = r.id_rol
                WHERE u.email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function emailExists($email)
    {
        $stmt = $this->conn->prepare("SELECT id_usuario 
                FROM usuarios
                WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->num_rows > 0;
    }

    public function create($nombre, $apellidos, $email, $password, $idRol = 2)
    {
        $stmt = $this->conn->prepare("INSERT INTO usuarios
                    (nombre, apellidos, email, password, id_rol, estado)
                VALUES (?, ?, ?, ?, ?, 'activo')");
        $stmt->bind_param("ssssi", $nombre, $apellidos, $email, $password, $idRol);

        return $stmt->execute();
    }
}