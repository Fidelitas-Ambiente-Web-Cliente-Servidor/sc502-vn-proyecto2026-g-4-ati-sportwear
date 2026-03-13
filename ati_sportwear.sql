CREATE DATABASE ati_sportwear;


USE ati_sportwear;


CREATE TABLE roles (
    id_rol INT AUTO_INCREMENT PRIMARY KEY,
    nombre_rol VARCHAR(50) NOT NULL
);


INSERT INTO roles (nombre_rol) VALUES
('admin'),
('cliente');


CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    rol_id INT,
    FOREIGN KEY (rol_id) REFERENCES roles(id_rol)
);

INSERT INTO usuarios (nombre, email, password, rol_id)
VALUES ('Administrador', 'admin@ati.com', '123456', 1);
