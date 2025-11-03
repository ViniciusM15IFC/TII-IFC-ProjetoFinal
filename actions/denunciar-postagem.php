<?php
require_once '../src/autoload.php';

session_start();
$idusuario = $_SESSION['idusuario'] ?? null;
$idpostagem = $_POST['idpostagem'] ?? null;

$dados = [
    'idpostagem' => $idpostagem,
    'motivo' => $_POST['motivoDenuncia'] ?? ''
];

DenunciaDAO::denunciar($dados);

header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;