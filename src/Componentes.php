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
            <div class="text-start w-100">
                <h6 class="mb-0 me-2 fw-semibold border border-0 start-0 "><?= htmlspecialchars($usuario['nomeusuario']) ?>
                </h6>
            </div>
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
        // Detecta o ID do conteúdo corretamente
        $id = $conteudo['id']
            ?? $conteudo['idconteudo']
            ?? $conteudo['idfilme']
            ?? $conteudo['idserie']
            ?? $conteudo['idlivro']
            ?? null;

        $categoria = $conteudo['categoria_nome'] ?? $conteudo['categoria'] ?? $conteudo['idcategoria'] ?? null;
        $titulo = $conteudo['titulo']
            ?? $conteudo['nomefilme']
            ?? $conteudo['nomeserie']
            ?? $conteudo['nomelivro']
            ?? 'Sem título';
        $imagem = $conteudo['imagem'] ?? 'placeholder.png';

        // ID único de modal
        $modalId = 'modal' . ucfirst(strtolower(str_replace('Série', 'Serie', $categoria))) . ($id ?? uniqid());

        // Debug temporário (pode remover depois)
        if (!$id) {
            error_log("⚠️ Conteúdo sem ID detectado: " . print_r($conteudo, true));
        }
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
        $id = $filme['id'] ?? uniqid('filme_');
        $titulo = $filme['titulo'] ?? $filme['nomefilme'] ?? '';
        $modalId = $modalId ?? 'modalConteudo' . $id;
        $classificacao = $filme['idclassificacao'] ?? 'erro';
        $genero = GeneroDAO::consultarPorID($filme['idgenero']) ?? '—';
        $genero = $genero['nomegenero'] ?? '—';
        $duracao = $filme['duracao'] ?? '—';
        $sinopse = $filme['sinopse'] ?? '';
        $ano = $filme['anolancamento'] ?? '—';
        ?>

        <style>


        </style>

        <div class="modal fade modal-resenha-custom" id="<?= $modalId ?>" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog avaliacao rounded-4">
                <div class="modal-content rounded-4">
                    <div class="modal-header p-2 mt-3 position-relative justify-content-center">
                        <h3 class="modal-title fs-3 text-center m-0">Publicar Avaliação</h3>
                        <button type="button" class="btn-close position-absolute end-0 top-0 mt-2 me-2"
                            data-bs-dismiss="modal"></button>
                    </div>


                    <div class="modal-body p-3 m-3 rounded-4">
                        <form action="../actions/posta-avaliacao.php" method="POST">
                            <input type="hidden" name="idconteudo" value="<?= $filme['id'] ?>">
                            <input type="hidden" name="idcategoria" value="1">
                            <input type="hidden" id="notaFilme<?= $id ?>" name="nota" value="0">

                            <div class="resenha-container">
                                <!-- Coluna Esquerda: Input, Poster e Estrelas -->
                                <div class="poster-column">


                                    <div class="poster-wrapper">
                                        <img src="../uploads/<?= htmlspecialchars($filme['imagem']) ?>"
                                            alt="<?= htmlspecialchars($titulo) ?>" class="poster-img">
                                        <div class="stars-vertical rating-stars-input gap-1 align-items-center"
                                            id="starsVertical<?= $id ?>">
                                            <input type="number" id="ratingInputTop<?= $id ?>"
                                                class="rating-input-top rounded-3" min="0" max="10" step="1" value="0">
                                            <iconify-icon icon="ic:round-star-border"></iconify-icon>
                                            <iconify-icon icon="ic:round-star-border"></iconify-icon>
                                            <iconify-icon icon="ic:round-star-border"></iconify-icon>
                                            <iconify-icon icon="ic:round-star-border"></iconify-icon>
                                            <iconify-icon icon="ic:round-star-border"></iconify-icon>
                                        </div>
                                    </div>
                                </div>

                                <!-- Coluna Direita: Título, Badges, Sinopse -->
                                <div class="content-column">
                                    <h6 class="titulo-content fs-4"><?= htmlspecialchars($titulo) ?></h6>

                                    <div class="badges-flex">
                                        <div class="d-flex flex-wrap gap-2 align-items-center">

                                            <div>
                                                <?php
                                                $classifId = intval($classificacao);
                                                if ($classifId >= 1 && $classifId <= 6) {
                                                    ?>
                                                    <img src="../assets/img/classificacoes-icons/<?= $classifId ?>.png"
                                                        alt="Classificação" class="img-ind">
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                            <div>
                                                <span class="badge-custom"><?= htmlspecialchars($duracao) ?></span>
                                            </div>
                                            <div>
                                                <span class="badge-custom"><?= htmlspecialchars($genero) ?></span>
                                            </div>
                                            <div>
                                                <span class="badge-custom"><?= htmlspecialchars($ano) ?></span>
                                            </div>
                                        </div>
                                    </div>

                                    <p class="sinopse-box overflow-auto"><?= nl2br(htmlspecialchars($sinopse)) ?></p>
                                </div>
                            </div>

                            <!-- Comentário -->
                            <div class="mb-3">
                                <label class="form-label">Escreva sua Opinião</label>
                                <div class="textarea-wrapper">
                                    <textarea id="textoFilme<?= $id ?>" name="texto" class="comentario-textarea"
                                        rows="3"></textarea>
                                    <button type="submit" class="btn-enviar-icon color1" title="Enviar">
                                        <iconify-icon icon="ic:round-send" class="color1"></iconify-icon>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <?php
    }

    public static function modalSerie($serie, $modalId)
    {
        $id = $serie['id'] ?? uniqid('serie_');
        $titulo = $serie['titulo'] ?? $serie['nomeserie'] ?? '';
        $modalId = $modalId ?? 'modalConteudo' . $id;
        $classificacao = $serie['idclassificacao'] ?? 'erro';
        $genero = GeneroDAO::consultarPorID($serie['idgenero']) ?? '—';
        $genero = $genero['nomegenero'] ?? '—';
        $episodios = $serie['episodios'] ?? '—';
        $temporadas = $serie['temporadas'] ?? '—';
        $inicio = $serie['anoinicio'] ?? '—';
        $fim = $serie['anoencerramento'] ?? '—';
        $sinopse = $serie['sinopse'] ?? '';
        ?>
        <div class="modal fade modal-resenha-custom" id="<?= $modalId ?>" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog avaliacao rounded-4">
                <div class="modal-content rounded-4">
                    <div class="modal-header p-2 mt-3 position-relative justify-content-center">
                        <h3 class="modal-title fs-3 text-center m-0">Publicar Avaliação</h3>
                        <button type="button" class="btn-close position-absolute end-0 top-0 mt-2 me-2"
                            data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body p-3 m-3 rounded-4">
                        <form action="../actions/posta-avaliacao.php" method="POST">
                            <input type="hidden" name="idconteudo" value="<?= $serie['id'] ?>">
                            <input type="hidden" name="idcategoria" value="2">
                            <input type="hidden" id="notaSerie<?= $id ?>" name="nota" value="0">

                            <div class="resenha-container d-flex gap-4">
                                <div class="poster-column">
                                    <div class="poster-wrapper">
                                        <img src="../uploads/<?= htmlspecialchars($serie['imagem']) ?>"
                                            alt="<?= htmlspecialchars($titulo) ?>" class="poster-img rounded-4 shadow-sm">
                                        <div class="stars-vertical rating-stars-input gap-1 align-items-center mt-2"
                                            id="starsVertical<?= $id ?>">
                                            <input type="number" id="ratingInputTop<?= $id ?>"
                                                class="rating-input-top rounded-3" min="0" max="10" step="1" value="0">
                                            <iconify-icon icon="ic:round-star-border"></iconify-icon>
                                            <iconify-icon icon="ic:round-star-border"></iconify-icon>
                                            <iconify-icon icon="ic:round-star-border"></iconify-icon>
                                            <iconify-icon icon="ic:round-star-border"></iconify-icon>
                                            <iconify-icon icon="ic:round-star-border"></iconify-icon>
                                        </div>
                                    </div>
                                </div>

                                <div class="content-column flex-grow-1">
                                    <h6 class="titulo-content fs-4"><?= htmlspecialchars($titulo) ?></h6>
                                    <div class="d-flex flex-wrap gap-2 mb-2 align-items-center">
                                        <?php if (intval($classificacao) >= 1 && intval($classificacao) <= 6): ?>
                                            <img src="../assets/img/classificacoes-icons/<?= intval($classificacao) ?>.png"
                                                alt="Classificação" class="img-ind">
                                        <?php endif; ?>
                                        <span class="badge-custom"><?= htmlspecialchars($genero) ?></span>
                                        <span class="badge-custom"><?= htmlspecialchars($temporadas) ?> Temp.</span>
                                        <span class="badge-custom"><?= htmlspecialchars($episodios) ?> Ep.</span>
                                        <span
                                            class="badge-custom"><?= htmlspecialchars($inicio) ?>–<?= htmlspecialchars($fim) ?></span>
                                    </div>
                                    <p class="sinopse-box overflow-auto"><?= nl2br(htmlspecialchars($sinopse)) ?></p>
                                </div>
                            </div>

                            <div class="mt-3">
                                <label class="form-label">Escreva sua Opinião</label>
                                <div class="textarea-wrapper">
                                    <textarea id="textoSerie<?= $id ?>" name="texto" class="comentario-textarea"
                                        rows="3"></textarea>
                                    <button type="submit" class="btn-enviar-icon" title="Enviar">
                                        <iconify-icon icon="ic:round-send" class="color1"></iconify-icon>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    public static function modalLivro($livro, $modalId)
    {
        $id = $livro['id'] ?? uniqid('livro_');
        $titulo = $livro['titulo'] ?? $livro['nomelivro'] ?? '';
        $modalId = $modalId ?? 'modalConteudo' . $id;
        $classificacao = $livro['idclassificacao'] ?? 'erro';
        $genero = GeneroDAO::consultarPorID($livro['idgenero']) ?? '—';
        $genero = $genero['nomegenero'] ?? '—';
        $autor = $livro['autor'] ?? '—';
        $editora = $livro['editora'] ?? '—';
        $paginas = $livro['paginas'] ?? '—';
        $sinopse = $livro['sinopse'] ?? '';
        ?>
        <div class="modal fade modal-resenha-custom" id="<?= $modalId ?>" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog avaliacao rounded-4">
                <div class="modal-content rounded-4">
                    <div class="modal-header p-2 mt-3 position-relative justify-content-center">
                        <h3 class="modal-title fs-3 text-center m-0">Publicar Avaliação</h3>
                        <button type="button" class="btn-close position-absolute end-0 top-0 mt-2 me-2"
                            data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body p-3 m-3 rounded-4">
                        <form action="../actions/posta-avaliacao.php" method="POST">
                            <input type="hidden" name="idconteudo" value="<?= $livro['id'] ?>">
                            <input type="hidden" name="idcategoria" value="3">
                            <input type="hidden" id="notaLivro<?= $id ?>" name="nota" value="0">

                            <div class="resenha-container d-flex gap-4">
                                <div class="poster-column">
                                    <div class="poster-wrapper">
                                        <img src="../uploads/<?= htmlspecialchars($livro['imagem']) ?>"
                                            alt="<?= htmlspecialchars($titulo) ?>" class="poster-img rounded-4 shadow-sm">
                                        <div class="stars-vertical rating-stars-input gap-1 align-items-center mt-2"
                                            id="starsVertical<?= $id ?>">
                                            <input type="number" id="ratingInputTop<?= $id ?>"
                                                class="rating-input-top rounded-3" min="0" max="10" step="1" value="0">
                                            <iconify-icon icon="ic:round-star-border"></iconify-icon>
                                            <iconify-icon icon="ic:round-star-border"></iconify-icon>
                                            <iconify-icon icon="ic:round-star-border"></iconify-icon>
                                            <iconify-icon icon="ic:round-star-border"></iconify-icon>
                                            <iconify-icon icon="ic:round-star-border"></iconify-icon>
                                        </div>
                                    </div>
                                </div>

                                <div class="content-column flex-grow-1">
                                    <h6 class="titulo-content fs-4"><?= htmlspecialchars($titulo) ?></h6>
                                    <div class="d-flex flex-wrap gap-2 mb-2 align-items-center">
                                        <?php if (intval($classificacao) >= 1 && intval($classificacao) <= 6): ?>
                                            <img src="../assets/img/classificacoes-icons/<?= intval($classificacao) ?>.png"
                                                alt="Classificação" class="img-ind">
                                        <?php endif; ?>
                                        <span class="badge-custom"><?= htmlspecialchars($genero) ?></span>
                                        <span class="badge-custom"><?= htmlspecialchars($autor) ?></span>
                                        <span class="badge-custom"><?= htmlspecialchars($editora) ?></span>
                                        <span class="badge-custom"><?= htmlspecialchars($paginas) ?> pág.</span>
                                    </div>
                                    <p class="sinopse-box overflow-auto"><?= nl2br(htmlspecialchars($sinopse)) ?></p>
                                </div>
                            </div>

                            <div class="mt-3">
                                <label class="form-label">Escreva sua Opinião</label>
                                <div class="textarea-wrapper">
                                    <textarea id="textoLivro<?= $id ?>" name="texto" class="comentario-textarea"
                                        rows="3"></textarea>
                                    <button type="submit" class="btn-enviar-icon" title="Enviar">
                                        <iconify-icon icon="ic:round-send"></iconify-icon>
                                    </button>
                                </div>
                            </div>
                        </form>
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
            <div class="modal-dialog modal-dialog-scrollable rounded-4">
                <div class="modal-content rounded-4">
                    <div class="modal-header">
                        <h5 class="modal-title color1" id="comentarioModalLabel">Comentários</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="comentarioForm" action="../actions/comentar.php" method="POST">
                            <input type="hidden" name="idpostagem" value="<?= $postagem['idpostagem'] ?>">
                            <div class="mb-3">
                                <label for="comentarioTexto" class="form-label">Adicionar Comentário</label>
                                <div class="textarea-wrapper">
                                    <textarea class="form-control" id="comentarioTexto" name="comentarioTexto" rows="3"
                                        required></textarea>
                                    <button type="submit" class="btn-enviar-icon color1" title="Enviar">
                                        <iconify-icon icon="ic:round-send" class="color1"></iconify-icon>
                                    </button>
                                </div>
                            </div>
                        </form>

                        <div class="divider w-100"></div>


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

    public static function modalExcluirPostagem($postagem)
    {
        ?>
        <div class="modal fade" id="excluirPostagemModal<?= $postagem['idpostagem'] ?>" tabindex="-1"
            aria-labelledby="comentarioModalLabel" aria-hidden="true">
            <div class="modal-dialog rounded-4">
                <div class="modal-content rounded-4">
                    <div class="modal-header">
                        <h5 class="modal-title" id="comentarioModalLabel">Confirmação</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">


                        <p>Tem certeza que deseja excluir esta postagem?</p>
                        <a href="../actions/excluir-postagem.php?idpostagem=<?= $postagem['idpostagem'] ?>"><button
                                class="btn btn-primary">Sim</button></a>
                        <button data-bs-dismiss="modal" class="btn btn-secondary">Cancelar</button>


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
            <div class="modal-dialog rounded-4">
                <div class="modal-content rounded-4">
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
        Componentes::modalExcluirPostagem($postagem);
        Componentes::modalDenuncia($postagem);
        Componentes::modalMostrarDenuncias($postagem);
    }


    public static function exibirAlert()
    {
        $mensagem = $_SESSION['msg'] ?? '';
        ?>
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

    public static function modalUsuarios($usuarios, $tipo)
    {
        ?>
        <div class="modal fade modal-resenha-custom" id="<?= $tipo ?>" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog rounded-4">
                <div class="modal-content rounded-4">
                    <div class="modal-header p-2 mt-3 position-relative justify-content-center">
                        <h3 class="modal-title fs-4 text-center m-0"><?= htmlspecialchars($tipo) ?></h3>
                        <button type="button" class="btn-close position-absolute end-0 top-0 mt-2 me-2"
                            data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body m-3 rounded-4">

                        <div>
                            <?php
                            if (!empty($usuarios)) {
                                foreach ($usuarios as $usuario) {
                                    self::cardUsuario($usuario);
                                }
                            } else {
                                echo "<p class='text-center'>Nenhum usuário encontrado.</p>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
    }

    public static function modalExcluirPerfil($idusuario)
    {
        ?>
        <div class="modal fade" id="excluirPerfilModal<?= $idusuario ?>" tabindex="-1" aria-labelledby="comentarioModalLabel"
            aria-hidden="true">
            <div class="modal-dialog rounded-4">
                <div class="modal-content rounded-4">
                    <div class="modal-header">
                        <h5 class="modal-title" id="comentarioModalLabel">Confirmação</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">


                        <p>Tem certeza que deseja excluir seu perfil?</p>
                        <a href="../actions/excluir-perfil.php?idusuario=<?= $idusuario ?>"><button
                                class="btn btn-secondary">Sim</button></a>
                        <button data-bs-dismiss="modal" class="btn btn-secondary">Cancelar</button>


                    </div>
                </div>
            </div>
        </div>

        <?php
    }
}
?>
<script src="/assets/js/rating.js"></script>