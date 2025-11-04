<?php
include "../incs/valida-sessao.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>O Crítico - Feed</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.iconify.design/iconify-icon/1.0.8/iconify-icon.min.js"></script>
    <link rel="stylesheet" href="..\assets\css\style.css">
</head>

<body>
    <?php include "../incs/header.php"; ?>
    <main class="">
        <div class="container m-4 w-100 row">
            <div class="col-8">
                <h3>Explorar</h3>

                <?php
                require_once __DIR__ . "/../src/autoload.php";

                if (isset($_GET['s'])) {
                    $postagens = PostagemDAO::buscarTudo($_GET['s']);
                } else {
                    $postagens = PostagemDAO::listar();

                }


                if (empty($postagens)) {
                    ?>
                    <div class="text-center" role="alert">
                        Não há nenhuma postagem.
                    </div>
                    <?php
                }

                foreach ($postagens as $postagem) {
                    Componentes::cardPostagem($postagem);
                    Componentes::modalComentario($postagem);
                    Componentes::modalConfirmar($postagem);
                    Componentes::modalDenuncia($postagem);
                    Componentes::modalMostrarDenuncias($postagem);
                }


                ?>
            </div>
            <div class="col-4">
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

        </div>
    </main>
    <?php include "../incs/footer.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>
<script src="../assets/js/script.js"></script>

</html>