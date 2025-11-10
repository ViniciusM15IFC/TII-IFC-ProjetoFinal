<?php
include "../incs/valida-sessao.php";
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>O Crítico - Perfil</title>
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
    <main>
        <div class="container w-75">
            <div class="text-center py-4">
                <?php
                require_once __DIR__ . "/../src/autoload.php";
                $idusuario = $_GET['idusuario'];
                $usuario = UsuarioDAO::consultarUsuario($idusuario);

                if (isset($usuario['foto']) && !empty($usuario['foto'])) {
                    $fotoPath = '../uploads/' . $usuario['foto'];
                } else {
                    $fotoPath = '../assets/img/default-profile.png';
                }
                ?>
                <img src="<?= $fotoPath ?>" alt="" class="rounded-circle img-profile">

                <h5 class="mt-3 mb-3"><?= $usuario['nomeusuario'] ?></h5>
                <div class="d-flex justify-content-center gap-5">
                    <div class="text-center">
                        <div class="fw-bold" data-bs-toggle="modal" data-bs-target="#Seguidores">Seguidores</div>
                        <p><?= SeguidoDAO::contarSeguidores($usuario['idusuario']) ?></p>
                        <?php
                        $seguidores = SeguidoDAO::listarSeguidores($usuario['idusuario']);
                        Componentes::modalUsuarios($seguidores, "Seguidores");
                        ?>
                    </div>
                    <div>
                        <div class="fw-bold" data-bs-toggle="modal" data-bs-target="#Seguindo">Seguindo</div>
                        <p><?= SeguidoDAO::contarSeguidos($usuario['idusuario']) ?></p>
                        <?php
                        $seguidos = SeguidoDAO::listarSeguidos($usuario['idusuario']);
                        Componentes::modalUsuarios($seguidos, "Seguindo");
                        ?>
                    </div>
                </div>
                <div class="d-flex justify-content-center gap-5">
                    <?php
                    if ($_GET['idusuario'] == $_SESSION['idusuario']) {
                        ?>
                        <div class="text-center">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#excluirPerfilModal<?= $_SESSION['idusuario'] ?>">Excluir Perfil</button>
                            <?php Componentes::modalExcluirPerfil($_SESSION['idusuario']); ?>
                        </div>
                        <?php
                    }
                    if (isset($_SESSION['idusuario']) && $_SESSION['idusuario'] != $usuario['idusuario']) {
                        if (SeguidoDAO::seguidoOuNao($_SESSION['idusuario'], $_GET['idusuario'])) {
                            ?>
                            <div class="text-center">
                                <a href="../actions/deixar-de-seguir.php?idseguido=<?= $_GET['idusuario'] ?>" class="btn btn-secondary">Deixar de Seguir</a>
                            </div>
                            <?php
                        } else {
                            ?>
                            <div class="text-center">
                                <a href="../actions/seguir.php?idseguido=<?= $usuario['idusuario'] ?>" class="btn btn-primary">Seguir</a>
                            </div>
                            <?php
                        }
                    }
                    ?>

                </div>

                </div>
                <section>
                    <?php
                    $postagens = PostagemDAO::listarPorUsuario($usuario['idusuario']);

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
                </section>
            </div>
    </main>
    <?php include "../incs/footer.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>

</body>
<script src="../assets/js/script.js"></script>

</html>