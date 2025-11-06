<?php
include "../incs/valida-sessao.php";
require_once __DIR__ . "/../src/autoload.php";

$tipo = $_GET['tipo'] ?? 'todos';
$termo = $_GET['s'] ?? '';

// Carrega os conteúdos
if (!empty($termo)) {
    $conteudos = ConteudoDAO::buscarConteudos($termo);
    $tituloPagina = "Resultados da busca por: " . htmlspecialchars($termo);
} else {
    switch ($tipo) {
        case 'filmes':
            $conteudos = FilmeDAO::listar();
            $tituloPagina = "Filmes";
            break;

        case 'series':
            $conteudos = SerieDAO::listar();
            $tituloPagina = "Séries";
            break;

        case 'livros':
            $conteudos = LivroDAO::listar();
            $tituloPagina = "Livros";
            break;

        default:
            $conteudos = [];
            $filmes = FilmeDAO::listar();
            $series = SerieDAO::listar();
            $livros = LivroDAO::listar();
            $tituloPagina = "Catálogo Completo";
            break;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>O Crítico - <?= htmlspecialchars($tituloPagina) ?></title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.iconify.design/iconify-icon/1.0.8/iconify-icon.min.js"></script>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <?php include "../incs/header.php"; ?>

    <main>
        <div class="container py-5 w-75">
            <h2 class="mb-5"><?= htmlspecialchars($tituloPagina) ?></h2>

            <?php
            // Se é busca ou tipo específico
            if (!empty($termo) || $tipo !== 'todos') {
                if (empty($conteudos)) {
                    echo '<p class="text-center text-muted">Nenhum conteúdo encontrado.</p>';
                } else {
                    ?>
                    <div class="slider-container">
                        <button class="btn-slide btn-left" onclick="scroll_slider(this, -300)">&#10094;</button>
                        <div class="slider d-flex" id="sliderConteudo">
                            <?php
                            foreach ($conteudos as $c) {
                                Componentes::cardConteudo($c);
                            }
                            ?>
                        </div>
                        <button class="btn-slide btn-right" onclick="scroll_slider(this, 300)">&#10095;</button>
                    </div>
                    <?php
                }
            }
            // Se tipo = todos, mostra por categoria
            else {
                ?>
                <!-- Slider de Filmes -->
                <?php if (!empty($filmes)): ?>
                    <div class="slider-container">
                        <h4 class="mb-3">Filmes</h4>
                        <button class="btn-slide btn-left" onclick="scroll_slider(this, -300)">&#10094;</button>
                        <div class="slider d-flex" id="sliderFilmes">
                            <?php
                            foreach ($filmes as $filme) {
                                $filme['categoria_nome'] = 'Filme';
                                Componentes::cardConteudo($filme);
                            }
                            ?>
                        </div>
                        <button class="btn-slide btn-right" onclick="scroll_slider(this, 300)">&#10095;</button>
                    </div>
                <?php endif; ?>

                <!-- Slider de Séries -->
                <?php if (!empty($series)): ?>
                    <div class="slider-container">
                        <h4 class="mb-3">Séries</h4>
                        <button class="btn-slide btn-left" onclick="scroll_slider(this, -300)">&#10094;</button>
                        <div class="slider d-flex" id="sliderSeries">
                            <?php
                            foreach ($series as $serie) {
                                $serie['categoria_nome'] = 'Série';
                                Componentes::cardConteudo($serie);
                            }
                            ?>
                        </div>
                        <button class="btn-slide btn-right" onclick="scroll_slider(this, 300)">&#10095;</button>
                    </div>
                <?php endif; ?>

                <!-- Slider de Livros -->
                <?php if (!empty($livros)): ?>
                    <div class="slider-container">
                        <h4 class="mb-3">Livros</h4>
                        <button class="btn-slide btn-left" onclick="scroll_slider(this, -300)">&#10094;</button>
                        <div class="slider d-flex" id="sliderLivros">
                            <?php
                            foreach ($livros as $livro) {
                                $livro['categoria_nome'] = 'Livro';
                                Componentes::cardConteudo($livro);
                            }
                            ?>
                        </div>
                        <button class="btn-slide btn-right" onclick="scroll_slider(this, 300)">&#10095;</button>
                    </div>
                <?php endif; ?>

                <?php
            }
            ?>
        </div>
    </main>

    <?php include "../incs/footer.php"; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
    <script>
        function scroll_slider(button, direction) {
            const slider = button.parentElement.querySelector('.slider');
            slider.scrollBy({
                left: direction,
                behavior: 'smooth'
            });
        }
    </script>
    <script src="../assets/js/script.js"></script>
    <?php Componentes::exibirAlert(); ?>
    <script src="../assets/js/alert.js"></script>
    <script src="../assets/js/rating.js"></script>
</body>

</html>