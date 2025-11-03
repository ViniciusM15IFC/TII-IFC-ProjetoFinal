<?php

require_once "autoload.php";

class ComentarioDAO
{
    public static function inserir($dados)
    {
        try {
            $conexao = ConexaoBD::conectar();

            $sql = "INSERT INTO `comentario` (`idusuario`, `idpostagem`, `texto`, `datacomentario`)
                    VALUES (?, ?, ?, NOW())";

            $stmt = $conexao->prepare($sql);

            // Bind os parâmetros para evitar SQL Injection
            $stmt->bindParam(1, $dados['idusuario']);
            $stmt->bindParam(2, $dados['idpostagem']);
            $stmt->bindParam(3, $dados['texto']);

            // Executa a query
            $stmt->execute();

            // Verifica se a inserção foi bem-sucedida
            if ($stmt->rowCount() > 0) {
                return "Comentário inserido com sucesso!";
            } else {
                return "Falha na inserção do comentário!";
            }
        } catch (PDOException $e) {
            // Em caso de erro, retorna uma mensagem de erro
            return "Erro: " . $e->getMessage();
        }
    }
    public static function listarComentariosPorPostagem($idpostagem)
    {
        try {
            $conexao = ConexaoBD::conectar();

            $sql = "SELECT 
                c.idcomentario, 
                c.idusuario, 
                c.texto, 
                c.datacomentario, 
                u.* 
            FROM 
                comentario c
            JOIN 
                usuario u ON c.idusuario = u.idusuario
            WHERE 
                c.idpostagem = ? 
            ORDER BY 
                c.datacomentario DESC;
";

            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(1, $idpostagem);

            $stmt->execute();

            $comentarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $comentarios;
        } catch (PDOException $e) {
            return "Erro: " . $e->getMessage();
        }
    }

}
