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

// Verificar se o ID da postagem foi passado via GET
if (isset($_GET['idpostagem']) && is_numeric($_GET['idpostagem'])) {
    $idPostagem = $_GET['idpostagem'];


    if ($_SESSION['idusuario'] == PostagemDAO::getAutorPostagem($idPostagem) || AdminDAO::validarAdmin($_SESSION['idusuario'])) {
        // Chama a função para excluir a postagem
        PostagemDAO::excluirPostagem($idPostagem);

        // Redireciona de volta para a página anterior (feed ou outra página de postagens)
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
}


