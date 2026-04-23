<?php
<<<<<<< Updated upstream
$action = $_GET['action'] ?? $_POST['action'] ?? null;

if ($action !== null) {
    require_once __DIR__ . '/controllers/ProductController.php';

    switch ($action) {
=======
session_start();
 
require_once './config/database.php';
require_once './app/controllers/HomeController.php';
require_once './app/controllers/UserController.php';
require_once './app/controllers/ProductController.php';
require_once './app/controllers/CategoryController.php';
//require_once './app/controllers/CartController.php';
//require_once './app/controllers/OrderController.php';
//require_once './app/controllers/RoleController.php';
require_once './app/controllers/AdminController.php';
 
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
 
>>>>>>> Stashed changes
        case 'productos_json':
            $controller = new ProductController();
            $controller->getProductsJson();
            break;
 
        case 'categorias_json':
            $controller = new CategoryController();
            $controller->getAllJson();
            break;
 
        case 'producto_detalle_json':
            $controller = new ProductController();
            $controller->getProductDetailJson();
            break;
<<<<<<< Updated upstream

        case 'agregar_carrito_json':
            $controller = new ProductController();
            $controller->addToCartJson();
=======
 
        case 'agregar_carrito':
            $controller = new CartController();
            $controller->addToCart();
            break;
 
        case 'carrito_json':
            $controller = new CartController();
            $controller->getCartJson();
            break;
 
        case 'actualizar_carrito':
            $controller = new CartController();
            $controller->updateCart();
            break;
 
        case 'eliminar_producto_carrito':
            $controller = new CartController();
            $controller->removeFromCart();
            break;
 
        case 'vaciar_carrito':
            $controller = new CartController();
            $controller->clearCart();
            break;
 
        case 'finalizar_compra':
            if (!isLoggedIn()) {
                header('Content-Type: application/json');
                echo json_encode([
                    'response' => '01',
                    'message' => 'Debe iniciar sesión para finalizar la compra'
                ]);
                exit;
            }
 
            $controller = new OrderController();
            $controller->checkout();
            break;
 
        case 'mis_pedidos_json':
            if (!isLoggedIn()) {
                header('Content-Type: application/json');
                echo json_encode([
                    'response' => '01',
                    'message' => 'Sesión no válida'
                ]);
                exit;
            }
 
            $controller = new OrderController();
            $controller->getMyOrdersJson();
            break;
 
        case 'mi_pedido_detalle_json':
            if (!isLoggedIn()) {
                header('Content-Type: application/json');
                echo json_encode([
                    'response' => '01',
                    'message' => 'Sesión no válida'
                ]);
                exit;
            }
 
            $controller = new OrderController();
            $controller->getMyOrderDetailJson();
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
 
        case 'admin_productos_json':
        case 'crear_producto':
        case 'editar_producto':
        case 'cambiar_estado_producto':
        case 'producto_admin_detalle':
        case 'eliminar_producto':
            if (!isAdmin()) {
                header('Content-Type: application/json');
                echo json_encode([
                    'response' => '01',
                    'message' => 'Acceso denegado'
                ]);
                exit;
            }
 
            $controller = new ProductController();
 
            switch ($option) {
                case 'admin_productos_json':
                    $controller->getAdminProductsJson();
                    break;
 
                case 'crear_producto':
                    $controller->create();
                    break;
 
                case 'editar_producto':
                    $controller->update();
                    break;
 
                case 'cambiar_estado_producto':
                    $controller->changeStatus();
                    break;
 
                case 'producto_admin_detalle':
                    $controller->getAdminProductDetail();
                    break;
 
                case 'eliminar_producto':
                    $controller->delete();
                    break;
            }
            break;
 
        case 'admin_categorias_json':
        case 'crear_categoria':
        case 'editar_categoria':
        case 'eliminar_categoria':
            if (!isAdmin()) {
                header('Content-Type: application/json');
                echo json_encode([
                    'response' => '01',
                    'message' => 'Acceso denegado'
                ]);
                exit;
            }
 
            $controller = new CategoryController();
 
            switch ($option) {
                case 'admin_categorias_json':
                    $controller->getAllJson();
                    break;
 
                case 'crear_categoria':
                    $controller->create();
                    break;
 
                case 'editar_categoria':
                    $controller->update();
                    break;
 
                case 'eliminar_categoria':
                    $controller->delete();
                    break;
            }
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
 
        case 'admin_roles_json':
        case 'crear_rol':
        case 'editar_rol':
        case 'eliminar_rol':
        case 'rol_detalle_json':
            if (!isAdmin()) {
                header('Content-Type: application/json');
                echo json_encode([
                    'response' => '01',
                    'message' => 'Acceso denegado'
                ]);
                exit;
            }
 
            $controller = new RoleController();
 
            switch ($option) {
                case 'admin_roles_json':
                    $controller->getAllJson();
                    break;
 
                case 'crear_rol':
                    $controller->create();
                    break;
 
                case 'editar_rol':
                    $controller->update();
                    break;
 
                case 'eliminar_rol':
                    $controller->delete();
                    break;
 
                case 'rol_detalle_json':
                    $controller->getRoleDetailJson();
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
>>>>>>> Stashed changes
            break;
 
        default:
            header('Content-Type: application/json; charset=UTF-8');
            http_response_code(404);
            echo json_encode([
                'ok' => false,
                'message' => 'Accion no encontrada.',
            ], JSON_UNESCAPED_UNICODE);
            exit;
    }
<<<<<<< Updated upstream
}
?>
<!DOCTYPE html>
<html lang="es">

<?php include "fragmentos/head.php"; ?>

<body>
    <?php include "fragmentos/header.php"; ?>

    <section class="landing">

        <div class="landing-contenido">

            <h1>ATI SPORTWEAR</h1>
            <p>Discipline · Precision · Power</p>

            <a href="catalogo/catalogo.php" class="btn btn-dark btn-lg">
                Ver Catalogo
            </a>

        </div>

    </section>


    <?php include "fragmentos/footer.php"; ?>

</body>

</html>
=======
 
    exit;
}
 
switch ($page) {
 
    case 'home':
        $controller = new HomeController();
        $controller->index();
        break;
 
    case 'catalogo':
        $controller = new ProductController();
        $controller->index();
        break;
 
    case 'producto':
        $controller = new ProductController();
        $controller->detail();
        break;
 
    case 'carrito':
        $controller = new CartController();
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
 
    case 'mis_pedidos':
        if (!isLoggedIn()) {
            header('Location: index.php?page=login');
            exit;
        }
 
        $controller = new OrderController();
        $controller->myOrdersView();
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
>>>>>>> Stashed changes
