<?php
require_once __DIR__ . "/../src/autoload.php"; 
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Pega o usuário logado da sessão
    $idusuario = $_SESSION['idusuario'] ?? null;

    // Pega os dados do formulário
    $idconteudo = $_POST['idconteudo'] ?? null;
    $idcategoria = $_POST['idcategoria'] ?? null;
    $nota = $_POST['nota'] ?? null;
    $texto = trim($_POST['texto'] ?? '');

    // Validação simples
    if (!$idusuario || !$idconteudo || !$idcategoria || !$nota || !$texto) {
        $_SESSION['msg'] = "Preencha todos os campos.";
        header("Location: ../pages/form-avaliacao.php?idconteudo={$idconteudo}");
        exit;
    }

    // Monta array de dados para o DAO
    $dados = [
        'idconteudo' => $idconteudo,
        'idcategoria' => $idcategoria,
        'nota' => $nota,
        'texto' => $texto
    ];

    try {
        PostagemDAO::criarPostagem($dados);
        $_SESSION['msg'] = "Avaliação enviada com sucesso!";
    } catch (PDOException $e) {
        $_SESSION['msg'] = "Erro ao enviar avaliação: " . $e->getMessage();
    }

    header("Location: ../pages/form-avaliacao.php?idconteudo={$idconteudo}");
    exit;

} else {
    die("Requisição inválida.");
}
