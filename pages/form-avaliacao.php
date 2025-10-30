<?php
include "../incs/valida-sessao.php";
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>O Crítico - Nova Avaliação</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.iconify.design/iconify-icon/1.0.8/iconify-icon.min.js"></script>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <?php include "../incs/header.php"; ?>
    <main>
        <div class="container py-4">
            <form action="../actions/posta-avaliacao.php" method="post" class="w-50 mx-auto text-start row">

                <?php
                if (isset($_SESSION['msg'])) {
                    echo '<div class="alert alert-danger" role="alert">';
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                    echo '</div>';
                } else {
                    echo '<div class="alert alert-info" role="alert">';
                    echo 'Preencha os dados da sua avaliação.';
                    echo '</div>';
                }
                ?>

                <!-- idconteudo (oculto ou recebido pela URL) -->
                <input type="hidden" name="idconteudo" value="<?= $_GET['idconteudo'] ?? '' ?>">
                <input type="hidden" name="idcategoria" value="<?= $_GET['idcategoria'] ?? '' ?>">

                <!-- Nota -->
                <div class="mb-3">
                    <label class="form-label">Nota</label>
                    <input type="number" class="form-control" name="nota" placeholder="De 1 a 10" min="0" max="10" required>
                </div>

                <!-- Texto -->
                <div class="mb-3">
                    <label class="form-label">Comentário</label>
                    <textarea class="form-control" name="texto" rows="4" placeholder="Digite sua opinião sobre o filme..." required></textarea>
                </div>

                <button type="submit" class="btn btn-primary btn-lg my-4">
                    Enviar Avaliação
                </button>
            </form>
        </div>
    </main>
    <?php include "../incs/footer.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
<script src="../assets/js/script.js"></script>
</html>
