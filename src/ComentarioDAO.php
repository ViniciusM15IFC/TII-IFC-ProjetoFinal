<?php

require_once __DIR__ . "/../src/autoload.php";

class ComentarioDAO
{
    public static function inserir($dados)
    {
        $conexao = ConexaoBD::conectar();

        $sql = "INSERT INTO `tii-ifc-projetofinal`.`comentario` ('idusuario', 'idpostagem', 'texto', 'datacomentario')
                VALUES
                (?, ?, ?, NOW());
                ";

        $stmt = $conexao->prepare($sql);

        $stmt->bindParam(1, $dados['idusuario']);
        $stmt->bindParam(2, $dados['idpostagem']);
        $stmt->bindParam(3, $dados['texto']);

        $stmt->execute();
    }

    public static function buscarComentariosPorConteudo($idconteudo)
    {
        $conexao = ConexaoBD::conectar();

        $sql = "SELECT 
                    c.idcomentario,
                    u.nomeusuario AS usuario,
                    c.texto,
                    c.datahora
                FROM comentario c
                JOIN usuario u ON c.idusuario = u.idusuario
                WHERE c.idconteudo = ?
                ORDER BY c.datahora DESC";

        $stmt = $conexao->prepare($sql);
        $stmt->execute([$idconteudo]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}