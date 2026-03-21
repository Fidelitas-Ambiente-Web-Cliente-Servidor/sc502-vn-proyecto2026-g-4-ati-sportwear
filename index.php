<?php
session_start();

/*require_once 'app/controllers/UserController.php';*/

$page = $_GET['page'] ?? 'home';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $option = $_POST['option'] ?? '';

    switch ($option) {
        
    }
}

// Switch para mostrar vistas que no vienen de POST.
switch ($page) {

    default:
        require_once './app/views/index.php';
        break;
}
