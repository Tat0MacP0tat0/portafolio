<?php
session_start();         // Inicia sesión si no está ya iniciada
session_unset();         // Limpia todas las variables de sesión
session_destroy();       // Destruye la sesión por completo

header("Location: ../");// Redirige al login (o donde quieras)
exit;
