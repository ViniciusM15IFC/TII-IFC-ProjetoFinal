<?php

require_once __DIR__ . "/../src/autoload.php";

class Componentes
{
    public static function cardUsuario($usuario)
    {
        $idUsuarioLogado = $_SESSION['idusuario'];
        $seguidos = SeguidoDAO::listarSeguidos($idUsuarioLogado); // retorna array de usuários seguidos
        $idsSeguidos = array_column($seguidos, 'idusuario'); // só pega os IDs

        if (!$usuario['foto']) {
            $fotoPath = '../assets/img/profile-placeholder.png';
        } else {
            $fotoPath = '../uploads/' . $usuario['foto'];
        }

        ?>
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="../uploads/<?= $fotoPath ?>" class="img-fluid rounded-start">
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
        $jaCurtiu = CurtidaDAO::usuarioCurtiu($_SESSION['idusuario'], $postagem['idpostagem']);
        if (!$postagem['foto']) {
            $fotoPath = '../assets/img/profile-placeholder.png';
        } else {
            $fotoPath = '../uploads/' . $postagem['foto'];
        }
        ?>
        <div class="card-post mb-4 p-3 rounded-4 shadow-sm text-light mx-auto">
            <!-- Topo -->
            <div class="d-flex align-items-center mb-2">
                <div class="user-icon me-2">

                    <?php
                    if (!$postagem['foto']) {
                        $fotoPath = '../assets/img/profile-placeholder.png';
                    } else {
                        $fotoPath = '../uploads/' . $postagem['foto'];
                    }
                    ?>
                    <img src="<?= $fotoPath ?>" alt="Foto de <?= htmlspecialchars($postagem['nomeusuario']) ?>"
                        class="rounded-circle" style="width:40px; height:40px; object-fit:cover;">

                </div>
                <h6 class="mb-0 me-2 fw-semibold"><?= htmlspecialchars($postagem['nomeusuario']) ?></h6>
                <?php
                $idUsuarioLogado = $_SESSION['idusuario'] ?? null;
                $idAutor = $postagem['idusuario'];

                if ($idUsuarioLogado && $idAutor != $idUsuarioLogado) {
                    $seguido = SeguidoDAO::seguidoOuNao($idUsuarioLogado, $idAutor);

                    if (empty($seguido)) {
                        // Não segue ainda
                        ?>
                        <a href="../actions/seguir.php?idseguido=<?= $idAutor ?>" class="seguir-btn">Seguir</a>
                        <?php
                    }
                }
                ?>
                <small class="text-secondary ms-auto">
                    <?= date('d/m/Y H:i', strtotime($postagem['datapostagem'])) ?>
                </small>
            </div>

            <!-- Corpo -->
            <div class="row align-items-start">
                <div class="col-md-8">
                    <p class="mb-0 ts-1 fs-5">
                        <?= nl2br(htmlspecialchars($postagem['texto'])) ?>
                    </p>
                </div>

                <!-- Imagem lateral + estrelas -->
                <?php if (!empty($postagem['nomeconteudo'])): ?>
                    <div class="col-md-4 d-flex justify-content-end align-items-center mt-3 mt-md-0">
                        <div class="d-flex align-items-center">
                            <div class="rating-vertical">
                                <?php
                                // A avaliação está de 1 a 10, então dividimos por 2 para ter uma escala de 1 a 5
                                $nota = floatval($postagem['nota'] ?? 0) / 2; // Divide a nota para mapear para o sistema de 5 estrelas
                    
                                for ($i = 1; $i <= 5; $i++) {
                                    $starFraction = $nota - ($i - 1); // Calcula a parte da estrela que falta para o número da estrela atual
                    
                                    if ($starFraction >= 1) {
                                        // Estrela cheia
                                        echo '<iconify-icon icon="ic:round-star"></iconify-icon>';
                                    } elseif ($starFraction >= 0.5) {
                                        // Estrela meio cheia (se for mais que 0.5, mas menos que 1)
                                        echo '<iconify-icon icon="ic:round-star-half"></iconify-icon>';
                                    } else {
                                        // Estrela vazia
                                        echo '<iconify-icon icon="ic:round-star-border"></iconify-icon>';
                                    }
                                }
                                ?>
                            </div>
                            <div class="text-center ms-2">
                                <img src="../uploads/<?= htmlspecialchars($postagem['imagemconteudo'] ?? 'https://via.placeholder.com/120x160') ?>"
                                    alt="<?= htmlspecialchars($postagem['nomeconteudo']) ?>" class="game-img mb-1">
                                <p class="small text-light-50 mb-0"><?= htmlspecialchars($postagem['nomeconteudo']) ?></p>
                            </div>
                        </div>
                    </div>

                <?php endif; ?>
            </div>

            <div class="divider"></div>

            <!-- Rodapé -->
            <div class="d-flex align-items-center justify-content-between footer-icons">
                <div class="d-flex align-items-center">
                    <form action="../actions/curte-postagem.php" method="POST" style="display:inline;">
                        <input type="hidden" name="idpostagem" value="<?= $postagem['idpostagem'] ?>">
                        <?php if ($jaCurtiu): ?>
                            <button type="submit" name="acao" value="descurtir"
                                class="btn p-0 border-0 bg-transparent text-danger d-flex align-items-center justify-content-center">
                                <iconify-icon icon="mdi:heart"></iconify-icon>
                            </button>
                        <?php else: ?>
                            <button type="submit" name="acao" value="curtir"
                                class="btn p-0 border-0 bg-transparent text-light d-flex align-items-center justify-content-center">
                                <iconify-icon icon="mdi:heart-outline"></iconify-icon>
                            </button>
                        <?php endif; ?>
                    </form>
                        <button ><iconify-icon icon="ant-design:comment-outlined"
                                class="ms-3" data-bs-toggle="modal"
                            data-bs-target="#comentarioModal<?= $postagem['idpostagem'] ?>"></iconify-icon></button>  
                </div>
                <iconify-icon icon="jam:triangle-danger"></iconify-icon>
            </div>


        </div>
        <?php
    }

    public static function cardComentario($comentario)
    {
        ?>
        <div class="card mb-2">
            <div class="card-body">
                <h6 class="card-title"><?= htmlspecialchars($comentario['nomeusuario']) ?></h6>
                <p class="card-text"><?= nl2br(htmlspecialchars($comentario['texto']))  ?></p>
            </div>  
        <?php
    }
    public static function modalComentario($postagem)
    {
        ?>
        <!-- Modal de Comentário -->
        <div class="modal fade" id="comentarioModal<?= $postagem['idpostagem'] ?>" tabindex="-1" aria-labelledby="comentarioModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="comentarioModalLabel">Adicionar Comentário</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="comentarioForm" action="../actions/comentar.php">
                            <input type="hidden" name="idpostagem" value="<?= $postagem['idpostagem'] ?> ">
                            <div class="mb-3">
                                <label for="comentarioTexto" class="form-label">Comentário</label>
                                <textarea class="form-control" id="comentarioTexto" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php

        ComentarioDAO::listarComentariosPorPostagem($postagem['idpostagem']);


    }
}