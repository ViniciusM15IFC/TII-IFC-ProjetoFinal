<?php
require_once '../src/autoload.php';

session_start();
$idusuario = $_SESSION['idusuario'] ?? null;
$idpostagem = $_POST['idpostagem'] ?? null;
$acao = $_POST['acao'] ?? '';

if ($idusuario && $idpostagem) {
    if ($acao === 'curtir') {
        CurtidaDAO::curtir($idusuario, $idpostagem);
    } elseif ($acao === 'descurtir') {
        CurtidaDAO::descurtir($idusuario, $idpostagem);
    }
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;