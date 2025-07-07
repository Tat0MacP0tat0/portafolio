<?php
session_start();

require_once 'config.php';

$fullpath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = str_replace(BASE_URL, '', $fullpath);

// echo BASE_URL; exit;
// echo $fullpath; exit;
// echo $uri; exit;

// Simple router
switch ($uri) {
    case '/':
        // require_once CONTROLLER_PATH . '/ProductoController.php';
        require CONTROLLER_PATH . '/ProductoController.php';
        (new ProductoController())->mostrarIndex();
        break;

    case '/producto':
        $categoria = $_GET['categoria'] ?? null;
        // categoria = Chancho
        require_once CONTROLLER_PATH . '/ProductoController.php';
        (new ProductoController())->mostrarIndex($categoria);
        break;

    case '/search':
        $inputBusqueda = $_GET['search'] ?? null;
        require_once CONTROLLER_PATH . '/ProductoController.php';
        (new ProductoController())->busquedaInput($inputBusqueda);
        break;


    case '/login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once CONTROLLER_PATH . '/UsuarioController.php';
            (new UsuarioController())->loginCliente();
        } else {
            require_once FORM_PATH . '/login.php'; // Aquí se carga la vista del formulario
        }
        break;

    case '/registro':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once CONTROLLER_PATH . '/UsuarioController.php';
            (new UsuarioController())->registroCliente();
        } else {
            require_once FORM_PATH . '/registro.php'; // Aquí se carga la vista del formulario
        }
        break;

    case '/Visual/Product_detail':
        // $idProducto = $_GET['id_producto'] ?? null;
        $idProducto = $_GET['id'] ?? null;
        require_once CONTROLLER_PATH . '/ProductoController.php';
        (new ProductoController())->ProductDetail($idProducto);
        break;

    // --------------------------------------------------------------------------------
    case '/Visual/Cart/Carrito':
        $idUsuario = $_SESSION['usuario']['id_usuario'] ?? null;
        // $idUsuario = $_SESSION['id_usuario'] ?? null;
        require_once CONTROLLER_PATH . '/CarritoController.php';
        (new CarritoController())->mostrarCarrito($idUsuario);
        break;

    case '/Carrito/Agregar':
        // echo $uri;
        // $idUsuario = $_SESSION[]es
        require_once CONTROLLER_PATH . '/CarritoController.php';
        (new CarritoController())->agregar();
        break;

    // --------------------------------------------------------------------------------

    case '/adm/login':
        require_once './Controller/UsuarioController.php';
        require 'visual/Form/logAdmin.php';
        break;

    case '/adm/registro':
        require 'visual/form/registroAdmin.php';
        break;

    case '/adm/dashboard':
        require 'Controller/DashboardController.php';
        break;

/////////////////////////////////////////////////////////////////////////////////////////////

    case '/carrito/actualizar-cantidad':
        require_once CONTROLLER_PATH . '/CarritoController.php';
        (new CarritoController())->actualizarCantidad();
        break;

    case '/carrito/eliminar-producto':
        require_once CONTROLLER_PATH . '/CarritoController.php';
        (new CarritoController())->eliminarProducto();
        break;

/////////////////////////////////////////////////////////////////////////////////////////////

    default:
        http_response_code(404);
        echo "404 - Página no encontrada" . PHP_EOL;
        echo $uri;
        break;
}
