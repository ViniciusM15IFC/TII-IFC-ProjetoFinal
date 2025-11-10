<?php
require_once __DIR__ . "/../src/autoload.php";
session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>O Crítico - Cadastro</title>
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class="h-100 m-0">
  <div class="hero-section">
    <!-- Moldura branca -->
    <div class="m-3 border border-white border-3 position-absolute top-0 start-0 end-0 bottom-0"
      style="pointer-events: none;"></div>

    <div class="content-wrapper min-vh-100 d-flex align-items-center">
      <div class="container">
        <div class="row justify-content-start">
          <div class="col-lg-6 col-md-8">
            <div class="login-card">
              <form action="../actions/cadastra-usuario.php" method="post" enctype="multipart/form-data">
                <h2 class="text-white fw-bold mb-4">Criar Conta</h2>

                <div class="mb-3">
                  <label class="form-label text-white fw-semibold">Nome de Usuário</label>
                  <input type="text" class="form-control" name="nome" placeholder="Seu nome" required>
                </div>

                <div class="mb-3">
                  <label class="form-label text-white fw-semibold">Email</label>
                  <input type="email" class="form-control" name="email" placeholder="exemplo@email.com" required>
                </div>

                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label class="form-label text-white fw-semibold">Data de Nascimento</label>
                    <input type="date" class="form-control" name="datanasc" required>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label class="form-label text-white fw-semibold">Imagem de Perfil</label>
                    <input type="file" class="form-control" name="imagem" accept="image/*">
                  </div>
                </div>

                <div class="mb-3">
                  <label class="form-label text-white fw-semibold">Senha</label>
                  <input type="password" class="form-control" id="senha" name="senha" placeholder="********" required>
                </div>

                <div class="mb-4">
                  <label class="form-label text-white fw-semibold">Confirmar Senha</label>
                  <input type="password" class="form-control" id="confirmarsenha" name="confirmarsenha"
                    placeholder="********" required>
                </div>

                <div class="d-grid mb-3">
                  <button type="submit" class="btn btn-entrar-form py-2 fw-semibold">Cadastrar</button>
                </div>

                <div class="text-center">
                  <a href="login.php" class="text-white text-decoration-none">ou
                    <strong>Entrar</strong></a>
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
  <?php Componentes::exibirAlert(); ?>
  <script src="../assets/js/alert.js"></script>
</body>

</html>
