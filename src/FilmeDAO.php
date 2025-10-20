<?php
require_once __DIR__ . "/../src/autoload.php";

class FilmeDAO
{
    public static function inserir($dados)
    {
        $conexao = ConexaoBD::conectar();

        // Salva a imagem (ou retorna NULL se não houver)
        $imagem = Util::salvarArquivo();

        $sql = "INSERT INTO filme (
                    nomefilme, duracao, idclassificacao, idgenero, direcao, sinopse, anolancamento, imagem
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conexao->prepare($sql);

        $stmt->bindParam(1, $dados['titulo']);
        $stmt->bindParam(2, $dados['duracao']);
        $stmt->bindParam(3, $dados['classificacao']);
        $stmt->bindParam(4, $dados['genero']);
        $stmt->bindParam(5, $dados['diretor']);
        $stmt->bindParam(6, $dados['sinopse']);
        $stmt->bindParam(7, $dados['ano-lancamento']);
        $stmt->bindParam(8, $imagem);

        $stmt->execute();

        $idconteudo = $conexao->lastInsertId();
        ConteudoDAO::inserir($idconteudo, $dados['categoria']);
    }

    public static function listar()
    {
        $sql = "SELECT * FROM filme";

        $conexao = ConexaoBD::conectar();

        $stmt = $conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>