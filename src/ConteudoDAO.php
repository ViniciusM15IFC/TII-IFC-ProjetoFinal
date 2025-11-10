<?php
require_once __DIR__ . "/../src/autoload.php";

class ConteudoDAO
{
    public static function inserir($idConteudo, $idCategoria)
    {
        $conexao = ConexaoBD::conectar();

        $sql = "INSERT INTO conteudo (idconteudo, idcategoria) VALUES (?, ?)";

        $stmt = $conexao->prepare($sql);
        return $stmt->execute([$idConteudo, $idCategoria]);
    }
    public static function buscarConteudos($termo = "")
    {
        $conexao = ConexaoBD::conectar();

        $sql = "
            SELECT 
                f.idfilme AS id,
                1 AS categoria_id,
                'Filme' AS categoria_nome,
                f.nomefilme AS titulo,
                f.imagem,
                f.sinopse
            FROM filme f
            WHERE f.nomefilme LIKE CONCAT('%', ?, '%')

            UNION ALL

            SELECT 
                s.idserie AS id,
                2 AS categoria_id,
                'Série' AS categoria_nome,
                s.nomeserie AS titulo,
                s.imagem,
                s.sinopse
            FROM serie s
            WHERE s.nomeserie LIKE CONCAT('%', ?, '%')

            UNION ALL

            SELECT 
                l.idlivro AS id,
                3 AS categoria_id,
                'Livro' AS categoria_nome,
                l.nomelivro AS titulo,
                l.imagem,
                l.sinopse
            FROM livro l
            WHERE l.nomelivro LIKE CONCAT('%', ?, '%')
        ";

        $stmt = $conexao->prepare($sql);
        $stmt->execute([$termo, $termo, $termo]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function listar()
    {
        $conexao = ConexaoBD::conectar();

        $sql = "SELECT * FROM conteudo";
        $stmt = $conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function consultarPorIdCategoria($id, $idcategoria)
    {
        if ($idcategoria == 1) {
            return FilmeDAO::consultarPorId($id);
        } elseif ($idcategoria == 2) {
            return SerieDAO::consultarPorId($id);
        } elseif ($idcategoria == 3) {
            return LivroDAO::consultarPorId($id);
        } else {
            return null;
        }
    }

    public static function listarPorGenero($idgenero)
    {
        $conexao = ConexaoBD::conectar();

        $sql = "
                SELECT 
                c.idconteudo,
                c.idcategoria,
                CASE 
                WHEN c.idcategoria = 1 THEN 'Filme'
                WHEN c.idcategoria = 2 THEN 'Série'
                WHEN c.idcategoria = 3 THEN 'Livro'
                END AS tipo
                FROM conteudo c
                LEFT JOIN filme f ON f.idfilme = c.idconteudo AND c.idcategoria = 1
                LEFT JOIN serie s ON s.idserie = c.idconteudo AND c.idcategoria = 2
                LEFT JOIN livro l ON l.idlivro = c.idconteudo AND c.idcategoria = 3
                WHERE COALESCE(f.idgenero, s.idgenero, l.idgenero) = ?;
        ";

        $stmt = $conexao->prepare($sql);
        $stmt->execute([$idgenero]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>