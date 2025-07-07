<?php

require_once __DIR__ . '/../config.php';
require_once MODEL_PATH . '/Carro.php';

class CarritoController
{
    // Mostrar el carrito
    public function mostrarCarrito($id_usuario = null)// $id_usuario = $_SESSION['usuario']['id_usuario'])
    {
        // header("Location: " . BASE_URL . "/carrito");
        $carritoUsuario = new Carro();
        $CrtUsr = $carritoUsuario->MostrarCarritoRegistrado($id_usuario);
        include VIEW_PATH . '/Cart/Carrito.php';
    }

    public function agregar()
    {
        if (isset($_POST['btn_agregar_a_carrito'])) {
            $carro = new Carro();

            $id_usuario = $_SESSION['usuario']['id_usuario'];
            // $id_usuario = $_SESSION['id_usuario'];
            $id_producto = $_POST['id_producto'];
            $cantidad = $_POST['cantidad'];

            $carro->AgregarAlCarritoRegistrado($id_usuario, $id_producto, $cantidad);
            // include VIEW_PATH . '/Cart/Carrito';
            header("Location: " . BASE_URL . "/Visual/Cart/Carrito");
        }

    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Desactivar 
    



    //
    public function actualizarCantidad()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_usuario = $_SESSION['usuario']['id_usuario'] ?? null;
            $id_producto = $_POST['id_producto'];
            $cantidad = $_POST['cantidad'];

            if ($id_usuario && $id_producto && $cantidad > 0) {
                $carro = new Carro();
                $resultado = $carro->ActualizarCantidadProducto($id_usuario, $id_producto, $cantidad);
                
                echo json_encode(['success' => $resultado]);
            } else {
                echo json_encode(['success' => false, 'error' => 'Datos inválidos']);
            }
        }
        exit;
    }

    public function eliminarProducto()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_usuario = $_SESSION['usuario']['id_usuario'] ?? null;
            $id_producto = $_POST['id_producto'];

            if ($id_usuario && $id_producto) {
                $carro = new Carro();
                $resultado = $carro->EliminarProducto($id_usuario, $id_producto);
                echo json_encode(['success' => $resultado]);
            } else {
                echo json_encode(['success' => false, 'error' => 'Datos inválidos']);
            }
        }
        exit;
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////

}
