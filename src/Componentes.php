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

        <div class="d-flex align-items-center mb-4">
            <div class="user-icon me-2">

                <?php
                if (!$usuario['foto']) {
                    $fotoPath = '../assets/img/profile-placeholder.png';
                } else {
                    $fotoPath = '../uploads/' . $usuario['foto'];
                }
                ?>
                <a href="perfil.php?idusuario=<?= $usuario['idusuario'] ?>">
                    <img src="<?= $fotoPath ?>" alt="Foto de <?= htmlspecialchars($usuario['nomeusuario']) ?>"
                        class="rounded-circle" style="width:40px; height:40px; object-fit:cover;">
                </a>


            </div>
            <h6 class="mb-0 me-2 fw-semibold border border-0"><?= htmlspecialchars($usuario['nomeusuario']) ?></h6>
            <?php
            $idUsuarioLogado = $_SESSION['idusuario'] ?? null;
            $idAutor = $usuario['idusuario'];

            if ($idUsuarioLogado && $idAutor != $idUsuarioLogado) {
                $seguido = SeguidoDAO::seguidoOuNao($idUsuarioLogado, $idAutor);

                if (empty($seguido)) {
                    // Não segue ainda
                    ?>
                    <div class="row w-100">
                        <a href="../actions/seguir.php?idseguido=<?= $idAutor ?>"
                            class="seguir-btn text-decoration-none col-auto ms-auto">Seguir</a>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="row w-100">
                        <p class="col-auto ms-auto">Seguindo</p>
                    </div>

                    <?php
                }
            }
            ?>
        </div>
        <?php
    }

    public static function cardConteudo($conteudo)
    {
        // Debug - verifique qual campo tem o ID
        $id = $conteudo['id'] ?? $conteudo['idfilme'] ?? $conteudo['idserie'] ?? $conteudo['idlivro'] ?? null;
        $categoria = $conteudo['categoria_nome'] ?? $conteudo['categoria'] ?? null;
        $titulo = $conteudo['titulo'] ?? $conteudo['nomefilme'] ?? $conteudo['nomeserie'] ?? $conteudo['nomelivro'] ?? 'Sem título';
        $imagem = $conteudo['imagem'] ?? 'placeholder.png';

        // Cria ID único
        $modalId = 'modal' . ucfirst(strtolower(str_replace('Série', 'Serie', $categoria))) . $id;

        // Debug
        // echo "ID: $id, Categoria: $categoria, ModalID: $modalId<br>";

        ?>
        <div class="card-conteudo position-relative" data-bs-toggle="modal" data-bs-target="#<?= $modalId ?>"
            style="cursor: pointer;">
            <img src="../uploads/<?= htmlspecialchars($imagem) ?>" alt="<?= htmlspecialchars($titulo) ?>"
                class="img-fluid img-slider rounded">

            <div class="overlay-conteudo position-absolute bottom-0 start-0 end-0 p-2 text-white">
                <h6 class="text-truncate mb-0"><?= htmlspecialchars($titulo) ?></h6>
            </div>
        </div>

        <?php
        switch ($categoria) {
            case 'Filme':
                self::modalFilme($conteudo, $modalId);
                break;
            case 'Série':
                self::modalSerie($conteudo, $modalId);
                break;
            case 'Livro':
                self::modalLivro($conteudo, $modalId);
                break;
        }
    }
public static function modalFilme($filme, $modalId)
{
    $id = $filme['id'] ?? null;
    $titulo = $filme['titulo'] ?? $filme['nomefilme'] ?? '';
    $modalId = $modalId ?? 'modalConteudo' . $id;
    ?>
    <div class="modal fade" id="<?= $modalId ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?= htmlspecialchars($titulo) ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="../uploads/<?= htmlspecialchars($filme['imagem']) ?>" class="img-fluid rounded" alt="<?= htmlspecialchars($titulo) ?>">
                        </div>
                        <div class="col-md-8">
                            <p><strong>Lançamento:</strong> <?= htmlspecialchars($filme['anolancamento'] ?? '—') ?></p>
                            <p><strong>Duração:</strong> <?= htmlspecialchars($filme['duracao'] ?? '—') ?></p>
                            <p><strong>Direção:</strong> <?= htmlspecialchars($filme['direcao'] ?? '—') ?></p>
                            <p><strong>Sinopse:</strong></p>
                            <p><?= nl2br(htmlspecialchars($filme['sinopse'] ?? '')) ?></p>

                            <hr>

                            <form action="../actions/posta-avaliacao.php" method="POST">
                                <input type="hidden" name="idconteudo" value="<?= $id ?>">
                                <input type="hidden" name="idcategoria" value="1">
                                <input type="hidden" name="nota" id="notaFilme<?= $id ?>" value="0">

                                <div class="mb-3">
                                    <label class="form-label">Sua Avaliação</label>
                                    <div class="rating">
                                        <?php for ($i = 1; $i <= 5; $i++): ?>
                                            <input type="radio" id="star<?= $i ?>_filme<?= $id ?>" name="nota" value="<?= $i ?>" />
                                            <label for="star<?= $i ?>_filme<?= $id ?>" class="star" title="Avaliar com <?= $i ?> estrela"></label>
                                        <?php endfor; ?>
                                    </div>
                                    <p class="mt-2" id="notaTextoFilme<?= $id ?>">Selecione uma nota</p>
                                </div>

                                <div class="mb-3">
                                    <label for="textoFilme<?= $id ?>" class="form-label">Comentário (opcional)</label>
                                    <textarea class="form-control" id="textoFilme<?= $id ?>" name="texto" rows="3"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Enviar Avaliação</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}

    public static function modalSerie($serie, $modalId)
    {
        $id = $serie['id'] ?? null;
        $titulo = $serie['titulo'] ?? $serie['nomeserie'] ?? '';
        $modalId = $modalId ?? 'modalConteudo' . $id;
        ?>
        <div class="modal fade" id="<?= $modalId ?>" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?= htmlspecialchars($titulo) ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="../uploads/<?= htmlspecialchars($serie['imagem']) ?>" class="img-fluid rounded"
                                    alt="<?= htmlspecialchars($titulo) ?>">
                            </div>
                            <div class="col-md-8">
                                <p><strong>Temporadas:</strong> <?= htmlspecialchars($serie['temporadas'] ?? '—') ?></p>
                                <p><strong>Episódios:</strong> <?= htmlspecialchars($serie['episodios'] ?? '—') ?></p>
                                <p><strong>Início:</strong> <?= htmlspecialchars($serie['anoinicio'] ?? '—') ?></p>
                                <p><strong>Encerramento:</strong>
                                    <?= htmlspecialchars($serie['anoencerramento'] ?? 'Em Andamento') ?></p>
                                <p><strong>Sinopse:</strong></p>
                                <p><?= nl2br(htmlspecialchars($serie['sinopse'] ?? '')) ?></p>

                                <hr>

                                <form action="../actions/posta-avaliacao.php" method="POST">
                                    <input type="hidden" name="idconteudo" value="<?= $id ?>">
                                    <input type="hidden" name="idcategoria" value="2">
                                    <input type="hidden" name="nota" id="notaSerie<?= $id ?>" value="0">

                                    <div class="mb-3">
                                        <label class="form-label">Sua Avaliação</label>
                                        <div class="rating-stars" data-input="notaFilme<?= $id ?>">
                                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                                <span class="star-wrapper"
                                                    style="display: inline-block; position: relative; width: 40px; height: 40px;">
                                                    <!-- Estrela cheia -->
                                                    <iconify-icon icon="ic:round-star-border" data-value="<?= $i ?>"
                                                        class="star star-full"
                                                        style="cursor: pointer; font-size: 32px; position: absolute; top: 0; left: 0;"></iconify-icon>
                                                    <!-- Meia estrela (clicável na metade esquerda) -->
                                                    <iconify-icon icon="ic:round-star-border" data-value="<?= $i - 0.5 ?>"
                                                        class="star star-half"
                                                        style="cursor: pointer; font-size: 32px; position: absolute; top: 0; left: 0; width: 50%; overflow: hidden; z-index: 2;"></iconify-icon>
                                                </span>
                                            <?php endfor; ?>
                                        </div>
                                        <p class="mt-2" id="notaTextoFilme<?= $id ?>">Selecione uma nota</p>
                                    </div>

                                    <div class="mb-3">
                                        <label for="textoSerie<?= $id ?>" class="form-label">Comentário (opcional)</label>
                                        <textarea class="form-control" id="textoSerie<?= $id ?>" name="texto"
                                            rows="3"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Enviar Avaliação</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    public static function modalLivro($livro, $modalId = null)
    {
        $id = $livro['id'] ?? null;
        $titulo = $livro['titulo'] ?? $livro['nomelivro'] ?? '';
        $modalId = $modalId ?? 'modalConteudo' . $id;
        ?>
        <div class="modal fade" id="<?= $modalId ?>" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?= htmlspecialchars($titulo) ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="../uploads/<?= htmlspecialchars($livro['imagem']) ?>" class="img-fluid rounded"
                                    alt="<?= htmlspecialchars($titulo) ?>">
                            </div>
                            <div class="col-md-8">
                                <p><strong>Autor:</strong> <?= htmlspecialchars($livro['autor'] ?? '—') ?></p>
                                <p><strong>Editora:</strong> <?= htmlspecialchars($livro['editora'] ?? '—') ?></p>
                                <p><strong>Páginas:</strong> <?= htmlspecialchars($livro['paginas'] ?? '—') ?></p>
                                <p><strong>Sinopse:</strong></p>
                                <p><?= nl2br(htmlspecialchars($livro['sinopse'] ?? '')) ?></p>

                                <hr>

                                <form action="../actions/posta-avaliacao.php" method="POST">
                                    <input type="hidden" name="idconteudo" value="<?= $id ?>">
                                    <input type="hidden" name="idcategoria" value="3">
                                    <input type="hidden" name="nota" id="notaLivro<?= $id ?>" value="0">

                                    <div class="mb-3">
                                        <label class="form-label">Sua Avaliação</label>
                                        <div class="rating-stars" data-input="notaLivro<?= $id ?>">
                                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                                <iconify-icon icon="ic:round-star-border" data-value="<?= $i ?>" class="star"
                                                    style="cursor: pointer; font-size: 32px; margin: 0 4px;"></iconify-icon>
                                            <?php endfor; ?>
                                        </div>
                                        <p class="mt-2" id="notaTextoLivro<?= $id ?>">Selecione uma nota</p>
                                    </div>

                                    <div class="mb-3">
                                        <label for="textoLivro<?= $id ?>" class="form-label">Comentário (opcional)</label>
                                        <textarea class="form-control" id="textoLivro<?= $id ?>" name="texto"
                                            rows="3"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Enviar Avaliação</button>
                                </form>
                            </div>
                        </div>
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
                    <a href="perfil.php?idusuario=<?= $postagem['idusuario'] ?>">
                        <img src="<?= $fotoPath ?>" alt="Foto de <?= htmlspecialchars($postagem['nomeusuario']) ?>"
                            class="rounded-circle" style="width:40px; height:40px; object-fit:cover;">
                    </a>

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
                        <a href="../actions/seguir.php?idseguido=<?= $idAutor ?>" class="seguir-btn text-decoration-none">Seguir</a>
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
                    <button><iconify-icon icon="ant-design:comment-outlined" class="ms-3" data-bs-toggle="modal"
                            data-bs-target="#comentarioModal<?= $postagem['idpostagem'] ?>"></iconify-icon></button>
                </div>
                <div class="d-flex align-items-center justify-content-between footer-icons">
                    <?php
                    // Verifica se o usuário logado é o autor da postagem ou se é um administrador
                    if ($_SESSION['idusuario'] == $postagem['idusuario'] || AdminDAO::validarAdmin($_SESSION['idusuario'])) {
                        ?>
                        <!-- Excluir postagem -->
                        <button data-bs-toggle="modal" data-bs-target="#excluirPostagemModal<?= $postagem['idpostagem'] ?>">
                            <iconify-icon icon="material-symbols:delete"></iconify-icon>
                        </button>


                        <?php
                    }
                    if (AdminDAO::validarAdmin($_SESSION['idusuario'])) {
                        ?>
                        <!-- Ver denúncias -->
                        <button data-bs-toggle="modal" data-bs-target="#mostrarDenunciasModal<?= $postagem['idpostagem'] ?>">
                            <iconify-icon icon="mdi:alert-circle-outline"></iconify-icon>
                        </button>
                        <?php

                    } else {
                        ?>
                        <button class="ms-2" data-bs-toggle="modal"
                            data-bs-target="#denunciarPostagemModal<?= $postagem['idpostagem'] ?>">
                            <iconify-icon icon="jam:triangle-danger"></iconify-icon>
                        </button>
                        <?php
                    }
                    ?>


                </div>

            </div>


        </div>
        <?php
    }

    public static function cardComentario($comentario)
    {
        // Verifica se o comentário possui uma foto, caso contrário, define uma imagem padrão
        if (!$comentario['foto']) {
            $fotoPath = '../assets/img/profile-placeholder.png';
        } else {
            $fotoPath = '../uploads/' . $comentario['foto'];
        }
        ?>
        <div class="card-comentario mb-3 p-3 rounded-4 shadow-sm text-light mx-auto">
            <!-- Topo -->
            <div class="d-flex align-items-center mb-2">
                <div class="user-icon me-2">
                    <img src="<?= $fotoPath ?>" alt="Foto de <?= htmlspecialchars($comentario['nomeusuario']) ?>"
                        class="rounded-circle" style="width:40px; height:40px; object-fit:cover;">
                </div>
                <h6 class="mb-0 me-2 fw-semibold"><?= htmlspecialchars($comentario['nomeusuario']) ?></h6>

                <?php
                // Verifica se o usuário logado não é o autor do comentário e se está seguindo
                $idUsuarioLogado = $_SESSION['idusuario'] ?? null;
                $idAutor = $comentario['idusuario'];

                if ($idUsuarioLogado && $idAutor != $idUsuarioLogado) {
                    $seguido = SeguidoDAO::seguidoOuNao($idUsuarioLogado, $idAutor);

                    if (empty($seguido)) {
                        // Se não segue, exibe a opção para seguir
                        ?>
                        <a href="../actions/seguir.php?idseguido=<?= $idAutor ?>" class="seguir-btn">Seguir</a>
                        <?php
                    }
                }
                ?>

                <small class="text-secondary ms-auto">
                    <?= date('d/m/Y H:i', strtotime($comentario['datacomentario'])) ?>
                </small>
            </div>

            <!-- Corpo do comentário -->
            <p class="card-text"><?= nl2br(htmlspecialchars($comentario['texto'])) ?></p>
        </div>
        <?php
    }

    public static function modalComentario($postagem)
    {
        ?>
        <!-- Modal de Comentário -->
        <div class="modal fade" id="comentarioModal<?= $postagem['idpostagem'] ?>" tabindex="-1"
            aria-labelledby="comentarioModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="comentarioModalLabel">Adicionar Comentário</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="comentarioForm" action="../actions/comentar.php" method="POST">
                            <input type="hidden" name="idpostagem" value="<?= $postagem['idpostagem'] ?>">
                            <div class="mb-3">
                                <label for="comentarioTexto" class="form-label">Comentário</label>
                                <textarea class="form-control" id="comentarioTexto" name="comentarioTexto" rows="3"
                                    required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </form>




                        <?php

                        $comentarios = ComentarioDAO::listarComentariosPorPostagem($postagem['idpostagem']);
                        foreach ($comentarios as $comentario) {
                            Componentes::cardComentario($comentario);
                        }

                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php

    }

    public static function modalConfirmar($postagem)
    {
        ?>
        <div class="modal fade" id="excluirPostagemModal<?= $postagem['idpostagem'] ?>" tabindex="-1"
            aria-labelledby="comentarioModalLabel" aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="comentarioModalLabel">Confirmação</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">


                        <p>Tem certeza que deseja excluir esta postagem?</p>
                        <a
                            href="../actions/excluir-postagem.php?idpostagem=<?= $postagem['idpostagem'] ?>"><button>Sim</button></a>


                    </div>
                </div>
            </div>
        </div>

        <?php
    }

    public static function modalDenuncia($postagem)
    {
        ?>
        <div class="modal fade" id="denunciarPostagemModal<?= $postagem['idpostagem'] ?>" tabindex="-1"
            aria-labelledby="comentarioModalLabel" aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="comentarioModalLabel">Denunciar Postagem</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="../actions/denunciar-postagem.php" method="POST">
                            <input type="hidden" name="idpostagem" value="<?= $postagem['idpostagem'] ?>">
                            <div class="mb-3">
                                <label for="motivoDenuncia" class="form-label">Motivo da Denúncia</label>
                                <textarea class="form-control" id="motivoDenuncia" name="motivoDenuncia" rows="3"
                                    required></textarea>
                                <button type="submit">Enviar</button>
                        </form>


                    </div>
                </div>
            </div>
        </div>
        </div>

        <?php
    }

    public static function modalMostrarDenuncias($postagem)
    {
        ?>
        <!-- Modal de Denúncia para Admin -->
        <div class="modal fade" id="mostrarDenunciasModal<?= $postagem['idpostagem'] ?>" tabindex="-1"
            aria-labelledby="mostrarDenunciasModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mostrarDenunciasModal">Denuncias da Postagem</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php

                        $denuncias = DenunciaDAO::listarPorPostagem($postagem['idpostagem']);
                        foreach ($denuncias as $denuncia) {
                            Componentes::cardDenuncia($denuncia);
                        }

                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    public static function cardDenuncia($denuncia)
    {
        ?>
        <div class="card-denuncia mb-3 p-3 rounded-4 shadow-sm text-light mx-auto">
            <!-- Topo -->
            <div class="d-flex align-items-center mb-2">
                <h6 class="mb-0 me-2 fw-semibold">Denúncia ID: <?= htmlspecialchars($denuncia['iddenuncia']) ?></h6>

            </div>

            <!-- Corpo da denúncia -->
            <p class="card-text"><?= nl2br(htmlspecialchars($denuncia['motivo'])) ?></p>
        </div>
        <?php
    }

    public static function exibirPostagemCompleta($postagem)
    {
        Componentes::cardPostagem($postagem);
        Componentes::modalComentario($postagem);
        Componentes::modalConfirmar($postagem);
        Componentes::modalDenuncia($postagem);
        Componentes::modalMostrarDenuncias($postagem);
    }


    public static function exibirAlert()
    {
        $mensagem = $_SESSION['msg'] ?? '';
        ?>
        <!-- Modal de Notificação -->
        <style>
            #notificacaoModal {
                background-color: transparent !important;
            }

            #notificacaoModal .modal-backdrop {
                opacity: 0.3 !important;
            }

            #notificacaoModal .modal-dialog {
                background-color: transparent !important;
            }

            .notificacao-content {
                background: var(--bg-color);
                border: 2px solid var(--color1);
                border-radius: 12px;
                box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
                max-width: 400px;
                overflow: hidden;
            }

            .notificacao-header {
                background: linear-gradient(135deg, var(--color1), var(--color2));
                color: white;
                border-radius: 10px 10px 0 0;
                padding: 20px;
            }

            .notificacao-header .modal-title {
                font-weight: bold;
                font-size: 18px;
                display: flex;
                align-items: center;
            }

            .notificacao-body {
                padding: 20px;
                background: var(--bg-color);
            }

            .notificacao-body .alert {
                border: none;
                border-radius: 8px;
                margin: 0;
                padding: 15px;
                font-size: 15px;
                line-height: 1.5;
            }

            .notificacao-body .alert-success {
                background-color: #d4edda;
                color: #155724;
                border-left: 4px solid #28a745;
            }

            .notificacao-body .alert-danger {
                background-color: #f8d7da;
                color: #721c24;
                border-left: 4px solid #dc3545;
            }

            .notificacao-body .alert-info {
                background-color: #d1ecf1;
                color: #0c5460;
                border-left: 4px solid #17a2b8;
            }

            .notificacao-body .alert-warning {
                background-color: #fff3cd;
                color: #856404;
                border-left: 4px solid #ffc107;
            }

            #notificacaoModal .btn-primary {
                background: linear-gradient(135deg, var(--color1), var(--color2));
                border: none;
                border-radius: 6px;
                padding: 8px 24px;
                font-weight: 600;
                transition: all 0.3s ease;
                color: white;
            }

            #notificacaoModal .btn-primary:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(193, 18, 31, 0.3);
                color: white;
            }

            #notificacaoModal .modal-content {
                border: none;
            }

            #notificacaoModal .btn-close {
                filter: brightness(0) invert(1);
            }
        </style>
        <div class="modal fade" id="notificacaoModal" tabindex="-1" aria-labelledby="notificacaoLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content notificacao-content">
                    <div class="modal-header notificacao-header border-0">
                        <h5 class="modal-title" id="notificacaoLabel">
                            <iconify-icon icon="mdi:check-circle" class="me-2"></iconify-icon>
                            Notificação
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body notificacao-body">
                        <div id="notificacaoMensagem" class="alert alert-info" role="alert"></div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            window.mensagemSessao = '<?= addslashes($mensagem) ?>';
        </script>


        <?php

        // Limpa a mensagem após exibir
        unset($_SESSION['msg']);
    }
}
?>
<script src="/assets/js/rating.js"></script>