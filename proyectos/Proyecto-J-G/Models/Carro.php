<?php
// session_start();

require_once 'conexion.php';

class Carro
{

    public function MostrarCarritoRegistrado($id_usuario)
    {
        global $con;

        $consulta = "SELECT * 
                 FROM detalle_carrito c 
                 INNER JOIN carrito a ON c.id_carrito = a.id_carrito 
                 INNER JOIN producto p ON p.id_producto = c.id_producto
                 WHERE a.id_usuario = ? AND a.estado = 'activo'";
        //GROUP BY c.id_detalle_carrito";

        $stmt = $con->prepare($consulta);
        $stmt->bind_param("i", $id_usuario);

        $stmt->execute();
        $result = $stmt->get_result();

        $prodCarrito = [];
        while ($row = $result->fetch_assoc()) {
            $prodCarrito[] = $row;
        }

        return $prodCarrito;
    }


    public function AgregarAlCarritoRegistrado($id_usuario, $id_producto, $cantidad)
{
    global $con;

    try {
        $con->begin_transaction();

        // PASO 1: Verificar si ya hay un carrito activo para el usuario
        $consulta_existente = "SELECT id_carrito FROM carrito WHERE id_usuario = ? AND estado = 'activo' LIMIT 1";
        $stmt_check = $con->prepare($consulta_existente);
        $stmt_check->bind_param("i", $id_usuario);
        $stmt_check->execute();
        $resultado = $stmt_check->get_result();

        if ($resultado->num_rows > 0) {
            // Ya existe un carrito activo
            $row = $resultado->fetch_assoc();
            $id_carrito = $row['id_carrito'];
        } else {
            // No existe: Crear nuevo carrito
            $crear_carrito = "INSERT INTO carrito (id_usuario, fecha_creacion, estado) VALUES (?, NOW(), 'activo')";
            $stmt_new = $con->prepare($crear_carrito);
            $stmt_new->bind_param("i", $id_usuario);
            $stmt_new->execute();
            $id_carrito = $con->insert_id;
        }

        // PASO 2: Verificar si el producto ya está en el carrito
        $verificar_producto = "SELECT cantidad FROM detalle_carrito WHERE id_carrito = ? AND id_producto = ?";
        $stmt_verificar = $con->prepare($verificar_producto);
        $stmt_verificar->bind_param("ii", $id_carrito, $id_producto);
        $stmt_verificar->execute();
        $resultado_producto = $stmt_verificar->get_result();

        if ($resultado_producto->num_rows > 0) {
            // Ya existe el producto: actualizar cantidad
            $row_producto = $resultado_producto->fetch_assoc();
            $nueva_cantidad = $row_producto['cantidad'] + $cantidad;

            $actualizar_cantidad = "UPDATE detalle_carrito SET cantidad = ? WHERE id_carrito = ? AND id_producto = ?";
            $stmt_update = $con->prepare($actualizar_cantidad);
            $stmt_update->bind_param("iii", $nueva_cantidad, $id_carrito, $id_producto);
            $stmt_update->execute();
        } else {
            // No existe el producto: insertar nuevo
            $insertar_detalle = "INSERT INTO detalle_carrito (id_carrito, id_producto, cantidad) VALUES (?, ?, ?)";
            $stmt_detalle = $con->prepare($insertar_detalle);
            $stmt_detalle->bind_param("iii", $id_carrito, $id_producto, $cantidad);
            $stmt_detalle->execute();
        }

        $con->commit();
        return true;

    } catch (Exception $e) {
        $con->rollback();
        echo "Error al agregar al carrito: " . $e->getMessage();
        return false;
    }
}
    //////////////////////////////////////////////////////////////////////////////////////////
    //////////////////
    public function  FinalizarCompra($id_carrito)
    {
        global $con;
        $consulta="UPDATE carrito
        SET estado='finalizado'
        WHERE id_carrito=?";

        $stmt=$con->prepare($consulta);
        $stmt->bind_param("i",$consulta);
        return $stmt->execute();
    }
    //////////////////
    public function ActualizarCantidadProducto($id_usuario, $id_producto, $cantidad)
    {
        global $con;

        $consulta = "
        UPDATE detalle_carrito dc
        INNER JOIN carrito c ON dc.id_carrito = c.id_carrito
        SET dc.cantidad = ?
        WHERE c.id_usuario = ? AND dc.id_producto = ? AND c.estado = 'activo'
    ";

        $stmt = $con->prepare($consulta);
        $stmt->bind_param("iii", $cantidad, $id_usuario, $id_producto);
        return $stmt->execute();
    }

    public function EliminarProducto($id_usuario, $id_producto)
    {
        global $con;

        $consulta = "
        DELETE dc FROM detalle_carrito dc
        INNER JOIN carrito c ON dc.id_carrito = c.id_carrito
        WHERE c.id_usuario = ? AND dc.id_producto = ? AND c.estado = 'activo'
    ";

        $stmt = $con->prepare($consulta);
        $stmt->bind_param("ii", $id_usuario, $id_producto);
        return $stmt->execute();
    }

    ////////////////////////////////////////////////////////////////////////////////////////


}