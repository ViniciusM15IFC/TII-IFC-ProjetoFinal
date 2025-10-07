<?php
    session_start();
    require "../src/UsuarioDAO.php";

    if ($idusuario = UsuarioDAO::validarUsuario($_POST)){    
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['idusuario'] = $idusuario;
        header("Location:../pages/home.php");
    }else{
        $_SESSION['msg'] = "Usuário ou senha inválido.";
        header("Location:../pages/login.php");
    }
?>