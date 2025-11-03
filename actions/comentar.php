<?php

require_once '../src/autoload.php';

session_start();
$idusuario = $_SESSION['idusuario'] ?? null;
$idpostagem = $_POST['idpostagem'] ?? null;
$texto = $_POST['comentarioTexto'] ?? null;
$dados = [
    'idusuario' => $idusuario,
    'idpostagem' => $idpostagem,
    'texto' => $texto
];

if ($idusuario && $idpostagem) {
    $comentarioTexto = trim($_POST['comentarioTexto'] ?? '');

    if (!empty($comentarioTexto)) {
        ComentarioDAO::inserir($dados);
    }
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;