<?php

require_once 'conexion.php';

class Usuario{
    
    // READ ( cRud )
    public function obtenerTodosLosUsuarios() {
        // $con proviene de conexion.php
        global $con;

        //consulta sql para obtener usuarios
        $consulta = "Select * from usuario";
        $result = $con->query($consulta);

        //lista donde se almacenarán los usuarios
        $usuarios = [];

        //Bucle que alimenta a la lista con los valores de resultado
        while($row = $result->fetch_assoc()){
            $usuarios[] = $row;
        }

        //Retorna a todos los usuarios, es decir cuando llamemos a obtenerTodosLosUsuarios, tendremos una lista con los usuarios de la bd
        return $usuarios;

    }

    //CREATE ( Crud )
    public function crearUsuario($nombre_usuario, $nombres_apellidos, $contraseña, $direccion, $telefono, $rol){

        global $con;

        //Hasheamos la contraseña, es decir, si el usuario pone de contraseña 1234 a la base de datos llega cualquier huevada xd
        $contraseña_hasheada = password_hash($contraseña, PASSWORD_DEFAULT);

        $consulta = "insert into usuario (nombre_usuario, nombres_apellidos, contraseña, direccion, telefono, rol) values (?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($consulta);
        //"ssssss" quiere decir string string string string ... O sea que nombre_usuario debe ser string, nombres_apellidos debe ser string etc. Para aceptar enteros es i (integer) d double , etc.
        $stmt->bind_param("ssssss",$nombre_usuario, $nombres_apellidos, $contraseña_hasheada, $direccion, $telefono, $rol);
        
        return $stmt->execute();

    }

    //UPDATE ( crUd )
    public function actualizarUsuario($id, $nombre_usuario, $nombres_apellidos, $contraseña, $direccion, $telefono, $rol){

        global $con;

        $consulta = "update usuario set nombre_usuario=?, nombres_apellidos=?, contraseña=?, direccion=?, telefono=?, rol=? where id=?";
        $stmt = $con->prepare($consulta);
        $stmt->bind_param("ssssssi", $nombre_usuario, $nombres_apellidos, $contraseña, $direccion, $telefono, $rol, $id);

        return $stmt->execute();

    }

    //DELETE ( cruD )
    public function eliminarUsuario($id){

        global $con;

        $consulta = "delete from usuario where id=?";
        $stmt = $con->prepare($consulta);
        $stmt->bind_param("i",$id);

        return $stmt->execute();

    }

    public function verificarCredenciales($direccion, $contraseña){
        global $con;

        $consulta = "select * from usuario where direccion = ?";
        $stmt = $con->prepare($consulta);
        $stmt->bind_param("s", $direccion);
        $stmt->execute();

        $resultado = $stmt->get_result();
        $usuario = $resultado->fetch_assoc();

        if ( $usuario && password_verify($contraseña, $usuario['contraseña']) ){
            return $usuario;
        }

        return 'credenciales incorrectas';
    }

}


