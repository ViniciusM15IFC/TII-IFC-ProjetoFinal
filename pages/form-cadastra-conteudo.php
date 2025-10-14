<?php
include "../incs/valida-sessao-admin.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.iconify.design/iconify-icon/1.0.8/iconify-icon.min.js"></script>
    <link rel="stylesheet" href="..\assets\css\style.css">
</head>

<body>
    <?php include "../incs/exibir-header.php"; ?>
    <main>
        <div class="container">
            <form action="../actions/cadastra-usuario.php" method="post" enctype="multipart/form-data"
                class="w-50 mx-auto text-start row">
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
                            <option value="<?= $categoria['id_categoria'] ?>"><?= $categoria['nome_categoria'] ?></option>
                            <?php
                        }

                        ?>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Email" required />
                </div>
                <div class="mb-3">
                    <label class="form-label">Data de Nascimento</label>
                    <input type="date" class="form-control" name="datanasc" placeholder="01/01/2025" required />
                </div>
                <div class="mb-3">
                    <label class="form-label">Imagem</label>
                    <input type="file" class="form-control" name="imagem" placeholder="Insira uma foto" />
                </div>
                <div class="mb-3">
                    <label class="form-label">Senha</label>
                    <input type="password" class="form-control" id="senha" name="senha" placeholder="Escreva sua Senha"
                        required />
                </div>
                <div class="mb-3">
                    <label class="form-label">Confirmar Senha</label>
                    <input type="password" class="form-control" id="confirmarsenha" name="confirmarsenha"
                        placeholder="Repita sua Senha" required />
                </div>
                <button type="submit" class="btn btn-primary btn-lg my-4">
                    Cadastrar
                </button>
            </form>
        </div>
    </main>
    <?php include "../incs/components/footer.php"; ?>
</body>

</html>