<?php
require_once 'src/UsuarioDAO.php'; // Inclui a classe que tem a função consultarUsuario()

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
        die("Preencha todos os campos obrigatórios.");
    }

    // Valida: senhas coincidem
    if ($senha !== $confirmar) {
        die("As senhas não coincidem.");
    }

    // Valida: idade mínima de 13 anos
    $nascimento = DateTime::createFromFormat('Y-m-d', $dataNasc);
    if (!$nascimento) {
        die("Data de nascimento inválida.");
    }

    $hoje = new DateTime();
    $idade = $hoje->diff($nascimento)->y;

    if ($idade < 13) {
        die("Você precisa ter pelo menos 13 anos para se cadastrar.");
    }

    // Valida: e-mail já cadastrado
    $usuarios = UsuarioDAO::consultarUsuario($email);
    if (!empty($usuarios)) {
        die("Este e-mail já está em uso. Escolha outro.");
    }

    UsuarioDAO::cadastrarUsuario($_POST);

    if ($resultado) {
        echo "<script>alert('Cadastro realizado com sucesso!'); window.location.href = 'index.html';</script>";
    } else {
        echo "Erro ao cadastrar usuário.";
    }
} else {
    die("Requisição inválida.");
}
?>
