<?php
require_once __DIR__ . "/../src/autoload.php"; 

// 1. Verifica se veio um POST válido
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $categoria = $_POST['categoria'] ?? '';
    $titulo = trim($_POST['titulo'] ?? '');
    $genero = $_POST['genero'] ?? '';
    $classificacao = $_POST['classificacao'] ?? '';

    if (empty($titulo) || empty($genero) || empty($classificacao)) {
        $_SESSION['msg'] = "Preencha todos os campos obrigatórios.";
        header('Location: ../pages/form-cadastra-conteudo.php');
        exit();
    }

    // Validar os campos dependendo da categoria
    if ($categoria === '1') {  // Filme
        $duracao = $_POST['duracao'] ?? '';
        $diretor = $_POST['diretor'] ?? '';
        $anoLancamento = $_POST['ano-lancamento'] ?? '';
        
        if (empty($duracao) || empty($anoLancamento) || empty($diretor)) {
            $_SESSION['msg'] = "Preencha todos os campos obrigatórios para filmes.";
            header('Location: ../pages/form-cadastra-conteudo.php');
            exit();
        }
        FilmeDAO::inserir($_POST);
    } else if ($categoria === '2') {  // Série
        $episodios = $_POST['episodios'] ?? '';
        $temporadas = $_POST['temporadas'] ?? '';
        $anoInicio = $_POST['ano-inicio'] ?? '';
        $anoEncerramento = $_POST['ano-encerramento'] ?? '';
        
        if (empty($episodios) || empty($temporadas) || empty($anoInicio)) {
            $_SESSION['msg'] = "Preencha todos os campos obrigatórios para séries.";
            header('Location: ../pages/form-cadastra-conteudo.php');
            exit();
        }
        SerieDAO::inserir($_POST);
    } else if ($categoria === '3') {  // Livro
        $paginas = $_POST['paginas'] ?? '';
        $autor = $_POST['autor'] ?? '';
        
        if (empty($paginas) || empty($autor)) {
            $_SESSION['msg'] = "Preencha todos os campos obrigatórios para livros.";
            header('Location: ../pages/form-cadastra-conteudo.php');
            exit();
        }
        LivroDAO::inserir($_POST);
    } else {
        $_SESSION['msg'] = "Selecione uma categoria válida.";
        header('Location: ../pages/form-cadastra-conteudo.php');
        exit();
    }

    $_SESSION['msg'] = "Cadastro realizado com sucesso.";
    header('Location: ../pages/form-cadastra-conteudo.php');
    exit();
} else {
    die("Requisição inválida.");
}
