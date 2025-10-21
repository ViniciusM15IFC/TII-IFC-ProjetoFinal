<?php
require_once "ConexaoBD.php";

class PostagemDAO
{
    // ===============================
    // RF4 - Criar postagem/avaliação
    // ===============================
    public static function criarPostagem($dados)
    {
        $sql = "INSERT INTO postagem (idusuario, idconteudo, idcategoria, nota, texto, datapostagem)
                VALUES (?, ?, ?, ?, ?, NOW())";

        $conexao = ConexaoBD::conectar();
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(1, $_SESSION['idusuario'], PDO::PARAM_INT);
        $stmt->bindParam(2, $dados['idconteudo'], PDO::PARAM_INT);
        $stmt->bindParam(3, $dados['idcategoria'], PDO::PARAM_INT);
        $stmt->bindParam(4, $dados['nota'], PDO::PARAM_INT);
        $stmt->bindParam(5, $dados['texto'], PDO::PARAM_STR);
        $stmt->execute();
    }

    // ===============================
    // Listar todas as postagens
    // ===============================
    public static function listarPostagens()
    {
        $sql = "SELECT 
                p.*,
                u.nomeusuario,
                u.foto,
                COALESCE(f.nomefilme, s.nomeserie, l.nomelivro) AS nomeconteudo
            FROM postagem p
            JOIN usuario u ON p.idusuario = u.idusuario
            LEFT JOIN filme f ON p.idcategoria = 1 AND p.idconteudo = f.idfilme
            LEFT JOIN serie s ON p.idcategoria = 2 AND p.idconteudo = s.idserie
            LEFT JOIN livro l ON p.idcategoria = 3 AND p.idconteudo = l.idlivro
            ORDER BY p.datapostagem DESC";

        $conexao = ConexaoBD::conectar();
        $stmt = $conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function listarFeed($idUsuario)
    {
        $sql = "SELECT 
        p.*,
        u.nomeusuario,
        u.foto,
        COALESCE(f.nomefilme, s.nomeserie, l.nomelivro) AS nomeconteudo,
        COALESCE(f.imagem, s.imagem, l.imagem) AS imagemconteudo
        FROM postagem p
        JOIN usuario u ON p.idusuario = u.idusuario
        LEFT JOIN filme f ON p.idcategoria = 1 AND p.idconteudo = f.idfilme
        LEFT JOIN serie s ON p.idcategoria = 2 AND p.idconteudo = s.idserie
        LEFT JOIN livro l ON p.idcategoria = 3 AND p.idconteudo = l.idlivro
        WHERE p.idusuario = :idUsuario
        OR p.idusuario IN (
            SELECT s.idseguido FROM seguido s WHERE s.idusuario = :idUsuario
        )
        ORDER BY p.datapostagem DESC;
        ";

        $conexao = ConexaoBD::conectar();
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // ===============================
    // Listar postagens de um usuário
    // ===============================
    public static function listarPorUsuario($idUsuario)
    {
        $sql = "SELECT p.*, c.titulo AS nomeconteudo
                FROM postagem p
                JOIN conteudo c ON p.idconteudo = c.idconteudo
                WHERE p.idusuario = ?
                ORDER BY p.datapostagem DESC";

        $conexao = ConexaoBD::conectar();
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(1, $idUsuario, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ===============================
    // RF6 - Adicionar comentário
    // ===============================
    public static function comentarPostagem($dados)
    {
        $sql = "INSERT INTO comentario (idusuario, idpostagem, texto, datacomentario)
                VALUES (?, ?, ?, NOW())";

        $conexao = ConexaoBD::conectar();
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(1, $dados['idusuario'], PDO::PARAM_INT);
        $stmt->bindParam(2, $dados['idpostagem'], PDO::PARAM_INT);
        $stmt->bindParam(3, $dados['texto'], PDO::PARAM_STR);
        $stmt->execute();
    }

    // ===============================
    // Listar comentários de uma postagem
    // ===============================
    public static function listarComentarios($idPostagem)
    {
        $sql = "SELECT c.*, u.nomeusuario, u.foto
                FROM comentario c
                JOIN usuario u ON c.idusuario = u.idusuario
                WHERE c.idpostagem = ?
                ORDER BY c.datacomentario ASC";

        $conexao = ConexaoBD::conectar();
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(1, $idPostagem, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ===============================
    // RF12 - Denunciar postagem
    // ===============================
    public static function denunciarPostagem($dados)
    {
        $sql = "INSERT INTO denuncia (idusuario, idpostagem, motivo, datadenuncia)
                VALUES (?, ?, ?, NOW())";

        $conexao = ConexaoBD::conectar();
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(1, $dados['idusuario'], PDO::PARAM_INT);
        $stmt->bindParam(2, $dados['idpostagem'], PDO::PARAM_INT);
        $stmt->bindParam(3, $dados['motivo'], PDO::PARAM_STR);
        $stmt->execute();
    }

    // ===============================
    // Excluir postagem (por dono ou admin)
    // ===============================
    public static function excluirPostagem($idPostagem)
    {
        $sql = "DELETE FROM postagem WHERE idpostagem = ?";
        $conexao = ConexaoBD::conectar();
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(1, $idPostagem, PDO::PARAM_INT);
        $stmt->execute();
    }
}
?>