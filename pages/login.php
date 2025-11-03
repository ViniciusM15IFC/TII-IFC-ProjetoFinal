<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>O Crítico - Login</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class="h-100 m-0">
    <div class="hero-section">
        <div class="m-3 border border-white border-3 position-absolute top-0 start-0 end-0 bottom-0"
            style="pointer-events: none;"></div>
        <div class="content-wrapper min-vh-100 d-flex align-items-center">
            <div class="container">
                <div class="row justify-content-start">
                    <div class="col-lg-5 col-md-7">
                        <div class="login-card">
                            <form action="../actions/efetua-login.php" method="post">
                                <h2 class="text-white fw-bold mb-4">Login</h2>

                                <?php
                                session_start();
                                if (isset($_SESSION['msg'])) {
                                    echo '<div class="alert alert-danger" role="alert">';
                                    echo $_SESSION['msg'];
                                    unset($_SESSION['msg']);
                                    echo '</div>';
                                } else {
                                    echo '<div class="alert alert-info" role="alert">';
                                    echo 'Informe seu email e senha para entrar.';
                                    echo '</div>';
                                }
                                ?>

                                <div class="mb-3">
                                    <label for="email" class="form-label text-white fw-semibold">Email</label>
                                    <input type="email" name="email" id="email" class="form-control"
                                        placeholder="exemplo@gmail.com" required>
                                </div>

                                <div class="mb-4">
                                    <label for="senha" class="form-label text-white fw-semibold">Senha</label>
                                    <input type="password" name="senha" id="senha" class="form-control"
                                        placeholder="********" required>
                                </div>

                                <div class="d-grid mb-3">
                                    <button type="submit" class="btn btn-entrar-form py-2 fw-semibold">Entrar</button>
                                </div>

                                <div class="text-center">
                                    <a href="form-cadastra-usuario.php" class="text-white text-decoration-none">ou <strong>Criar Conta</strong></a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>