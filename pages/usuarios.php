<?php
include "../incs/valida-sessao.php";
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>O Crítico - Usuários</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.iconify.design/iconify-icon/1.0.8/iconify-icon.min.js"></script>
    <link rel="stylesheet" href="..\assets\css\style.css">
</head>

<body>
    <?php include "../incs/header.php"; ?>

    <!-- Conteúdo Principal -->
    <main class="container text-center my-5">
        <h2 class="display-4">Bem-vindo!</h2>
        <p class="lead">Cadastre-se em nosso site.</p>
        <form class="w-50 mx-auto text-start row">
            <div class="mb-3">
                <label class="form-label">Nome de Usuário</label>
                <input type="text" class="form-control" name="nome" placeholder="Nome" required />
            </div>

            <button type="submit" class="btn btn-primary btn-lg my-4">
                Buscar
            </button>
        </form>
        <div class="container w-50 mx-auto text-start row">


            <?php
            require_once __DIR__ . "/../src/autoload.php";

            $idUsuarioLogado = $_SESSION['idusuario'];
            $seguidos = SeguidoDAO::listarSeguidos($idUsuarioLogado); // retorna array de usuários seguidos
            $idsSeguidos = array_column($seguidos, 'idusuario'); // só pega os IDs
            
            $nome = $_GET['nome'] ?? ''; // evita erro de índice indefinido
            
            if ($_SERVER['REQUEST_METHOD'] === 'GET' && $nome !== '') {
                // Se o formulário foi enviado e tem nome preenchido
                $usuarios = UsuarioDAO::buscarUsuarios($nome);
            } else {
                // Se o campo está vazio ou o form não foi enviado
                $usuarios = UsuarioDAO::listarUsuarios();
            }

            foreach ($usuarios as $usuario) {
                if ($idUsuarioLogado !== $usuario['idusuario']) {
                    Componentes::cardUsuario($usuario);
                }
            }
            ?>
        </div>

    </main>
</body>
<script src="../assets/js/script.js"></script>

</html>