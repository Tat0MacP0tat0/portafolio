<?php

require_once '../../config.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>login adm</h2>
    <form action="<?= BASE_URL . '/Controller/UsuarioController.php' ?>" method="post" onsubmit="console.log('enviando...')">
        <input type="email" name="correo" required>
        <input type="password" name="contraseña" required>
        <button type="submit" name="btn_login_admin">Iniciar sesión</button>
    </form>
</body>
</html>