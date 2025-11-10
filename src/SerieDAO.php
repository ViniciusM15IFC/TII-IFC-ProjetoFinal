<?php
require_once __DIR__ . "/../src/autoload.php";

class SerieDAO
{
    public static function inserir($dados)
    {
        $conexao = ConexaoBD::conectar();

        // Faz upload da imagem (capa da série, pôster, etc.)
        $imagem = Util::salvarArquivo();

        $sql = "INSERT INTO serie (
                    nomeserie, temporadas, episodios, anoinicio, anoencerramento, idclassificacao, idgenero, imagem, sinopse
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conexao->prepare($sql);

        $stmt->bindParam(1, $dados['titulo']);
        $stmt->bindParam(2, $dados['temporadas']);
        $stmt->bindParam(3, $dados['episodios']);
        $stmt->bindParam(4, $dados['ano-inicio']);
        $stmt->bindParam(5, $dados['ano-encerramento']);
        $stmt->bindParam(6, $dados['classificacao']);
        $stmt->bindParam(7, $dados['genero']);
        $stmt->bindParam(8, $imagem);
        $stmt->bindParam(9, $dados['sinopse']);

        $stmt->execute();

        $idconteudo = $conexao->lastInsertId();
        ConteudoDAO::inserir($idconteudo, $dados['categoria']);
    }

    public static function listar()
    {
        $conexao = ConexaoBD::conectar();
        $sql = "SELECT idserie AS id, nomeserie AS titulo, imagem, sinopse, idgenero, idclassificacao, anoinicio, anoencerramento, temporadas, episodios FROM serie";
        $stmt = $conexao->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function consultarPorId($id)
    {
        $conexao = ConexaoBD::conectar();
        $sql = "SELECT idserie AS id, nomeserie AS titulo, imagem, sinopse, idgenero, idclassificacao, anoinicio, anoencerramento, temporadas, episodios FROM serie WHERE idserie = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>