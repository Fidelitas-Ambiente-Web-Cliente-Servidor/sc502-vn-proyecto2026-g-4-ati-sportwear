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
        $stmt = $this->conn->prepare("SELECT 
            u.id_usuario,
            u.nombre,
            u.apellidos,
            u.email,
            u.estado,
            u.id_rol,
            r.nombre AS rol
        FROM usuarios u
        INNER JOIN roles r ON u.id_rol = r.id_rol
        ORDER BY u.id_usuario");

        $stmt->execute();

        return $stmt->get_result();
    }

    public function getById($id)
    {
        $stmt = $this->conn->prepare("SELECT 
            id_usuario,
            nombre,
            apellidos,
            email,
            id_rol,
            estado
        FROM usuarios
        WHERE id_usuario = ?");

        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function updateAdmin($id, $nombre, $apellidos, $email, $idRol, $estado)
    {
        $stmt = $this->conn->prepare("UPDATE usuarios
        SET nombre = ?,
            apellidos = ?,
            email = ?,
            id_rol = ?,
            estado = ?
        WHERE id_usuario = ?");

        $stmt->bind_param("sssisi", $nombre, $apellidos, $email, $idRol, $estado, $id);

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

    public function createAdmin($nombre, $apellidos, $email, $password, $idRol, $estado)
    {
        $stmt = $this->conn->prepare("INSERT INTO usuarios
            (nombre, apellidos, email, password, id_rol, estado)
        VALUES (?, ?, ?, ?, ?, ?)");

        $stmt->bind_param("ssssis", $nombre, $apellidos, $email, $password, $idRol, $estado);

        return $stmt->execute();
    }

    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM usuarios WHERE id_usuario = ?");
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }

    public function countAll()
    {
        $stmt = $this->conn->prepare("SELECT COUNT(*) AS total FROM usuarios");
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return $row['total'];
    }
}