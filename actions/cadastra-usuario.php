<?php
require_once __DIR__ . "/../src/autoload.php"; 

// 1. Verifica se veio um POST válido
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Coleta os dados
    $nome       = trim($_POST['nome'] ?? '');
    $email      = trim($_POST['email'] ?? '');
    $senha      = $_POST['senha'] ?? '';
    $confirmar  = $_POST['confirmarsenha'] ?? '';
    $dataNasc   = $_POST['datanasc'] ?? '';

    // Valida: campos obrigatórios
    if (empty($nome) || empty($email) || empty($senha) || empty($confirmar) || empty($dataNasc)) {
        $_SESSION['msg'] = "Preencha todos os campos.";
        header('Location: /pages/
        form-cadastra-usuario.php');
        exit;
    }

    // Valida: senhas coincidem
    if ($senha !== $confirmar) {
        $_SESSION['msg'] = "As senhas devem ser iguais.";
        header('Location: /pages/form-cadastra-usuario.php');
        exit;
    }

    // Valida: idade mínima de 13 anos
    $nascimento = DateTime::createFromFormat('Y-m-d', $dataNasc);
    if (!$nascimento) {
        $_SESSION['msg'] = "Data de Nascimento Inválida.";
        header('Location: /pages/form-cadastra-usuario.php');
        exit;
    }

    $hoje = new DateTime();
    $idade = $hoje->diff($nascimento)->y;

    if ($idade < 13) {
        $_SESSION['msg'] = "Você precisa ter 13 ou mais para se cadastrar.";
        header('Location: /pages/form-cadastra-usuario.php');
        exit;
    }

    // Valida: e-mail já cadastrado
    $usuarios = UsuarioDAO::consultarUsuario($email);
    if (!empty($usuarios)) {
        $_SESSION['msg'] = "Email já em uso.";
        header('Location: /pages/form-cadastra-usuario.php');
        exit;
    }

    UsuarioDAO::cadastrarUsuario($_POST);
    header('Location: ../pages/login.php');
}
 else {
    die("Requisição inválida.");
}
?>
