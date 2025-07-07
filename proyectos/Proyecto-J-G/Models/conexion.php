<?php
$host = "localhost";
$user = "root";
$password = ""; // si tienes contraseña ponla aquí
$dbname = "ecommerce_avicola"; // cambia por el nombre real de tu base de datos

$con = new mysqli($host, $user, $password, $dbname);

if ($con->connect_error) {
    die("Error de conexión: " . $con->connect_error);
}
?>