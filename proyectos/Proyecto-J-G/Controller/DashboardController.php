<?php

session_start();

if (
    isset($_SESSION["usuario"]) &&
    isset($_SESSION["usuario"]["rol"]) &&
    $_SESSION["usuario"]["rol"] === "admin"
){
    header("Location: " . BASE_PATH . "/Visual/Dashboard");
    exit;
}
else{
    header("Location: ".BASE_PATH."/Visual/app.php");
    exit;
}

?>


