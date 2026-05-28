-- =============================================
--  BASE DE DATOS: portafolio
--  Ejecuta este archivo en phpMyAdmin
-- =============================================

CREATE DATABASE IF NOT EXISTS portafolio
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE portafolio;

-- Tabla de usuarios
CREATE TABLE IF NOT EXISTS usuarios (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    nombre      VARCHAR(100)  NOT NULL,
    correo      VARCHAR(150)  NOT NULL UNIQUE,
    password    VARCHAR(255)  NOT NULL,
    created_at  TIMESTAMP     DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de mensajes del formulario de contacto
CREATE TABLE IF NOT EXISTS mensajes (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id  INT           NOT NULL,
    nombre      VARCHAR(100)  NOT NULL,
    correo      VARCHAR(150)  NOT NULL,
    mensaje     TEXT          NOT NULL,
    created_at  TIMESTAMP     DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);
