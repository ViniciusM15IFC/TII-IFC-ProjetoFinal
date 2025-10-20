<?php
include "../incs/valida-sessao.php";
require_once __DIR__ . "/../src/autoload.php";


// DAO genérico para buscar todos os conteúdos
$tipo = $_GET['tipo'] ?? 'todos'; // filmes, series, livros ou todos

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
        // caso "todos", buscar tudo e juntar os arrays
        $filmes = FilmeDAO::listar();
        $series = SerieDAO::listar();
        $livros = LivroDAO::listar();
        $conteudos = [
            'filmes' => $filmes,
            'series' => $series,
            'livros' => $livros
        ];
        $tituloPagina = "Catálogo Completo";
        break;
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
        <div class="container my-4">
            <h2 class="mb-4 text-center"><?= htmlspecialchars($tituloPagina) ?></h2>

            <!-- FILTRO -->
            <div class="d-flex justify-content-center mb-4">
                <a href="?tipo=todos" class="btn btn-outline-primary mx-2 <?= $tipo === 'todos' ? 'active' : '' ?>">Todos</a>
                <a href="?tipo=filmes" class="btn btn-outline-primary mx-2 <?= $tipo === 'filmes' ? 'active' : '' ?>">Filmes</a>
                <a href="?tipo=series" class="btn btn-outline-primary mx-2 <?= $tipo === 'series' ? 'active' : '' ?>">Séries</a>
                <a href="?tipo=livros" class="btn btn-outline-primary mx-2 <?= $tipo === 'livros' ? 'active' : '' ?>">Livros</a>
            </div>

            <!-- CONTEÚDOS -->
            <div class="row row-cols-1 row-cols-md-2 g-4">
                <?php
                if ($tipo === 'todos') {
                    foreach ($conteudos['filmes'] as $filme) {
                        echo '<div class="col">';
                        Componentes::cardFilme($filme);
                        echo '</div>';
                    }

                    foreach ($conteudos['series'] as $serie) {
                        echo '<div class="col">';
                        Componentes::cardSerie($serie);
                        echo '</div>';
                    }

                    foreach ($conteudos['livros'] as $livro) {
                        echo '<div class="col">';
                        Componentes::cardLivro($livro);
                        echo '</div>';
                    }
                } else {
                    if (empty($conteudos)) {
                        echo '<p class="text-center text-muted">Nenhum conteúdo encontrado.</p>';
                    } else {
                        foreach ($conteudos as $c) {
                            echo '<div class="col">';
                            switch ($tipo) {
                                case 'filmes':
                                    Componentes::cardFilme($c);
                                    break;
                                case 'series':
                                    Componentes::cardSerie($c);
                                    break;
                                case 'livros':
                                    Componentes::cardLivro($c);
                                    break;
                            }
                            echo '</div>';
                        }
                    }
                }
                ?>
            </div>
        </div>
    </main>
    <?php include "../incs/footer.php"; ?>
</body>
<script src="../assets/js/script.js"></script>
</html>
