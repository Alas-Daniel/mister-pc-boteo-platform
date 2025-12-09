<?php

// Leer archivo .env
$config = parse_ini_file(__DIR__ . '/../config.env');

// Parámetros de configuración
define('DB_HOST', $config['DB_HOST']);
define('DB_NAME', $config['DB_NAME']);
define('DB_USER', $config['DB_USER']);
define('DB_PASS', $config['DB_PASS']);

// Parámetros de correo (envio de correo en contact.php landing)
define('EMAIL_HOST', $config['EMAIL_HOST']);
define('EMAIL_PORT', $config['EMAIL_PORT']);
define('EMAIL_USERNAME', $config['EMAIL_USERNAME']);
define('EMAIL_PASSWORD', $config['EMAIL_PASSWORD']);
define('EMAIL_TO', $config['EMAIL_TO']);

// URL base del proyecto
define('BASE_URL', 'http://localhost/mister-pc-boteo/public/');

