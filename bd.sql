-- --------------------------------------------------------
-- Base de datos: MISTER_PC_BOTEO
-- --------------------------------------------------------
CREATE DATABASE IF NOT EXISTS MISTER_PC_BOTEO;
USE MISTER_PC_BOTEO;

-- --------------------------------------------------------
-- Tabla Cargo
-- --------------------------------------------------------
CREATE TABLE CARGO (
    CargoId BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Cargo VARCHAR(100) UNIQUE
);

-- --------------------------------------------------------
-- Tabla Empleado (todos los empleados)
-- --------------------------------------------------------
CREATE TABLE EMPLEADO (
    EmpleadoId BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(150) NOT NULL,
    Telefono VARCHAR(40),
    DUI VARCHAR(20) UNIQUE NOT NULL,
    Direccion VARCHAR(255),
    CargoId BIGINT UNSIGNED,
    Estado TINYINT(1) NOT NULL DEFAULT 1,
    FechaCreacion DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_empleado_cargo FOREIGN KEY (CargoId) REFERENCES CARGO(CargoId)
);

-- --------------------------------------------------------
-- Tabla Usuario (solo empleados con acceso al sistema)
-- --------------------------------------------------------
CREATE TABLE USUARIO (
    UsuarioId BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    EmpleadoId BIGINT UNSIGNED NOT NULL,
    Email VARCHAR(190) NOT NULL UNIQUE,
    Clave VARCHAR(255) NOT NULL,
    Rol ENUM('admin','tecnico') NOT NULL DEFAULT 'tecnico',
    Estado TINYINT(1) NOT NULL DEFAULT 1,
    FechaCreacion DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_usuario_empleado FOREIGN KEY (EmpleadoId) REFERENCES EMPLEADO(EmpleadoId) ON DELETE CASCADE
);

-- --------------------------------------------------------
-- Tabla Cliente
-- --------------------------------------------------------
CREATE TABLE CLIENTE (
    ClienteId BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(150) NOT NULL,
    Telefono VARCHAR(40),
    Email VARCHAR(190) UNIQUE,
    Direccion VARCHAR(255),
    Estado TINYINT(1) NOT NULL DEFAULT 1,
    FechaCreacion DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- --------------------------------------------------------
-- Tabla CategoriaProducto
-- --------------------------------------------------------
CREATE TABLE CATEGORIA_PRODUCTO (
    CategoriaId BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Categoria VARCHAR(120) NOT NULL UNIQUE,
    Estado TINYINT(1) NOT NULL DEFAULT 1
);

-- --------------------------------------------------------
-- Tabla Proveedor
-- --------------------------------------------------------
CREATE TABLE PROVEEDOR (
    ProveedorId BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Proveedor VARCHAR(150) NOT NULL UNIQUE,
    Telefono VARCHAR(40),
    Email VARCHAR(120) UNIQUE,
    Direccion VARCHAR(255),
    Estado TINYINT(1) NOT NULL DEFAULT 1
);

-- --------------------------------------------------------
-- Tabla Producto
-- --------------------------------------------------------
CREATE TABLE PRODUCTO (
    ProductoId BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Producto VARCHAR(180) NOT NULL,
    Marca VARCHAR(120),
    Precio DECIMAL(12,2) NOT NULL DEFAULT 0.00,
    CategoriaId BIGINT UNSIGNED NOT NULL,
    ProveedorId BIGINT UNSIGNED NOT NULL,
    Stock INT NOT NULL DEFAULT 0,
    TipoPresentacion VARCHAR(50) NOT NULL,
    UnidadesPresentacion INT,
    Imagen VARCHAR(500),
    Estado TINYINT(1) NOT NULL DEFAULT 1,
    FechaCreacion DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    Destacado TINYINT(1) DEFAULT 0,
    CONSTRAINT fk_producto_categoria FOREIGN KEY (CategoriaId) REFERENCES CATEGORIA_PRODUCTO(CategoriaId),
    CONSTRAINT fk_producto_proveedor FOREIGN KEY (ProveedorId) REFERENCES PROVEEDOR(ProveedorId)
);

-- --------------------------------------------------------
-- Tabla Equipo
-- --------------------------------------------------------
CREATE TABLE EQUIPO (
    EquipoId BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    ClienteId BIGINT UNSIGNED NOT NULL,
    TecnicoId BIGINT UNSIGNED,
    NombreEquipo VARCHAR(120) NOT NULL,
    Marca VARCHAR(120),
    Modelo VARCHAR(120),
    NumeroSerie VARCHAR(120),
    EstadoEquipo ENUM('no iniciado','en proceso','finalizado','entregado') NOT NULL DEFAULT 'no iniciado',
    TipoProblema ENUM('hardware','software','ambos') NOT NULL DEFAULT 'hardware',
    Activo TINYINT(1) NOT NULL DEFAULT 1,
    FechaIngreso DATE NOT NULL,
    FechaFinalizacion DATE,
    CONSTRAINT fk_equipo_cliente FOREIGN KEY (ClienteId) REFERENCES CLIENTE(ClienteId),
    CONSTRAINT fk_equipo_tecnico FOREIGN KEY (TecnicoId) REFERENCES USUARIO(UsuarioId)
);

-- --------------------------------------------------------
-- Tabla DetalleEquipo (historial de componentes por equipo)
-- --------------------------------------------------------
CREATE TABLE DETALLE_EQUIPO (
    DetalleEquipoId BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    EquipoId BIGINT UNSIGNED NOT NULL,
    SoNombre VARCHAR(120),
    SoVersion VARCHAR(50),
    SoArquitectura VARCHAR(20),
    CpuMarca VARCHAR(120),
    CpuModelo VARCHAR(120),
    CpuVelocidad VARCHAR(50),
    RamTipo VARCHAR(50),
    RamCapacidad VARCHAR(50),
    RamVelocidad VARCHAR(50),
    RamSlotsVacios INT,
    AlmacenamientoCap VARCHAR(50),
    AlmacenamientoParticiones VARCHAR(50),
    PlacaModelo VARCHAR(120),
    Puertos VARCHAR(200),
    InfoExtra TEXT,
    FechaRegistro DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_detalle_equipo FOREIGN KEY (EquipoId) REFERENCES EQUIPO(EquipoId) ON DELETE CASCADE
);

-- --------------------------------------------------------
-- Tabla Reparacion (registro de procesos por equipo)
-- --------------------------------------------------------
CREATE TABLE REPARACION (
    ReparacionId BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    EquipoId BIGINT UNSIGNED NOT NULL,
    DescripcionProceso TEXT NOT NULL,
    DetallesProblema TEXT,
    FechaRegistro DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_reparacion_equipo FOREIGN KEY (EquipoId) REFERENCES EQUIPO(EquipoId) ON DELETE CASCADE
);

-- Datos de ingreso para primera vez

-- 1. Crear CARGO: Gerente General
INSERT INTO CARGO (Cargo)
VALUES ('Gerente General');


-- 2. Crear EMPLEADO por defecto
INSERT INTO EMPLEADO (Nombre, Telefono, DUI, Direccion, CargoId)
VALUES (
    'Administrador General',
    '0000-0000',
    '00000000-0',
    'Sistema',
    1   -- CargoId = Gerente General
);

-- 3. Crear USUARIO administrador
INSERT INTO USUARIO (EmpleadoId, Email, Clave, Rol)
VALUES (
    1,
    'admin1@gmail.com',
    '$2y$10$nwqr80SsfOsqFtcci6jqUelkSUN/X9tr8ba0J5R6ocoHWRng.BI9S',
    'admin'
);