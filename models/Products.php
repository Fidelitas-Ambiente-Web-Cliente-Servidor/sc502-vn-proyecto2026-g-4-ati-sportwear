<?php

class Products
{
    private $conn = null;
    private $productsTableExists = null;
    private $baseUrl = '/sc502-vn-proyecto2026-g-4-ati-sportwear';

    public function __construct()
    {
        mysqli_report(MYSQLI_REPORT_OFF);

        $connection = @new mysqli('localhost', 'root', '', 'ati_sportwear');

        if ($connection instanceof mysqli && !$connection->connect_error) {
            $connection->set_charset('utf8mb4');
            $this->conn = $connection;
        }
    }

    public function getProducts($search = '', $category = '')
    {
        $products = $this->fetchProducts();
        $normalizedSearch = $this->normalizeText($search);
        $normalizedCategory = $this->normalizeText($category);

        return array_values(array_filter($products, function ($product) use ($normalizedSearch, $normalizedCategory) {
            if ($normalizedCategory !== '' && $normalizedCategory !== 'todas') {
                if ($this->normalizeText($product['categoria']) !== $normalizedCategory) {
                    return false;
                }
            }

            if ($normalizedSearch === '') {
                return true;
            }

            $haystack = $this->normalizeText($product['nombre'] . ' ' . $product['descripcion'] . ' ' . $product['categoria']);

            return strpos($haystack, $normalizedSearch) !== false;
        }));
    }

    public function getProductById($productId)
    {
        foreach ($this->fetchProducts() as $product) {
            if ((int) $product['id'] === $productId) {
                return $product;
            }
        }

        return null;
    }

    public function getCategories()
    {
        $categories = ['Camisetas', 'Pantalones', 'Shorts', 'Accesorios'];

        foreach ($this->fetchProducts() as $product) {
            $category = trim((string) $product['categoria']);

            if ($category !== '') {
                $categories[] = $category;
            }
        }

        $uniqueCategories = [];

        foreach ($categories as $category) {
            $normalized = $this->normalizeText($category);

            if ($normalized === '' || isset($uniqueCategories[$normalized])) {
                continue;
            }

            $uniqueCategories[$normalized] = $category;
        }

        return array_values($uniqueCategories);
    }

    private function fetchProducts()
    {
        if ($this->hasProductsTable() && $this->conn instanceof mysqli) {
            $result = $this->conn->query('SELECT * FROM productos');

            if ($result instanceof mysqli_result) {
                $products = [];

                while ($row = $result->fetch_assoc()) {
                    $products[] = $this->normalizeProduct($row);
                }

                $result->free();

                if (!empty($products)) {
                    return $products;
                }
            }
        }

        return array_map(function ($product) {
            return $this->applyStatus($product);
        }, $this->fallbackProducts());
    }

    private function hasProductsTable()
    {
        if ($this->productsTableExists !== null) {
            return $this->productsTableExists;
        }

        if (!$this->conn instanceof mysqli) {
            $this->productsTableExists = false;
            return $this->productsTableExists;
        }

        $result = $this->conn->query("SHOW TABLES LIKE 'productos'");
        $this->productsTableExists = $result instanceof mysqli_result && $result->num_rows > 0;

        if ($result instanceof mysqli_result) {
            $result->free();
        }

        return $this->productsTableExists;
    }

    private function normalizeProduct(array $row)
    {
        $product = [
            'id' => (int) $this->getFirstValue($row, ['id_producto', 'producto_id', 'id'], 0),
            'nombre' => (string) $this->getFirstValue($row, ['nombre', 'name', 'titulo'], 'Producto ATI'),
            'descripcion' => (string) $this->getFirstValue(
                $row,
                ['descripcion', 'detalle', 'description'],
                'Producto disponible en el catalogo de ATI Sportwear.'
            ),
            'precio' => (int) $this->getFirstValue($row, ['precio', 'price'], 0),
            'stock' => (int) $this->getFirstValue($row, ['stock', 'cantidad', 'existencia'], 0),
            'categoria' => (string) $this->getFirstValue($row, ['categoria', 'categoria_nombre', 'nombre_categoria'], 'Catalogo'),
            'imagen' => $this->normalizeImagePath((string) $this->getFirstValue($row, ['imagen', 'imagen_url', 'foto'], '')),
            'estado' => (string) $this->getFirstValue($row, ['estado', 'status'], 'activo'),
        ];

        if ($product['id'] <= 0) {
            $product['id'] = random_int(1000, 999999);
        }

        return $this->applyStatus($product);
    }

    private function applyStatus(array $product)
    {
        $product['stock'] = max(0, (int) ($product['stock'] ?? 0));
        $product['estado'] = $product['stock'] === 0 ? 'agotado' : 'activo';
        $product['imagen'] = $this->normalizeImagePath((string) ($product['imagen'] ?? ''));

        return $product;
    }

    private function normalizeImagePath($image)
    {
        $trimmedImage = trim($image);

        if ($trimmedImage === '') {
            return $this->baseUrl . '/img/ati-negro.png';
        }

        if ($this->startsWith($trimmedImage, 'http://') || $this->startsWith($trimmedImage, 'https://') || $this->startsWith($trimmedImage, '/')) {
            return $trimmedImage;
        }

        if (strpos($trimmedImage, '/') !== false) {
            $normalizedImage = preg_replace('#^(\.\./|./)+#', '', $trimmedImage);
            return $this->baseUrl . '/' . ltrim($normalizedImage, '/');
        }

        return $this->baseUrl . '/img/' . ltrim($trimmedImage, '/');
    }

    private function getFirstValue(array $row, array $keys, $default = null)
    {
        foreach ($keys as $key) {
            if (array_key_exists($key, $row) && $row[$key] !== null && $row[$key] !== '') {
                return $row[$key];
            }
        }

        return $default;
    }

    private function normalizeText($value)
    {
        $value = trim($value);

        if ($value === '') {
            return '';
        }

        if (function_exists('iconv')) {
            $converted = @iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $value);

            if ($converted !== false) {
                $value = $converted;
            }
        }

        return strtolower($value);
    }

    private function fallbackProducts()
    {
        return [
            [
                'id' => 1,
                'nombre' => 'Camiseta deportiva',
                'descripcion' => 'Camiseta deportiva ATI con ilustracion frontal y tela comoda para entrenamiento.',
                'precio' => 12000,
                'stock' => 8,
                'categoria' => 'Camisetas',
                'imagen' => 'camisa_deportiva1.jpeg',
            ],
            [
                'id' => 2,
                'nombre' => 'Camiseta deportiva',
                'descripcion' => 'Camiseta negra Jungle Jiu Jitsu Costa Rica para uso diario o entrenamiento.',
                'precio' => 12000,
                'stock' => 6,
                'categoria' => 'Camisetas',
                'imagen' => 'camisa_deportiva2.jpg',
            ],
            [
                'id' => 3,
                'nombre' => 'Pantaloneta deportiva',
                'descripcion' => 'Pantaloneta ligera ATI para entrenamientos intensos y buena movilidad.',
                'precio' => 10000,
                'stock' => 4,
                'categoria' => 'Shorts',
                'imagen' => 'pantaloneta_deportiva.jpeg',
            ],
            [
                'id' => 4,
                'nombre' => 'Gorra',
                'descripcion' => 'Gorra ATI color oliva con ajuste comodo y logo bordado.',
                'precio' => 8000,
                'stock' => 5,
                'categoria' => 'Accesorios',
                'imagen' => 'gorra1.jpeg',
            ],
            [
                'id' => 5,
                'nombre' => 'Gorra',
                'descripcion' => 'Gorra ATI color beige ideal para uso casual.',
                'precio' => 8000,
                'stock' => 3,
                'categoria' => 'Accesorios',
                'imagen' => 'gorra2.jpeg',
            ],
            [
                'id' => 6,
                'nombre' => 'Camiseta training',
                'descripcion' => 'Camiseta training morada de manga corta para practica y competencia.',
                'precio' => 14000,
                'stock' => 7,
                'categoria' => 'Camisetas',
                'imagen' => 'camisa_training1.jpeg',
            ],
            [
                'id' => 7,
                'nombre' => 'Camiseta training',
                'descripcion' => 'Camiseta training azul con corte comodo y tela fresca.',
                'precio' => 15000,
                'stock' => 5,
                'categoria' => 'Camisetas',
                'imagen' => 'camisa_training2.jpeg',
            ],
            [
                'id' => 8,
                'nombre' => 'Camiseta training',
                'descripcion' => 'Camiseta training blanca con detalles negros para entrenamiento.',
                'precio' => 15000,
                'stock' => 2,
                'categoria' => 'Camisetas',
                'imagen' => 'camisa_training3.jpeg',
            ],
        ];
    }

    private function startsWith($value, $needle)
    {
        return substr($value, 0, strlen($needle)) === $needle;
    }
}
