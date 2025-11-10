<?php

// Iniciar a sessão
session_start();

// Incluir o arquivo de conexão e a classe PostagemDAO
require_once '../src/autoload.php';

// Verificar se o usuário está autenticado
if (!isset($_SESSION['idusuario'])) {
    // Redireciona para a página inicial ou login, se não estiver autenticado
    header("Location: ../login.php");
    exit();
}


if (isset($_GET['idusuario']) && is_numeric($_GET['idusuario'])) {
    $idUsuario = $_GET['idusuario'];


    if ($_SESSION['idusuario'] == $idUsuario || AdminDAO::validarAdmin($_SESSION['idusuario'])) {
        // Chama a função para excluir a postagem
        UsuarioDAO::excluirUsuario($idUsuario);

        // Redireciona de volta para a página anterior (feed ou outra página de postagens)
        header("Location: ../logout.php");
        exit();
    }
}


