<?php

// Conexion a base de datos
class Database {
    private static $instance = null;

    public static function getConnection() {
        if (self::$instance === null) {
            try {
                self::$instance = new PDO(
                    "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8",
                    DB_USER,
                    DB_PASS,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                    ]
                );
            } catch (PDOException $e) {
                error_log("Error de conexión: " . $e->getMessage(), 3, __DIR__ . '/../../logs/error_log.txt');
                die("Error al conectar con la base de datos.");
            }
        }
        return self::$instance;
    }
}
