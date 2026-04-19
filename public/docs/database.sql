-- ============================================
-- TABLA: roles
-- ============================================
CREATE TABLE roles (
    id_rol INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL UNIQUE,
    descripcion VARCHAR(150) NULL
);

-- ============================================
-- TABLA: usuarios
-- ============================================
CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    id_rol INT NOT NULL,
    estado ENUM('activo', 'inactivo') NOT NULL DEFAULT 'activo',
    fecha_creacion DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_rol) REFERENCES roles(id_rol)
);

-- ============================================
-- TABLA: categorias
-- ============================================
CREATE TABLE categorias (
    id_categoria INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL UNIQUE,
    descripcion TEXT NULL
);

-- ============================================
-- TABLA: productos
-- ============================================
CREATE TABLE productos (
    id_producto INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL,
    descripcion TEXT NULL,
    precio DECIMAL(10,2) NOT NULL,
    cantidad INT NOT NULL DEFAULT 0,
    imagen VARCHAR(255) NULL,
    id_categoria INT NOT NULL,
    estado ENUM('activo', 'inactivo', 'agotado') NOT NULL DEFAULT 'activo',
    fecha_creacion DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_categoria) REFERENCES categorias(id_categoria)
);

-- ============================================
-- TABLA: pedidos
-- ============================================
CREATE TABLE pedidos (
    id_pedido INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    fecha DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    total DECIMAL(10,2) NOT NULL,
    estado ENUM('enviado', 'procesando', 'entregado', 'cancelado') NOT NULL DEFAULT 'enviado',
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);

-- ============================================
-- TABLA: pedido_detalle
-- ============================================
CREATE TABLE pedido_detalle (
    id_detalle INT AUTO_INCREMENT PRIMARY KEY,
    id_pedido INT NOT NULL,
    id_producto INT NOT NULL,
    cantidad INT NOT NULL,
    precio_unitario DECIMAL(10,2) NOT NULL,
    subtotal DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (id_pedido) REFERENCES pedidos(id_pedido),
    FOREIGN KEY (id_producto) REFERENCES productos(id_producto)
);

-- ============================================
-- INSERTS INICIALES: roles
-- ============================================
INSERT INTO roles (nombre, descripcion) VALUES
('admin', 'Administrador del sistema'),
('cliente', 'Cliente de la tienda');

-- ============================================
-- INSERTS INICIALES: usuarios
-- NOTA:
-- Estas contraseñas son placeholders.
-- Luego debes reemplazarlas por hashes reales
-- generados con password_hash() desde PHP.
-- ============================================
INSERT INTO usuarios (nombre, apellidos, email, password, id_rol, estado) VALUES
('Admin', 'Principal', 'admin@ati.com', '$2y$12$6uGJqSejYJqzSqjhuc5YjeUbBdKLQSZVIyHqt0VYRRBeQ0dSI0r7W', 1, 'activo'),
('Juan', 'Pérez', 'juan@gmail.com', '$2y$12$CEDV4KCIncfEvLpH33zLRu8Pa.jdMBFJxJwIZmXjct46bCDCM.PiC', 2, 'activo'),
('María', 'López', 'maria@gmail.com', '$2y$12$Hyn8NwWoMQFV5VcdlUT/Xuhs7yMiLVv6IKjfmY7jqyYhRkjOpm9/W', 2, 'activo');

-- ============================================
-- INSERTS INICIALES: categorias
-- ============================================
INSERT INTO categorias (nombre, descripcion) VALUES
('Camisetas', 'Prendas superiores deportivas'),
('Pantalones', 'Pantalones deportivos y casuales'),
('Shorts', 'Shorts y pantalonetas deportivas'),
('Accesorios', 'Accesorios deportivos'),
('Calzado', 'Zapatos y tenis deportivos');

-- ============================================
-- INSERTS INICIALES: productos
-- ============================================
INSERT INTO productos (nombre, descripcion, precio, cantidad, imagen, id_categoria, estado) VALUES
('Camiseta Nike Dri-FIT', 'Camiseta deportiva liviana para entrenamiento', 18500.00, 10, 'camiseta_nike_drifit.jpg', 1, 'activo'),
('Camiseta Adidas Run', 'Camiseta transpirable para correr', 19900.00, 8, 'camiseta_adidas_run.jpg', 1, 'activo'),
('Pantalón Under Armour', 'Pantalón deportivo cómodo para gimnasio', 27500.00, 6, 'pantalon_underarmour.jpg', 2, 'activo'),
('Short Puma Active', 'Short deportivo de secado rápido', 14900.00, 12, 'short_puma_active.jpg', 3, 'activo'),
('Gorra Nike Club', 'Gorra ajustable deportiva', 9900.00, 15, 'gorra_nike_club.jpg', 4, 'activo'),
('Tennis Reebok Flex', 'Calzado deportivo para entrenamiento', 38900.00, 5, 'tennis_reebok_flex.jpg', 5, 'activo'),
('Short Básico Negro', 'Short deportivo básico color negro', 12500.00, 0, 'short_basico_negro.jpg', 3, 'agotado');

-- ============================================
-- INSERTS INICIALES: pedidos
-- ============================================
INSERT INTO pedidos (id_usuario, fecha, total, estado) VALUES
(2, NOW(), 38400.00, 'enviado'),
(3, NOW(), 19900.00, 'procesando');

-- ============================================
-- INSERTS INICIALES: pedido_detalle
-- ============================================
INSERT INTO pedido_detalle (id_pedido, id_producto, cantidad, precio_unitario, subtotal) VALUES
(1, 1, 1, 18500.00, 18500.00),
(1, 5, 2, 9900.00, 19800.00),
(2, 2, 1, 19900.00, 19900.00);