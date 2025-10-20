<?php
include "../incs/valida-sessao-admin.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>O Crítico - Cadastro de Conteúdo</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.iconify.design/iconify-icon/1.0.8/iconify-icon.min.js"></script>
    <link rel="stylesheet" href="..\assets\css\style.css">
</head>

<body>
    <?php include "../incs/header.php"; ?>
    <main>
        <div class="container">
            <form action="../actions/cadastra-conteudo.php" method="post" enctype="multipart/form-data" class="w-50 mx-auto text-start row">
                <?php
                if (isset($_SESSION['msg'])) {
                    echo '<div class="alert alert-danger" role="alert">';
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                    echo '</div>';
                } else {
                    echo '<div class="alert alert-info" role="alert">';
                    echo 'Informe os dados do conteúdo para realizar o cadastro.';
                    echo '</div>';
                }
                ?>
                <div class="mb-3">
                    <label class="form-label">Categoria</label>
                    <select class="form-select" id="categoria" name="categoria" required>
                        <option selected>Selecione</option>
                        <?php

                        $categorias = CategoriaDAO::consultar();

                        foreach ($categorias as $categoria) {
                            ?>
                            <option value="<?= $categoria['idcategoria'] ?>"><?= $categoria['nomecategoria'] ?></option>
                            <?php
                        }

                        ?>
                    </select>
                </div>
            
                

                <div class="mb-3">
                    <label class="form-label">Título</label>
                    <input type="text" class="form-control" name="titulo" placeholder="Titulo" required />
                </div>


                <div class="mb-3">
                    <label class="form-label">Genero</label>
                    <select class="form-select" id="genero" name="genero" required>
                        <option selected>Selecione</option>
                        <?php

                        $generos = GeneroDAO::consultar();

                        foreach ($generos as $genero) {
                            ?>
                            <option value="<?= $genero['idgenero'] ?>"><?= $genero['nomegenero'] ?></option>
                            <?php
                        }

                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Classificacao</label>
                    <select class="form-select" id="classificacao" name="classificacao" required>
                        <option selected>Selecione</option>
                        <?php

                        $classificacoes = ClassificacaoDAO::consultar();

                        foreach ($classificacoes as $classificacao) {
                            ?>
                            <option value="<?= $classificacao['idclassificacao'] ?>">
                                <?= $classificacao['nomeclassificacao'] ?>
                            </option>
                            <?php
                        }

                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Imagem</label>
                    <input type="file" class="form-control" name="imagem" placeholder="Insira uma imagem" />
                </div>
                <div class="mb-3">
                    <label class="form-label">Sinopse</label>
                    <textarea class="form-control" name="sinopse" rows="3" placeholder="Insira a sinopse"></textarea>
                </div>
                <?php
                    

                ?>
                <div id="form-filme">
                    <div class="mb-3">
                        <label class="form-label">Duração</label>
                        <input type="text" class="form-control" name="duracao" placeholder="1h23min" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Diretor</label>
                        <input type="text" class="form-control" name="diretor" placeholder="Christopher Nolan" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ano de Lançamento</label>
                        <input type="number" class="form-control" name="ano-lancamento" placeholder="2025" />
                    </div>

                </div>
                <div id="form-serie">
                    <div class="mb-3">
                        <label class="form-label">Número de Episódios</label>
                        <input type="number" class="form-control" name="episodios" placeholder="12" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Número de Temporadas</label>
                        <input type="number" class="form-control" name="temporadas" placeholder="3" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ano de Início</label>
                        <input type="number" class="form-control" name="ano-inicio" placeholder="3" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ano de Encerramento</label>
                        <input type="number" class="form-control" name="ano-encerramento"
                            placeholder="Deixar em branco caso ainda esteja em andamento" />
                    </div>
                </div>
                <div id="form-livro">
                    <div class="mb-3">
                        <label class="form-label">Número de Páginas</label>
                        <input type="number" class="form-control" name="paginas" placeholder="123" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Autor</label>
                        <input type="text" class="form-control" name="autor" placeholder="Agatha Christie" />
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-lg my-4">
                    Cadastrar
                </button>
            </form>
        </div>
    </main>
    <?php include "../incs/footer.php"; ?>
    <script src="../assets/js/form.js"></script>
</body>
<script src="../assets/js/script.js"></script>

</html>