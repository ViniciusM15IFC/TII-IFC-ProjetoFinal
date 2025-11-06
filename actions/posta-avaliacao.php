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
    $texto = trim($_POST['texto'] ?? ''); // Texto é opcional

    // Validação - nota não pode ser 0
    if (!$idusuario || !$idconteudo || !$idcategoria || !$nota || $nota == 0) {
        $_SESSION['msg'] = "Selecione uma nota para avaliar.";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    // Monta array de dados para o DAO
    $dados = [
        'idusuario' => $idusuario,
        'idconteudo' => $idconteudo,
        'idcategoria' => $idcategoria,
        'nota' => $nota,
        'texto' => $texto,
        'datapostagem' => date('Y-m-d H:i:s')
    ];

    try {
        PostagemDAO::criarPostagem($dados);
        $_SESSION['msg'] = "Avaliação enviada com sucesso!";
    } catch (PDOException $e) {
        $_SESSION['msg'] = "Erro ao enviar avaliação: " . $e->getMessage();
    }

    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;

} else {
    die("Requisição inválida.");
}
?>