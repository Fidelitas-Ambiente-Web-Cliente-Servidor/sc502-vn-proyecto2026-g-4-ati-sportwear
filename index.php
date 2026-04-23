<?php
session_start();

require_once './config/database.php';
require_once './app/controllers/HomeController.php';
require_once './app/controllers/UserController.php';
require_once './app/controllers/AdminController.php';
require_once './app/controllers/OrderController.php';

$page = $_GET['page'] ?? 'home';
$option = $_POST['option'] ?? ($_GET['option'] ?? '');

function isLoggedIn()
{
    return isset($_SESSION['user']);
}

function isAdmin()
{
    return isset($_SESSION['user']) && $_SESSION['user']['rol'] === 'admin';
}

// Rutas AJAX
if (!empty($option)) {

    switch ($option) {

        case 'login':
            $controller = new UserController();
            $controller->login();
            break;

        case 'register_user':
            $controller = new UserController();
            $controller->register();
            break;

        case 'logout':
            $controller = new UserController();
            $controller->logout();
            break;

        case 'admin_dashboard_view':
        case 'admin_productos_view':
        case 'admin_categorias_view':
        case 'admin_pedidos_view':
        case 'admin_usuarios_view':
        case 'admin_roles_view':
            if (!isAdmin()) {
                http_response_code(403);
                echo "Acceso denegado";
                exit;
            }

            $controller = new AdminController();

            switch ($option) {
                case 'admin_dashboard_view':
                    $controller->dashboardView();
                    break;

                case 'admin_productos_view':
                    $controller->productsView();
                    break;

                case 'admin_categorias_view':
                    $controller->categoriesView();
                    break;

                case 'admin_pedidos_view':
                    $controller->ordersView();
                    break;

                case 'admin_usuarios_view':
                    $controller->usersView();
                    break;

                case 'admin_roles_view':
                    $controller->rolesView();
                    break;
            }
            break;

        case 'dashboard_json':
            if (!isAdmin()) {
                header('Content-Type: application/json');
                echo json_encode([
                    'response' => '01',
                    'message' => 'Acceso denegado'
                ]);
                exit;
            }

            $controller = new AdminController();
            $controller->dashboardJson();
            break;

        case 'admin_usuarios_json':
        case 'cambiar_rol_usuario':
        case 'cambiar_estado_usuario':
        case 'usuario_detalle_json':
        case 'editar_usuario':
            if (!isAdmin()) {
                header('Content-Type: application/json');
                echo json_encode([
                    'response' => '01',
                    'message' => 'Acceso denegado'
                ]);
                exit;
            }

            $controller = new UserController();

            switch ($option) {
                case 'admin_usuarios_json':
                    $controller->getUsersJson();
                    break;

                case 'cambiar_rol_usuario':
                    $controller->changeRole();
                    break;

                case 'cambiar_estado_usuario':
                    $controller->changeStatus();
                    break;

                case 'usuario_detalle_json':
                    $controller->getUserDetailJson();
                    break;

                case 'editar_usuario':
                    $controller->updateUser();
                    break;
            }
            break;

        case 'admin_pedidos_json':
        case 'pedido_detalle_json':
        case 'cambiar_estado_pedido':
            if (!isAdmin()) {
                header('Content-Type: application/json');
                echo json_encode([
                    'response' => '01',
                    'message' => 'Acceso denegado'
                ]);
                exit;
            }

            $controller = new OrderController();

            switch ($option) {
                case 'admin_pedidos_json':
                    $controller->getAllOrdersJson();
                    break;

                case 'pedido_detalle_json':
                    $controller->getOrderDetailJson();
                    break;

                case 'cambiar_estado_pedido':
                    $controller->changeOrderStatus();
                    break;
            }
            break;

        default:
            header('Content-Type: application/json');
            echo json_encode([
                'response' => '01',
                'message' => 'Opción no válida'
            ]);
            break;
    }

    exit;
}

// Rutas normales
switch ($page) {

    case 'home':
        $controller = new HomeController();
        $controller->index();
        break;

    case 'login':
        if (isLoggedIn()) {
            if (isAdmin()) {
                header('Location: index.php?page=admin');
            } else {
                header('Location: index.php?page=home');
            }
            exit;
        }

        $controller = new UserController();
        $controller->loginView();
        break;

    case 'register':
        if (isLoggedIn()) {
            if (isAdmin()) {
                header('Location: index.php?page=admin');
            } else {
                header('Location: index.php?page=home');
            }
            exit;
        }

        $controller = new UserController();
        $controller->registerView();
        break;

    case 'admin':
        if (!isAdmin()) {
            header('Location: index.php?page=home');
            exit;
        }

        $controller = new AdminController();
        $controller->index();
        break;

    default:
        header('Location: index.php?page=home');
        exit;
}