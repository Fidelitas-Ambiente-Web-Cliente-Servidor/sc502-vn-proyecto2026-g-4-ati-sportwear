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
                    u.id_rol,
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
        $stmt = $this->conn->prepare("SELECT id_usuario FROM usuarios WHERE email = ?");
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

    public function getAllAdmin()
    {
        $sql = "SELECT 
                    u.id_usuario,
                    u.nombre,
                    u.apellidos,
                    u.email,
                    u.estado,
                    u.id_rol,
                    r.nombre AS rol
                FROM usuarios u
                INNER JOIN roles r ON u.id_rol = r.id_rol
                ORDER BY u.id_usuario DESC";

        $result = $this->conn->query($sql);

        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }

        return $users;
    }

    public function getById($idUsuario)
    {
        $stmt = $this->conn->prepare("SELECT 
                    id_usuario,
                    nombre,
                    apellidos,
                    email,
                    estado,
                    id_rol
                FROM usuarios
                WHERE id_usuario = ?");

        $stmt->bind_param("i", $idUsuario);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function updateAdmin($idUsuario, $nombre, $apellidos, $email)
    {
        $stmt = $this->conn->prepare("UPDATE usuarios
                SET nombre = ?, apellidos = ?, email = ?
                WHERE id_usuario = ?");
        $stmt->bind_param("sssi", $nombre, $apellidos, $email, $idUsuario);

        return $stmt->execute();
    }

    public function changeRole($idUsuario, $idRol)
    {
        $stmt = $this->conn->prepare("UPDATE usuarios SET id_rol = ? WHERE id_usuario = ?");
        $stmt->bind_param("ii", $idRol, $idUsuario);

        return $stmt->execute();
    }

    public function changeStatus($idUsuario, $estado)
    {
        $stmt = $this->conn->prepare("UPDATE usuarios SET estado = ? WHERE id_usuario = ?");
        $stmt->bind_param("si", $estado, $idUsuario);

        return $stmt->execute();
    }

    public function getRoles()
    {
        $sql = "SELECT id_rol, nombre FROM roles ORDER BY id_rol ASC";
        $result = $this->conn->query($sql);

        $roles = [];
        while ($row = $result->fetch_assoc()) {
            $roles[] = $row;
        }

        return $roles;
    }
}