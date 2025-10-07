<?php
    include "../incs/valida-sessao.php";   
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Página Inicial</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous" />
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Meu Projeto</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Início</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="form-cadastra-usuario.html">Cadastro</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Conteúdo Principal -->
    <main class="container text-center my-5">
        <h2 class="display-4">Bem-vindo!</h2>
        <p class="lead">Cadastre-se em nosso site.</p>
        <form class="w-50 mx-auto text-start row">
            <div class="mb-3">
                <label class="form-label">Nome de Usuário</label>
                <input type="text" class="form-control" name="nome" placeholder="Nome" required />
            </div>

            <button type="submit" class="btn btn-primary btn-lg my-4">
                Buscar
            </button>
        </form>
        <div class="container w-50 mx-auto text-start row">
        

            <?php
            require_once "../src/UsuarioDAO.php";
            $usuarios = UsuarioDAO::listarUsuarios();

            foreach ($usuarios as $usuario) {
                $idUsuarioLogado = $_SESSION['idusuario'];

                if ($idUsuarioLogado !== $usuario['idusuario']) {
                    ?>
                    <div class="d-flex row w-50">
                        <p class="col-8"><?= $usuario['nomeusuario'] ?></p>
                        <a href="../actions/seguir-function.php/?idseguidor=<?= $usuario['idusuario'] ?>" class="col-4 btn btn-secondary my-1" onclick="">Seguir</a>
                    </div>
                    <?php
                }


            }
            ?>

        </div>

    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <p class="mb-0">
            &copy; 2025 - Minha Página. Todos os direitos reservados.
        </p>
    </footer>
</body>

</html>