-- ============================================
-- RESET COMPLETO
-- ============================================
SET FOREIGN_KEY_CHECKS = 0;
 
DROP TABLE IF EXISTS pedido_detalle;
DROP TABLE IF EXISTS pedidos;
DROP TABLE IF EXISTS productos;
DROP TABLE IF EXISTS categorias;
DROP TABLE IF EXISTS usuarios;
DROP TABLE IF EXISTS roles;
 
SET FOREIGN_KEY_CHECKS = 1;
 
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
    estado ENUM('enviado', 'procesando', 'entregado', 'cancelado') NOT NULL DEFAULT 'procesando',
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
-- INSERTS: roles
-- ============================================
INSERT INTO roles (nombre, descripcion) VALUES
('admin', 'Administrador del sistema'),
('cliente', 'Cliente de la tienda');
 
-- ============================================
-- INSERTS: usuarios (con hash real)
-- ============================================
INSERT INTO usuarios (nombre, apellidos, email, password, id_rol, estado) VALUES
('Admin', 'Principal', 'admin@ati.com', '$2y$10$SuHuZtNLovaDOBXmtQPxmOBFaE2b.52Kjfx2GWmyzxjOExjCNTplO', 1, 'activo'),
('Juan', 'Pérez', 'juan@gmail.com', '$2y$10$1c9CQYntgI8JZ24x4fWoauYrb9jn27GB6WQurE0v.Cy70u4g86hGC', 2, 'activo'),
('María', 'López', 'maria@gmail.com', '$2y$10$RNlRtukrc7ES2cv8cDomK.LFMqO2Vupr0gOQKR57.M6.CY/A1FG4C', 2, 'activo');
 
-- ============================================
-- INSERTS: categorias
-- ============================================
INSERT INTO categorias (nombre, descripcion) VALUES
('Rashguards', 'Camiseta técnica de alto rendimiento'),
('Rashguards Personalizados', 'Rashguards personalizados'),
('Pantalonetas', 'Shorts para entrenamiento'),
('Gorras', 'Accesorios deportivos');
 
-- ============================================
-- INSERTS: productos
-- ============================================
INSERT INTO productos (nombre, descripcion, precio, cantidad, imagen, id_categoria, estado) VALUES
('Rashguard ATI', 'Rashguard liviano para entrenamiento.', 18500.00, 10, 'rashguard_ati.jpeg', 1, 'activo'),
('Rashguard JungleMat', 'Rashguard del partner JungleMat.', 19900.00, 8, 'rashguard_junglemat.jpg', 1, 'activo'),
('Rashguard Personalizado 1', 'Rashguard morado/blanco.', 22500.00, 6, 'rashguard_personal1.jpeg', 2, 'activo'),
('Rashguard Personalizado 2', 'Rashguard azul/blanco.', 22500.00, 3, 'rashguard_personal2.jpeg', 2, 'activo'),
('Rashguard Personalizado 3', 'Rashguard negro/blanco.', 22500.00, 1, 'rashguard_personal3.jpeg', 2, 'activo'),
('Pantaloneta ATI', 'Pantaloneta para entrenamiento.', 17900.00, 5, 'pantaloneta.jpeg', 3, 'activo'),
('Gorra ATI Verde', 'Gorra color verde oliva.', 12500.00, 0, 'gorra1.jpeg', 4, 'agotado'),
('Gorra ATI Beige', 'Gorra color beige.', 12500.00, 3, 'gorra2.jpeg', 4, 'activo');
 
-- ============================================
-- INSERTS: pedidos (CORREGIDOS)
-- ============================================
INSERT INTO pedidos (id_usuario, fecha, total, estado) VALUES
(2, NOW(), 63500.00, 'enviado'),
(3, NOW(), 19900.00, 'procesando');
 
-- ============================================
-- INSERTS: pedido_detalle (CORREGIDOS)
-- ============================================
INSERT INTO pedido_detalle (id_pedido, id_producto, cantidad, precio_unitario, subtotal) VALUES
(1, 1, 1, 18500.00, 18500.00),
(1, 5, 2, 22500.00, 45000.00),
(2, 2, 1, 19900.00, 19900.00);