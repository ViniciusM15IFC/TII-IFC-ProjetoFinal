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
}
?>