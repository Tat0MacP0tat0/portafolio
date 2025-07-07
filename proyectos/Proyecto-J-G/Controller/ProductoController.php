<?php

require_once __DIR__ . '/../config.php';
require_once MODEL_PATH . '/Producto.php';

class ProductoController
{

    // Mostrar los productos en el index
    public function mostrarIndex($categoria = null)
    {
        $producto = new Producto();
        $productos = $categoria
            ? $producto->obtenerProductoPorCategoria($categoria)
            : $producto->obtenerTodosLosProductos();
        include VIEW_PATH . '/app.php';
    }

    // Mostrar los productos para el admin
    public function dashboard()
    {
        // Muestra productos en panel administrativo
        $producto = new Producto();
        $productos = $producto->obtenerTodosLosProductos();

        include '../Visual/admin/dashboard_productos.php'; // Vista administrativa
    }

    public function busquedaInput($inputBusqueda)
    {
        $producto = new Producto();
        $productos = $producto->buscarPorNombre($inputBusqueda);
        include VIEW_PATH . '/app.php';
    }

    public function ProductDetail ($idproduct = null)
    {
        
        $detproducto = new Producto();
        $detailProducto = $detproducto->detalleDelProducto($idproduct);
        include VIEW_PATH . '/Product_detail.php';
        // include VIEW_PATH . '/prueba.php';
    }
}
