<?php
require_once ROOT_PATH . '/config.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <title>Iniciar sesión</title>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .login-container {
            width: 100%;
            max-width: 400px;
        }
    </style>
</head>

<body class="bg-light">

    <div class="d-flex justify-content-center align-items-center min-vh-100">
        <section class="border rounded p-4 bg-white shadow login-container">
            <div class="text-center mb-3">
                <a href="<?=BASE_URL?>/">
                    <!--<img src="../../Media/img/Logo_JyG.jpg" alt="Logo Polleria JyG" class="img-fluid" style="max-height: 120px;">-->
                    <img src="http://localhost/Proyecto-J-G/Media/img/Logo_JyG.jpg" alt="Logo Polleria JyG" class="img-fluid" style="max-height: 120px;">
                    
                </a>
            </div>
            <h2 class="text-center mb-4">Iniciar sesión</h2>
            <form action="<?=BASE_URL?>/login" method="post">
                <div class="form-floating mb-3">
                    <input class="form-control" id="floatingInput" type="email" name="correo" required>
                    <label for="floatingInput">Correo</label>
                </div>
                <div class="form-floating mb-3">
                    <input class="form-control" id="floatingPassword" type="password" name="contraseña" required>
                    <label for="floatingPassword">Contraseña</label>
                </div>
                <button class="btn btn-primary w-100" type="submit" name="btn_login_cliente">Iniciar sesión</button>
            </form>
            <p class="text-center mt-3">¿No tiene una cuenta? <a href="registro">Regístrese aquí.</a></p>
        </section>
    </div>

</body>

</html>
