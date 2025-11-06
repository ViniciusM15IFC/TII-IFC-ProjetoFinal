<?php
require_once __DIR__ . "/../src/autoload.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifique os dados recebidos
    error_log("Dados recebidos: " . print_r($_POST, true));

    $idusuario = $_SESSION['idusuario'] ?? null;
    $idconteudo = $_POST['idconteudo'] ?? null;
    $idcategoria = $_POST['idcategoria'] ?? null;
    $nota = $_POST['nota'] ?? null;
    $texto = trim($_POST['texto'] ?? '');

    // Se os dados não estão sendo recebidos corretamente, você vai ver isso no log
    error_log("ID Usuário: $idusuario, ID Conteúdo: $idconteudo, ID Categoria: $idcategoria, Nota: $nota, Texto: $texto");

    if (!$idusuario || !$idconteudo || !$idcategoria || !is_numeric($nota) || $nota < 1 || $nota > 10) {
        $_SESSION['msg'] = 'Selecione uma nota válida para avaliar (1 a 10).';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }


    $dados = [
        'idusuario' => $idusuario,
        'idconteudo' => $idconteudo,
        'idcategoria' => $idcategoria,
        'nota' => $nota,
        'texto' => $texto,
        'datapostagem' => date('Y-m-d H:i:s')
    ];

    if (PostagemDAO::criarPostagem($dados)) {
        $_SESSION['msg'] = 'Avaliação enviada com sucesso!';
    } else {
        $_SESSION['msg'] = 'Erro ao enviar avaliação. Tente novamente.';
    }

    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}
