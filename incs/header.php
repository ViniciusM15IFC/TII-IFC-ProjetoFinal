<?php require_once '../src/autoload.php'; ?>

<header class="navbar navbar-expand-lg py-2 shadow-sm">
    <div class="container-fluid d-flex align-items-center justify-content-between mx-5">

        <!-- Lado esquerdo -->
        <div class="d-flex align-items-center gap-3">
            <a href="home.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'home.php') ? 'active' : ''; ?>">
                <iconify-icon icon="mdi:lightning-bolt-circle" class="fs-4"></iconify-icon>
            </a>
            <a href="catalogo.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'catalogo.php') ? 'active' : ''; ?>">Catálogo</a>
            <a href="explorar.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'explorar.php') ? 'active' : ''; ?>">Explorar</a>
        </div>

        <!-- Barra de pesquisa -->
        <form class="d-none d-md-flex align-items-center position-relative w-50" method="get" action="">
            <input type="text" class="form-control rounded-pill ps-3 pe-5" name="s" placeholder=" ">
            <!-- Campo oculto para manter o idusuario -->
            <?php
             if (isset($_GET['idusuario'])) {
                 ?>
                 <input type="hidden" name="idusuario" value="<?= $_GET['idusuario'] ?>">
                 <?php
             }
             ?>
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
                    <li><a class="dropdown-item" href="perfil.php?idusuario=<?= $_SESSION['idusuario'] ?>">Ver
                            Perfil</a>
                    </li>

                    <div class="dropdown-divider"></div>

                    <li><a class="dropdown-item" href="home.php">Início</a></li>
                    <li><a class="dropdown-item" href="usuarios.php">Usuários</a></li>
                    <li><a class="dropdown-item" href="home.php">Feed</a></li>
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
            <button type="button" id="theme-switch" class="btn btn-sm btn-theme ms-4" onClick="toggleDarkMode()">
                <iconify-icon icon="solar:moon-bold-duotone"></iconify-icon>
            </button>
        </div>

    </div>
</header>
