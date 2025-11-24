<?php
include "../incs/valida-sessao.php";
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>O Crítico - Explorar</title>
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://code.iconify.design/iconify-icon/1.0.8/iconify-icon.min.js"></script>
  <link rel="stylesheet" href="../assets/css/style.css">
  <script>
    if (localStorage.getItem('darkmode') === 'active') {
      document.documentElement.classList.add('darkmode');
    }
    else if (localStorage.getItem('darkmode') === 'inactive') {
      document.documentElement.classList.remove('darkmode');
    }
  </script>
</head>

<body>
  <?php include "../incs/header.php"; ?>

  <main>
    <div class="container my-4 w-75">
      <div class="row g-4">

        <!-- COLUNA PRINCIPAL -->
        <div class="col-8">
          <h3>Postagens</h3>

          <?php
          require_once __DIR__ . "/../src/autoload.php";

          if (isset($_GET['s'])) {
            $postagens = PostagemDAO::buscarTudo($_GET['s']);
          } else {
            $postagens = PostagemDAO::listar();
          }

          if (empty($postagens)) {
            echo '<div class="text-center" role="alert">Não há nenhuma postagem.</div>';
          } else {
            foreach ($postagens as $postagem) {
              Componentes::exibirPostagemCompleta($postagem);
            }
          }
          ?>
        </div>

        <!-- SIDEBAR DIREITA -->
        <div class="col-4">
          <div class="position-sticky top-0 sidebar-box p-3 border border-1 rounded-3 content-wrap my-3">
            <section id="explorarUsuarios">

            
            <h5 class="text-center mb-3">Usuários Recomendados</h5>

            <?php
            $idUsuarioLogado = $_SESSION['idusuario'];
            $seguidos = SeguidoDAO::listarSeguidos($idUsuarioLogado);
            $idsSeguidos = array_column($seguidos, 'idusuario');

            $nome = $_GET['nome'] ?? '';

            if ($_SERVER['REQUEST_METHOD'] === 'GET' && $nome !== '') {
              $usuarios = UsuarioDAO::buscarUsuarios($nome);
            } else {
              $usuarios = UsuarioDAO::listarUsuarios();
            }

            foreach ($usuarios as $usuario) {
              if ($idUsuarioLogado !== $usuario['idusuario']) {
                Componentes::cardUsuario($usuario);
              }
            }
            ?>
            </section>
            <section>

            </section>
          </div>
        </div>
      </div>
    </div>
  </main>

  <script src="../assets/js/script.js"></script>
  <?php include "../incs/footer.php"; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>
