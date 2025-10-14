<?php
session_start();
require_once __DIR__ . "/../src/autoload.php";


if (isset($_SESSION['idusuario'])) {
    if (!AdminDAO::validarAdmin($_SESSION['idusuario'])) {
        $_SESSION['msg'] = "Pagina exclusiva para administradores";
        header("Location:login.php");
        exit();
    }
}
else {
    $_SESSION['msg'] = "Para acessar essa página, é necessário fazer login.";
    header("Location:login.php");
    exit();
}
?>