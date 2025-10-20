<?php
require_once __DIR__ . "/../src/autoload.php";

class ConteudoDAO
{
    public static function inserir($idconteudo, $idcategoria)
    {
        $conexao = ConexaoBD::conectar();


        $sql = "INSERT INTO conteudo (
                    idconteudo, idcategoria
                ) VALUES (?, ?)";

        $stmt = $conexao->prepare($sql);

        $stmt->bindParam(1, $idconteudo);
        $stmt->bindParam(2, $idcategoria);

        $stmt->execute();
    }
    public static function buscarConteudos($termo = "")
    {
        $conexao = ConexaoBD::conectar();

        $sql = "SELECT 
                c.idconteudo,
                cat.nomecategoria AS categoria,
                COALESCE(f.nomelfilme, l.nomelivro, s.nomeserie) AS titulo,
                COALESCE(f.imagem, l.imagem, s.imagem) AS imagem,
                COALESCE(f.sinopse, l.sinopse, s.sinopse) AS sinopse
            FROM conteudo c
            JOIN categoria cat ON c.idcategoria = cat.idcategoria
            LEFT JOIN filme f ON f.idfilme = c.idconteudo
            LEFT JOIN livro l ON l.idlivro = c.idconteudo
            LEFT JOIN serie s ON s.idserie = c.idconteudo
            WHERE COALESCE(f.nomelfilme, l.nomelivro, s.nomeserie) LIKE CONCAT('%', ?, '%')
            ORDER BY titulo";

        $stmt = $conexao->prepare($sql);
        $stmt->execute([$termo]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>