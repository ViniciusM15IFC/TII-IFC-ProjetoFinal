<?php
include "../incs/valida-sessao.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>O Crítico</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.iconify.design/iconify-icon/1.0.8/iconify-icon.min.js"></script>
    <link rel="stylesheet" href="..\assets\css\style.css">
</head>

<body>
    <?php include "../incs/header.php"; ?>
    <main class="my-4 w-75 align-items-center" >
        <div class="container ">
            <?php
                require_once __DIR__ . "/../src/autoload.php";

                $postagens = PostagemDAO::listarFeed($_SESSION['idusuario']);

                foreach ($postagens as $postagem) {
                    Componentes::cardPostagem($postagem);
                }

            ?>
        </div>
    </main>
    <?php include "../incs/footer.php"; ?>
</body>
<script src="../assets/js/script.js"></script>
</html>