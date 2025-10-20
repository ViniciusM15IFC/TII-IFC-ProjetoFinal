<?php
require_once __DIR__ . "/../src/autoload.php"; 

// 1. Verifica se veio um POST válido
if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $categoria = $_POST['categoria'] ?? '';

    $titulo = trim($_POST['titulo'] ?? '');
    $genero = $_POST['genero'] ?? '';
    $classificacao = $_POST['classificacao'] ?? '';

    if (empty($titulo) || empty($genero) || empty($classificacao)) {
        $_SESSION['msg'] = "Preencha todos os campos.";
    }


    if ($categoria === '1') {
        $duracao = $_POST['duracao'] ?? '';
        $diretor = $_POST['diretor'] ?? '';
        $anoLancamento = $_POST['ano-lancamento'] ?? '';
        if (empty($duracao) || empty($anoLancamento) || empty($diretor)) {
            $_SESSION['msg'] = "Preencha todos os campos.";
        }
        else {
            FilmeDAO::inserir($_POST);
        }
    } else if ($categoria === '2') {
        $episodios = $_POST['episodios'] ?? '';
        $temporadas = $_POST['temporadas'] ?? '';
        $anoInicio = $_POST['ano-inicio'] ?? '';
        $anoEncerramento = $_POST['ano-encerramento'] ?? '';
        if (empty($episodios) || empty($temporadas) || empty($anoInicio) || empty($anoEncerramento)) {
            $_SESSION['msg'] = "Preencha todos os campos.";
        }
        else {
            SerieDAO::inserir($_POST);
        }
    } else if ($categoria === '3') {
        $paginas = $_POST['paginas'] ?? '';
        $autor = $_POST['autor'] ?? '';
        $editora = $_POST['editora'] ?? '';
        if (empty($paginas) || empty($autor) || empty($editora)) {
            $_SESSION['msg'] = "Preencha todos os campos.";
        }
        else {
            LivroDAO::inserir($_POST);
        }
    }
    $_SESSION['msg'] = "Cadastro realizado com sucesso.";
    header('Location: ../pages/form-cadastra-conteudo.php');
}
 else {
    die("Requisição inválida.");
}
?>
