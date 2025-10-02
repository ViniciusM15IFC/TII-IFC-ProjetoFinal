<?php
    include "incs/valida-sessao.php";   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        require_once "src/UsuarioDAO.php";
        $email = $_SESSION['email'];

        $usuario = UsuarioDAO::consultarUsuario($email);


        
    ?>
    <h1>Seja bem-vindo(a) <?= $usuario['nomeusuario'] ?>!</h1>
    <img src="uploads\<?= $usuario['foto'] ?>" alt="">
</body>
</html>