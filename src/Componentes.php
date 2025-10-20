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
                        <a href="../pages/form-avaliacao.php?idconteudo=<?= $filme['idfilme'] ?>>&idcategoria=1"
                            class="col-4 btn btn-secondary my-1">
                            Avaliar
                        </a>
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
                        <a href="../pages/form-avaliacao.php?idconteudo=<?= $serie['idserie'] ?>>&idcategoria=2"
                            class="col-4 btn btn-secondary my-1">
                            Avaliar
                        </a>
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
                        <a href="../pages/form-avaliacao.php?idconteudo=<?= $livro['idlivro'] ?>>&idcategoria=3"
                            class="col-4 btn btn-secondary my-1">
                            Avaliar
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    public static function cardPostagem($postagem)
    {
        ?>
        <div class="card mb-4 shadow-sm">
            <div class="card-header d-flex align-items-center">
                <img src="../uploads/<?= htmlspecialchars($postagem['foto'] ?? '../assets/img/default-user.png') ?>"
                    alt="Foto de <?= htmlspecialchars($postagem['nomeusuario']) ?>" class="rounded-circle me-2"
                    style="width:40px; height:40px; object-fit:cover;">
                <strong><?= htmlspecialchars($postagem['nomeusuario']) ?></strong>
                <small class="text-muted ms-auto"><?= date('d/m/Y H:i', strtotime($postagem['datapostagem'])) ?></small>
            </div>
            <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($postagem['nomeconteudo']) ?></h5>
                <?php if (!empty($postagem['nota'])): ?>
                    <p class="card-text"><strong>Nota:</strong> <?= htmlspecialchars($postagem['nota']) ?>/10</p>
                <?php endif; ?>
                <p class="card-text"><?= nl2br(htmlspecialchars($postagem['texto'])) ?></p>
            </div>
        </div>
        <?php
    }
}