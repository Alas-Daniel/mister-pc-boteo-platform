<?php

session_start();
// Cargar configuración
require_once __DIR__ . '/../config/config.php';

// Cargar el autoload de clases
require_once __DIR__ . '/../app/core/Router.php';
require_once __DIR__ . '/../app/core/Controller.php';
require_once __DIR__ . '/../app/core/Database.php';

// Ejecutar router
$router = new Router();
$router->run();
