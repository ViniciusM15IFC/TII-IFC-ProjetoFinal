<?php
require_once '../src/UsuarioDAO.php'; // Inclui a classe que tem a função consultarUsuario()

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
    }

    // Valida: senhas coincidem
    if ($senha !== $confirmar) {
        $_SESSION['msg'] = "As senhas devem ser iguais.";
    }

    // Valida: idade mínima de 13 anos
    $nascimento = DateTime::createFromFormat('Y-m-d', $dataNasc);
    if (!$nascimento) {
        $_SESSION['msg'] = "Data de Nascimento Inválida.";
    }

    $hoje = new DateTime();
    $idade = $hoje->diff($nascimento)->y;

    if ($idade < 13) {
        $_SESSION['msg'] = "Você precisa ter 13 ou mais para se cadastrar.";
    }

    // Valida: e-mail já cadastrado
    $usuarios = UsuarioDAO::consultarUsuario($email);
    if (!empty($usuarios)) {
        $_SESSION['msg'] = "Email já em uso.";
    }

    UsuarioDAO::cadastrarUsuario($_POST);
    header('form-cadastra-usuario.html');
}
 else {
    die("Requisição inválida.");
}
?>
