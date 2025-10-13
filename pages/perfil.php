<?php
include "../incs/valida-sessao.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.iconify.design/iconify-icon/1.0.8/iconify-icon.min.js"></script>
    <link rel="stylesheet" href="..\assets\css\style.css">
</head>

<body>
    <?php include "../incs/components/header.php"; ?>
    <main>
        <div class="container">
            <?php
            require_once "../src/UsuarioDAO.php";
            $id = $_SESSION['idusuario'];

            $usuario = UsuarioDAO::consultarUsuario($id);

            ?>
            <h1>Seja bem-vindo(a) <?= $usuario['nomeusuario'] ?>!</h1>
            <p><?= $usuario['email'] ?></p>
            <img src="uploads\<?= $usuario['foto'] ?>" alt="">
        </div>
    </main>
    <?php include "../incs/components/footer.php"; ?>
</body>

</html>