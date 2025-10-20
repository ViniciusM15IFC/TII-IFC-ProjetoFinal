<?php
require_once __DIR__ . "/../src/autoload.php";

class LivroDAO
{
    public static function inserir($dados)
    {
        $conexao = ConexaoBD::conectar();

        // Salva a imagem da capa (como no UsuarioDAO)
        $imagem = Util::salvarArquivo();

        $sql = "INSERT INTO livro (
                    nomelivro, idgenero, idclassificacao, imagem, paginas, autor, sinopse
                ) VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conexao->prepare($sql);

        $stmt->bindParam(1, $dados['titulo']);
        $stmt->bindParam(2, $dados['genero']);
        $stmt->bindParam(3, $dados['classificacao']);
        $stmt->bindParam(4, $imagem);
        $stmt->bindParam(5, $dados['paginas']);
        $stmt->bindParam(6, $dados['autor']);
        $stmt->bindParam(7, $dados['sinopse']);

        $stmt->execute();

        $idconteudo = $conexao->lastInsertId();
        ConteudoDAO::inserir($idconteudo, $dados['categoria']);
    }

    public static function listar()
    {
        $sql = "SELECT * FROM livro";

        $conexao = ConexaoBD::conectar();

        $stmt = $conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
