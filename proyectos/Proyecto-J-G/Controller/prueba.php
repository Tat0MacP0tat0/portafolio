<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "usuario", "contraseña", "basedatos");

// Verificar conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Consulta
$sql = "SELECT id, nombre, precio FROM producto";
$resultado = $conexion->query($sql);

// Array de productos
$productos = [];

if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $productos[] = $fila;
    }
}

// Cerrar conexión
$conexion->close();

// Incluir vista
include 'vista.php';
?>