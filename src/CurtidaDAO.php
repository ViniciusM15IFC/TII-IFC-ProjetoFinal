<?php


require_once 'autoload.php';

class CurtidaDAO
{
    public static function curtir($idusuario, $idpostagem)
    {
        $conexao = ConexaoBD::conectar();
        $sql = "INSERT INTO curtida (idusuario, idpostagem) VALUES (?, ?)";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(1, $idusuario);
        $stmt->bindParam(2, $idpostagem);
        $stmt->execute();
    }

    public static function descurtir($idusuario, $idpostagem)
    {
        $conexao = ConexaoBD::conectar();
        $sql = "DELETE FROM curtida WHERE idusuario = ? AND idpostagem = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(1, $idusuario);
        $stmt->bindParam(2, $idpostagem);
        $stmt->execute();
    }

    public static function contarCurtidas($idpostagem)
    {
        $conexao = ConexaoBD::conectar();
        $sql = "SELECT COUNT(*) FROM curtida WHERE idpostagem = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(1, $idpostagem);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public static function usuarioCurtiu($idusuario, $idpostagem)
    {
        $conexao = ConexaoBD::conectar();
        $sql = "SELECT COUNT(*) FROM curtida WHERE idusuario = ? AND idpostagem = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(1, $idusuario);
        $stmt->bindParam(2, $idpostagem);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }
}