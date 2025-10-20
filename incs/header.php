<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Meu Projeto</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="home.php">Início</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="form-cadastra-usuario.php">Cadastro</a></li>
                    <li class="nav-item"><a class="nav-link" href="usuarios.php">Usuários</a></li>
                    <li class="nav-item"><a class="nav-link" href="catalogo.php">Catálogo</a></li>
                    <li class="nav-item"><a class="nav-link" href="postagens.php">Postagens</a></li>
                    <li class="nav-item"><a class="nav-link" href="../actions/logout.php">Sair</a></li>
                    


                    <?php
                    require_once __DIR__ . "/../src/autoload.php";

                    if (AdminDAO::validarAdmin($_SESSION['idusuario'])) {
                        ?>
                        <li class="nav-item"><a class="nav-link" href="form-cadastra-conteudo.php">Cadastrar Conteúdos</a>
                        </li>
                        <?php
                    }

                    ?>
                    <button type="button" id="theme-switch"><iconify-icon
                            icon="solar:moon-bold-duotone"></iconify-icon></button>
                </ul>
            </div>
        </div>
    </nav>
</header>