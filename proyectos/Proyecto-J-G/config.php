<?php
// Rutas de archivos
// include, requier once, requiere, include once
define('ROOT_PATH', dirname(__FILE__)); // Esto da la ruta absoluta a /Proyecto-J-G
define('BASE_PATH', __DIR__); // C:xampp/htdocs/Proyecto-J-G
define('CONTROLLER_PATH', BASE_PATH . '/Controller');
define('MODEL_PATH', BASE_PATH . '/Models');
define('VIEW_PATH', BASE_PATH . '/Visual');
define('FORM_PATH', VIEW_PATH . '/Form');

// Rutas de links
// form, <a></a>,s
$baseUrl = dirname($_SERVER['SCRIPT_NAME']);
$baseUrl = rtrim($baseUrl, '/');

define('BASE_URL', $baseUrl === '/' ? '' : $baseUrl);
