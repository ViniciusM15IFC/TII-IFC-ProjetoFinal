<?php require_once '../src/autoload.php'; ?>

<header class="navbar navbar-expand-lg py-2 shadow-sm">
    <div class="container-fluid d-flex align-items-center justify-content-between mx-5">

        <!-- Lado esquerdo -->
        <div class="d-flex align-items-center gap-3">
            <iconify-icon icon="mdi:lightning-bolt-circle" class="fs-4"></iconify-icon>
            <a href="catalogo.php" class="nav-link fw-semibold">Catálogo</a>
            <a href="#" class="nav-link active border-bottom fw-semibold">Explorar</a>
        </div>

        <!-- Barra de pesquisa -->
        <form class="d-none d-md-flex align-items-center position-relative w-50">
            <input type="text" class="form-control rounded-pill ps-3 pe-5" placeholder=" ">
            <button class="btn position-absolute end-0 me-2 p-0 border-0 bg-transparent" type="submit">
                <iconify-icon icon="mdi:magnify" class="fs-5 text-secondary"></iconify-icon>
            </button>
        </form>


        <!-- Perfil -->
        <div class="d-flex align-items-center">
            <div>
                <?php
                if (!$_SESSION['foto']) {
                    $fotoPath = '../assets/img/profile-placeholder.png';
                } else {
                    $fotoPath = '../uploads/' . $_SESSION['foto'];
                }
                ?>
                <img src="<?= $fotoPath ?> "
                    class="bg-danger rounded-circle d-flex justify-content-center align-items-center me-2 prof-mini-img"
                    alt="">
            </div>
            <div class="dropdown">
                <a class="dropdown-toggle text-decoration-none fw-semibold" href="#" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <?= $_SESSION['nomeusuario']; ?>
                </a>
                <ul class="dropdown-menu dropdown-menu-end perfil-menu shadow">
                    <li><a class="dropdown-item" href="perfil.php">Ver Perfil</a></li>
                    <li>
                        <div class="dropdown-item d-flex justify-content-between align-items-center">
                            <span>Modo</span>
                            <button type="button" id="theme-switch" class="btn btn-sm btn-theme">
                                <iconify-icon icon="solar:moon-bold-duotone"></iconify-icon>
                            </button>
                        </div>
                    </li>

                    <div class="dropdown-divider"></div>

                    <li><a class="dropdown-item" href="home.php">Início</a></li>
                    <li><a class="dropdown-item" href="usuarios.php">Usuários</a></li>
                    <li><a class="dropdown-item" href="postagens.php">Postagens</a></li>
                    <li><a class="dropdown-item" href="../actions/logout.php">Sair</a></li>

                    <?php
                    if (AdminDAO::validarAdmin($_SESSION['idusuario'])) {
                        ?>
                        <li><a class="dropdown-item" href="form-cadastra-conteudo.php">Cadastrar Conteúdos</a></li>
                        <?php
                    }
                    ?>
                </ul>

            </div>
        </div>

    </div>
</header>