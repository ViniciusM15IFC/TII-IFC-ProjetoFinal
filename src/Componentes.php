<?php

require_once __DIR__ . "/../src/autoload.php";

class Componentes
{
    public static function cardUsuario($usuario)
    {
        $idUsuarioLogado = $_SESSION['idusuario'];
        $seguidos = SeguidoDAO::listarSeguidos($idUsuarioLogado); // retorna array de usuários seguidos
        $idsSeguidos = array_column($seguidos, 'idusuario'); // só pega os IDs
        ?>
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="../uploads/<?= $usuario['foto'] ?>" class="img-fluid rounded-start">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title"><?= $usuario['nomeusuario'] ?></h5>
                        <p class="card-text"><small class="text-muted">Email: <?= $usuario['email'] ?></small></p>
                        <p class="card-text"><small class="text-muted">Data de Nascimento: <?= $usuario['datanasc'] ?></small>
                        </p>

                        <?php if (!in_array($usuario['idusuario'], $idsSeguidos) && $usuario['idusuario'] != $idUsuarioLogado): ?>
                            <a href="../actions/seguir.php?idseguido=<?= $usuario['idusuario'] ?>"
                                class="col-4 btn btn-secondary my-1">
                                Seguir
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    // ---------------------------
    // COMPONENTE: FILME
    // ---------------------------
    public static function cardFilme($filme)
    {
        ?>
        <div class="card mb-3 shadow-sm">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="../uploads/<?= $filme['imagem'] ?>" class="img-fluid rounded-start"
                        alt="Capa do filme <?= $filme['nomefilme'] ?>">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($filme['nomefilme']) ?></h5>
                        <p class="card-text"><?= nl2br(htmlspecialchars($filme['sinopse'])) ?></p>
                        <p class="card-text"><small class="text-muted">Lançamento:
                                <?= htmlspecialchars($filme['anofilme'] ?? '—') ?></small></p>
                        <a href="detalhes.php?idconteudo=<?= $filme['idfilme'] ?>&tipo=filme" class="btn btn-primary">Ver
                            mais</a>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    // ---------------------------
    // COMPONENTE: SÉRIE
    // ---------------------------
    public static function cardSerie($serie)
    {
        ?>
        <div class="card mb-3 shadow-sm">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="../uploads/<?= htmlspecialchars($serie['imagem']) ?>" class="img-fluid rounded-start"
                        alt="Capa da série <?= htmlspecialchars($serie['nomeserie']) ?>">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($serie['nomeserie']) ?></h5>
                        <p class="card-text"><?= nl2br(htmlspecialchars($serie['sinopse'])) ?></p>
                        <p class="card-text"><small class="text-muted">Temporadas:
                                <?= htmlspecialchars($serie['temporadas'] ?? '—') ?></small></p>
                        <a href="detalhes.php?idconteudo=<?= $serie['idserie'] ?>&tipo=serie" class="btn btn-primary">Ver
                            mais</a>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    // ---------------------------
    // COMPONENTE: LIVRO
    // ---------------------------
    public static function cardLivro($livro)
    {
        ?>
        <div class="card mb-3 shadow-sm">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="../uploads/<?= htmlspecialchars($livro['imagem']) ?>" class="img-fluid rounded-start"
                        alt="Capa do livro <?= htmlspecialchars($livro['nomelivro']) ?>">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($livro['nomelivro']) ?></h5>
                        <p class="card-text"><?= nl2br(htmlspecialchars($livro['sinopse'])) ?></p>
                        <p class="card-text"><small class="text-muted">Autor:
                                <?= htmlspecialchars($livro['autor'] ?? '—') ?></small></p>
                        <a href="detalhes.php?idconteudo=<?= $livro['idlivro'] ?>&tipo=livro" class="btn btn-primary">Ver
                            mais</a>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    public static function cardPostagem($postagem)
    {
        ?>

        <?php
    }
}