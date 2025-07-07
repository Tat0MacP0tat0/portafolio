<?php

require_once 'conexion.php';

class Producto
{

    public function obtenerTodosLosProductos()
    {
        // $con proviene de conexion.php
        global $con;

        //consulta sql para obtener usuarios
        $consulta = "Select * from producto";
        $result = $con->query($consulta);

        //lista donde se almacenarán los usuarios
        $productos = [];

        //Bucle que alimenta a la lista con los valores de resultado
        while ($row = $result->fetch_assoc()) {
            $productos[] = $row;
        }

        //Retorna a todos los usuarios, es decir cuando llamemos a obtenerTodosLosUsuarios, tendremos una lista con los usuarios de la bd
        return $productos;
    }

    public function crearProducto($nombre, $descripcion, $unidad_producto, $precio_producto, $stock, $id_categoria, $imagen_url)
    {

        global $con;

        $consulta = "insert into usuario (nombre, descripcion, unidad_producto, precio_producto, stock, id_categoria, imagen_url) values (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($consulta);
        //"ssssss" quiere decir string string string string ... O sea que nombre_usuario debe ser string, nombres_apellidos debe ser string etc. Para aceptar enteros es i (integer) d double , etc.
        $stmt->bind_param("sssdiis", $nombre, $descripcion, $unidad_producto, $precio_producto, $stock, $id_categoria, $imagen_url);

        return $stmt->execute();
    }

    public function eliminarProducto($id)
    {

        global $con;

        $consulta = "delete from producto where id=?";
        $stmt = $con->prepare($consulta);
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }

    public function obtenerProductoPorCategoria($nombre_categoria)
    {
        //Chancho
        global $con;

        $consulta = "Select p.* from producto p inner join categoria c on p.id_categoria = c.id_categoria where c.nombre = ?";
        $stmt = $con->prepare($consulta);
        $stmt->bind_param("s", $nombre_categoria);
        $stmt->execute();

        $resultado = $stmt->get_result();
        $productos = [];
        while ($fila = $resultado->fetch_assoc()) {
            $productos[] = $fila;
        }

        return $productos;
    }

    public function buscarPorNombre($texto)
    {
        global $con;

        $consulta = "SELECT * FROM producto WHERE nombre LIKE ?";
        $stmt = $con->prepare($consulta);

        if (!$stmt) {
            die("Error en la consulta: " . $con->error);
        }

        $like = "%" . $texto . "%";
        $stmt->bind_param("s", $like);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    Public function detalleDelProducto($idproducto)
    {
        global $con;

        $consulta = "SELECT * FROM producto WHERE id_producto = ?";
        $stmt = $con->prepare($consulta);
        $stmt->bind_param("i", $idproducto);
        $stmt->execute();

        $resultado = $stmt->get_result();
        $detproducto = [];
        while ($fila = $resultado->fetch_assoc()) {
            $detproducto[] = $fila;
        }
        return $detproducto;
    }
}
