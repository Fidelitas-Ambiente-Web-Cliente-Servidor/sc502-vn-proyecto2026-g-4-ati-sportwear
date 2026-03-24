<?php
session_start();

$page = $_GET['page'] ?? 'home';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $option = $_POST['option'] ?? '';

}

switch ($page) {

    case 'home':
        require_once './app/controllers/HomeController.php';
        $controller = new HomeController();
        $controller->index();
        break;

    case 'catalogo':
        require_once './app/controllers/CatalogoController.php';
        $controller = new CatalogoController();
        $controller->index();
        break;

    default:
        echo "Página no encontrada";
        break;
}
