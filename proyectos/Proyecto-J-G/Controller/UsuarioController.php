<?php
require_once __DIR__ . '/../config.php';

require_once BASE_PATH . '/Models/Usuario.php';

class UsuarioController
{
    // Metodo para el login del cliente
    public function loginCliente()
    {
        if (isset($_POST['btn_login_cliente'])) {
            $usuarioModelo = new Usuario();

            $correo = $_POST['correo'];
            $contraseña = $_POST['contraseña'];

            $usuario = $usuarioModelo->verificarCredenciales($correo, $contraseña);

            if ($usuario) {
                // Aquí puedes iniciar sesión
                session_start();
                $_SESSION['usuario'] = $usuario;
                $_SESSION['rol'] = $usuario["rol"];
                header("Location: " . BASE_URL);
                exit;
            } else {
                echo "Usuario o contraseña incorrectos";
            }
        }
    }
    // Metodo para el registro del cliente
    public function registroCliente()
    {
        if (isset($_POST['btn_registro_cliente'])) {

            $usuarioModelo = new Usuario();

            $nombre_usuario = $_POST['nombre_usuario'];
            $nombres = $_POST['nombres'];
            $apellidos = $_POST['apellidos'];
            $nombre_apellido = $nombres . " " . $apellidos;
            $telefono = $_POST['celular'];
            $correo = $_POST['email'];
            $contraseña = $_POST['contraseña'];
            $rol = "cliente";

            $resultado = $usuarioModelo->crearUsuario($nombre_usuario, $nombre_apellido, $contraseña, $correo, $telefono, $rol);

            if ($resultado) {
                header("Location: " . BASE_URL . '/login');
            } else {
                echo 'usuario no registrado.';
            }
        }
    }
}

if (isset($_POST['btn_registro_admin'])) {

    $usuarioModelo = new Usuario();

    $nombre_usuario = $_POST['nombre_usuario'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $nombre_apellido = $nombres . " " . $apellidos;
    $telefono = $_POST['celular'];
    $correo = $_POST['email'];
    $contraseña = $_POST['contraseña'];
    $rol = "admin";

    $resultado = $usuarioModelo->crearUsuario($nombre_usuario, $nombre_apellido, $contraseña, $correo, $telefono, $rol);

    if ($resultado) {
        header("Location: ../index.php");
    } else {
        echo 'usuario no registrado.';
    }
}

// Para el login del admin
if (isset($_POST['btn_login_admin'])) {
    $usuarioModelo = new Usuario();


    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    $usuario = $usuarioModelo->verificarCredenciales($correo, $contraseña);

    if ($usuario) {
        // Aquí puedes iniciar sesión
        session_start();
        $_SESSION['usuario'] = $usuario;
        header("Location: ../Visual/Dashboard.php");
    } else {
        echo "Usuario o contraseña incorrectos";
    }
}
