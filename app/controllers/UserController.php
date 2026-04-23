<?php

require_once './config/database.php';
require_once './app/models/User.php';

class UserController
{
    private $model;

    public function __construct()
    {
        $database = new Database();
        $db = $database->connect();
        $this->model = new User($db);
    }

    public function loginView()
    {
        require_once './app/views/auth/login.php';
    }

    public function registerView()
    {
        require_once './app/views/auth/register.php';
    }

    public function login()
    {
        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if ($email == "" || $password == "") {
            echo json_encode([
                "response" => "01",
                "message" => "Debe completar todos los campos"
            ]);
            exit;
        }

        $user = $this->model->getByEmail($email);

        if (!$user) {
            echo json_encode([
                "response" => "01",
                "message" => "Credenciales incorrectas"
            ]);
            exit;
        }

        if ($user['estado'] != 'activo') {
            echo json_encode([
                "response" => "01",
                "message" => "Usuario inactivo"
            ]);
            exit;
        }

        if (!password_verify($password, $user['password'])) {
            echo json_encode([
                "response" => "01",
                "message" => "Credenciales incorrectas"
            ]);
            exit;
        }

        $_SESSION['user'] = [
            'id_usuario' => $user['id_usuario'],
            'nombre' => $user['nombre'],
            'email' => $user['email'],
            'rol' => $user['rol']
        ];

        echo json_encode([
            "response" => "00",
            "message" => "Login correcto",
            "rol" => $user['rol']
        ]);
        exit;
    }

    public function register()
    {
        $nombre = trim($_POST['nombre'] ?? '');
        $apellidos = trim($_POST['apellidos'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if ($nombre == "" || $apellidos == "" || $email == "" || $password == "") {
            echo json_encode([
                "response" => "01",
                "message" => "Debe completar todos los campos"
            ]);
            exit;
        }

        if ($this->model->emailExists($email)) {
            echo json_encode([
                "response" => "01",
                "message" => "El correo ya está registrado"
            ]);
            exit;
        }

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $result = $this->model->create($nombre, $apellidos, $email, $passwordHash);

        if ($result) {
            echo json_encode([
                "response" => "00",
                "message" => "Usuario registrado correctamente"
            ]);
        } else {
            echo json_encode([
                "response" => "01",
                "message" => "No se pudo registrar el usuario"
            ]);
        }

        exit;
    }

    public function logout()
    {
        session_destroy();
        header("Location: index.php?page=home");
        exit;
    }

    public function getUsersJson()
    {
        header('Content-Type: application/json');

        $users = $this->model->getAllAdmin();

        echo json_encode([
            'response' => '00',
            'data' => $users,
            'roles' => $this->model->getRoles()
        ]);
        exit;
    }

    public function getUserDetailJson()
    {
        header('Content-Type: application/json');

        $idUsuario = intval($_POST['id_usuario'] ?? 0);

        if ($idUsuario <= 0) {
            echo json_encode([
                'response' => '01',
                'message' => 'Usuario inválido'
            ]);
            exit;
        }

        $user = $this->model->getById($idUsuario);

        if (!$user) {
            echo json_encode([
                'response' => '01',
                'message' => 'Usuario no encontrado'
            ]);
            exit;
        }

        echo json_encode([
            'response' => '00',
            'user' => $user,
            'roles' => $this->model->getRoles()
        ]);
        exit;
    }

    public function updateUser()
    {
        header('Content-Type: application/json');

        $idUsuario = intval($_POST['id_usuario'] ?? 0);
        $nombre = trim($_POST['nombre'] ?? '');
        $apellidos = trim($_POST['apellidos'] ?? '');
        $email = trim($_POST['email'] ?? '');

        if ($idUsuario <= 0 || $nombre === '' || $apellidos === '' || $email === '') {
            echo json_encode([
                'response' => '01',
                'message' => 'Debe completar todos los campos'
            ]);
            exit;
        }

        $result = $this->model->updateAdmin($idUsuario, $nombre, $apellidos, $email);

        if ($result) {
            echo json_encode([
                'response' => '00',
                'message' => 'Usuario actualizado correctamente'
            ]);
        } else {
            echo json_encode([
                'response' => '01',
                'message' => 'No se pudo actualizar el usuario'
            ]);
        }

        exit;
    }

    public function changeRole()
    {
        header('Content-Type: application/json');

        $idUsuario = intval($_POST['id_usuario'] ?? 0);
        $idRol = intval($_POST['id_rol'] ?? 0);

        if ($idUsuario <= 0 || $idRol <= 0) {
            echo json_encode([
                'response' => '01',
                'message' => 'Datos inválidos'
            ]);
            exit;
        }

        $result = $this->model->changeRole($idUsuario, $idRol);

        if ($result) {
            echo json_encode([
                'response' => '00',
                'message' => 'Rol actualizado correctamente'
            ]);
        } else {
            echo json_encode([
                'response' => '01',
                'message' => 'No se pudo actualizar el rol'
            ]);
        }

        exit;
    }

    public function changeStatus()
    {
        header('Content-Type: application/json');

        $idUsuario = intval($_POST['id_usuario'] ?? 0);
        $estado = trim($_POST['estado'] ?? '');

        if ($idUsuario <= 0 || !in_array($estado, ['activo', 'inactivo'])) {
            echo json_encode([
                'response' => '01',
                'message' => 'Datos inválidos'
            ]);
            exit;
        }

        $result = $this->model->changeStatus($idUsuario, $estado);

        if ($result) {
            echo json_encode([
                'response' => '00',
                'message' => 'Estado actualizado correctamente'
            ]);
        } else {
            echo json_encode([
                'response' => '01',
                'message' => 'No se pudo actualizar el estado'
            ]);
        }

        exit;
    }
}