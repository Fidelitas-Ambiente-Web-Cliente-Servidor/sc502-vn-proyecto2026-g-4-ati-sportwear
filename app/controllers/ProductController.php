<?php

require_once './config/database.php';
require_once './app/models/Product.php';

class ProductController
{
    private $model;

    public function __construct()
    {
        $database = new Database();
        $db = $database->connect();
        $this->model = new Product($db);
    }

    public function index()
    {
        require_once './app/views/products/catalogo.php';
    }

    public function getProductsJson()
    {
        $search = trim($_GET['search'] ?? '');
        $category = trim($_GET['category'] ?? '');

        $result = $this->model->getAll($search, $category);

        $products = [];

        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }

        echo json_encode($products);
        exit;
    }

    public function detail()
    {
        $id = $_GET['id'] ?? 0;

        $product = $this->model->getById($id);

        require_once './app/views/products/detail.php';
    }

    public function getAdminProductsJson()
    {
        $result = $this->model->getAllAdmin();

        $products = [];

        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }

        echo json_encode($products);
        exit;
    }

    public function getAdminProductDetail()
    {
        $id = $_GET['id'] ?? 0;

        $product = $this->model->getByIdAdmin($id);

        echo json_encode($product);
        exit;
    }

    public function create()
    {
        $nombre = trim($_POST['nombre'] ?? '');
        $descripcion = trim($_POST['descripcion'] ?? '');
        $precio = $_POST['precio'] ?? 0;
        $cantidad = $_POST['cantidad'] ?? 0;
        $imagen = trim($_POST['imagen'] ?? '');
        $idCategoria = $_POST['id_categoria'] ?? 0;
        $estado = $_POST['estado'] ?? 'activo';

        if ($nombre == '' || $descripcion == '' || $precio == '' || $cantidad == '' || $imagen == '' || $idCategoria == '') {
            echo json_encode([
                'response' => '01',
                'message' => 'Debe completar todos los campos'
            ]);
            exit;
        }

        $result = $this->model->create($nombre, $descripcion, $precio, $cantidad, $imagen, $idCategoria, $estado);

        if ($result) {
            echo json_encode([
                'response' => '00',
                'message' => 'Producto creado correctamente'
            ]);
        } else {
            echo json_encode([
                'response' => '01',
                'message' => 'No se pudo crear el producto'
            ]);
        }

        exit;
    }

    public function update()
    {
        $id = $_POST['id_producto'] ?? 0;
        $nombre = trim($_POST['nombre'] ?? '');
        $descripcion = trim($_POST['descripcion'] ?? '');
        $precio = $_POST['precio'] ?? 0;
        $cantidad = $_POST['cantidad'] ?? 0;
        $imagen = trim($_POST['imagen'] ?? '');
        $idCategoria = $_POST['id_categoria'] ?? 0;
        $estado = $_POST['estado'] ?? 'activo';

        if ($id == 0 || $nombre == '' || $descripcion == '' || $precio == '' || $cantidad == '' || $imagen == '' || $idCategoria == '') {
            echo json_encode([
                'response' => '01',
                'message' => 'Debe completar todos los campos'
            ]);
            exit;
        }

        $result = $this->model->update($id, $nombre, $descripcion, $precio, $cantidad, $imagen, $idCategoria, $estado);

        if ($result) {
            echo json_encode([
                'response' => '00',
                'message' => 'Producto actualizado correctamente'
            ]);
        } else {
            echo json_encode([
                'response' => '01',
                'message' => 'No se pudo actualizar el producto'
            ]);
        }

        exit;
    }

    public function delete()
    {
        $id = $_POST['id_producto'] ?? 0;

        if ($id == 0) {
            echo json_encode([
                'response' => '01',
                'message' => 'Producto no válido'
            ]);
            exit;
        }

        $result = $this->model->delete($id);

        if ($result) {
            echo json_encode([
                'response' => '00',
                'message' => 'Producto eliminado correctamente'
            ]);
        } else {
            echo json_encode([
                'response' => '01',
                'message' => 'No se pudo eliminar el producto. Puede estar asociado a un pedido.'
            ]);
        }

        exit;
    }
}