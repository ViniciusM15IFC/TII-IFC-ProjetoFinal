<?php
    session_start();
    require_once __DIR__ . "/../src/autoload.php";

    $usuario = UsuarioDAO::validarUsuario($_POST);

    if ($idusuario = $usuario['idusuario']){    
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['idusuario'] = $idusuario;
        $_SESSION['nomeusuario'] = $usuario['nomeusuario'];
        $_SESSION['foto'] = $usuario['foto'];
        header("Location:../pages/home.php");
    }else{
        $_SESSION['msg'] = "Usuário ou senha inválido.";
        header("Location:../pages/login.php");
    }
?>