<?php
include "../incs/valida-sessao.php";
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>O Crítico - Feed</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.iconify.design/iconify-icon/1.0.8/iconify-icon.min.js"></script>
    <script>
        if (localStorage.getItem('darkmode') === 'active') {
            document.documentElement.classList.add('darkmode');
        }
    </script>
    <link rel="stylesheet" href="..\assets\css\style.css">
</head>

<body>
    <?php include "../incs/header.php"; ?>
    <main class="">
        <div class="container my-4 w-75 align-items-center">
            <p>Postagens de quem você segue</p>

            <?php
            require_once __DIR__ . "/../src/autoload.php";

            if (isset($_GET['s'])) {
                $postagens = PostagemDAO::buscarFeed($_SESSION['idusuario'], $_GET['s']);
            } else {
                $postagens = PostagemDAO::listarFeed($_SESSION['idusuario']);

            }


            if (empty($postagens)) {
                ?>
                <div class="text-center" role="alert">
                    Não há nenhuma postagem.
                </div>
                <?php
            }

            foreach ($postagens as $postagem) {
                Componentes::exibirPostagemCompleta($postagem);
            }


            ?>
        </div>
    </main>
    <?php include "../incs/footer.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>
<script src="../assets/js/script.js"></script>

</html>