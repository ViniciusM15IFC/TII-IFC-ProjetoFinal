<?php require_once '../src/autoload.php'; ?>

<header class="navbar navbar-expand-lg py-2 shadow-sm">
    <div class="container d-flex align-items-center justify-content-between w-100 gap-5">
        <!-- Lado esquerdo -->
        <div class="d-flex align-items-center gap-3 mb-2">
            <a href="home.php"
                class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'home.php') ? 'active' : ''; ?>">
                <div class="logo"></div>
            </a>
            <a href="catalogo.php"
                class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'catalogo.php') ? 'active' : ''; ?>">Catálogo</a>
            <a href="explorar.php"
                class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'explorar.php') ? 'active' : ''; ?>">Explorar</a>
        </div>

        <!-- Barra de pesquisa -->
        <form class="d-flex align-items-center position-relative w-100 mb-2" method="get" action="">
            <input type="text" class="form-control rounded-pill ps-3 pe-5" name="s" placeholder=" ">
            <?php if (isset($_GET['idusuario'])): ?>
                <input type="hidden" name="idusuario" value="<?= $_GET['idusuario'] ?>">
            <?php endif; ?>
            <button class="btn position-absolute end-0 me-2 p-0 border-0 bg-transparent" type="submit">
                <iconify-icon icon="mdi:magnify" class="fs-5 text-secondary"></iconify-icon>
            </button>
        </form>

        <!-- Perfil -->
        <div class="d-flex align-items-center mb-2">
            <div>
                <?php
                if (!$_SESSION['foto']) {
                    $fotoPath = '../assets/img/profile-placeholder.png';
                } else {
                    $fotoPath = '../uploads/' . $_SESSION['foto'];
                }
                ?>
                <img src="<?= $fotoPath ?>" alt="Foto de perfil" class="rounded-circle me-2"
                    style="width:36px; height:36px; object-fit:cover;">
            </div>

            <div class="dropdown">
                <a class="dropdown-toggle text-decoration-none fw-semibold" href="#" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <?= $_SESSION['nomeusuario']; ?>
                </a>
                <ul class="dropdown-menu dropdown-menu-end perfil-menu shadow">
                    <li><a class="dropdown-item" href="perfil.php?idusuario=<?= $_SESSION['idusuario'] ?>">Ver
                            Perfil</a></li>
                    <div class="dropdown-divider"></div>
                    <li><a class="dropdown-item" href="home.php">Início</a></li>
                    <li><a class="dropdown-item" href="home.php">Feed</a></li>
                    <li><a class="dropdown-item" href="../actions/logout.php">Sair</a></li>

                    <?php if (AdminDAO::validarAdmin($_SESSION['idusuario'])): ?>
                        <li><a class="dropdown-item" href="form-cadastra-conteudo.php">Cadastrar Conteúdos</a></li>
                    <?php endif; ?>
                </ul>
            </div>

            <button type="button" id="theme-switch" class="btn btn-sm btn-theme ms-3" onclick="toggleMode()">
                <iconify-icon icon="solar:moon-bold-duotone"></iconify-icon>
            </button>
        </div>
    </div>
</header>