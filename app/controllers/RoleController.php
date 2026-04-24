<?php

require_once './config/database.php';
require_once './app/models/Role.php';

class RoleController
{
    private $model;

    public function __construct()
    {
        $database = new Database();
        $db = $database->connect();
        $this->model = new Role($db);
    }

    public function getAllJson()
    {
        $result = $this->model->getAll();

        $roles = [];

        while ($row = $result->fetch_assoc()) {
            $roles[] = $row;
        }

        echo json_encode($roles);
        exit;
    }

    public function getRoleDetailJson()
    {
        $id = $_GET['id'] ?? 0;

        $role = $this->model->getById($id);

        echo json_encode($role);
        exit;
    }

    public function create()
    {
        $nombre = trim($_POST['nombre'] ?? '');
        $descripcion = trim($_POST['descripcion'] ?? '');

        if ($nombre == '' || $descripcion == '') {
            echo json_encode([
                'response' => '01',
                'message' => 'Debe completar todos los campos'
            ]);
            exit;
        }

        $result = $this->model->create($nombre, $descripcion);

        if ($result) {
            echo json_encode([
                'response' => '00',
                'message' => 'Rol creado correctamente'
            ]);
        } else {
            echo json_encode([
                'response' => '01',
                'message' => 'No se pudo crear el rol'
            ]);
        }

        exit;
    }

    public function update()
    {
        $id = $_POST['id_rol'] ?? 0;
        $nombre = trim($_POST['nombre'] ?? '');
        $descripcion = trim($_POST['descripcion'] ?? '');

        if ($id == 0 || $nombre == '' || $descripcion == '') {
            echo json_encode([
                'response' => '01',
                'message' => 'Debe completar todos los campos'
            ]);
            exit;
        }

        $result = $this->model->update($id, $nombre, $descripcion);

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

    public function delete()
    {
        $id = $_POST['id_rol'] ?? 0;

        if ($id == 0) {
            echo json_encode([
                'response' => '01',
                'message' => 'Rol no válido'
            ]);
            exit;
        }

        $result = $this->model->delete($id);

        if ($result) {
            echo json_encode([
                'response' => '00',
                'message' => 'Rol eliminado correctamente'
            ]);
        } else {
            echo json_encode([
                'response' => '01',
                'message' => 'No se pudo eliminar el rol. Puede estar asociado a usuarios.'
            ]);
        }

        exit;
    }
}