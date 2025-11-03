<?php


require_once 'autoload.php';

class DenunciaDAO
{
    public static function denunciar($dados)
    {
        $conexao = ConexaoBD::conectar();
        $sql = "INSERT INTO denuncia (idpostagem, motivo) VALUES (?, ?)";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(1, $dados['idpostagem']);
        $stmt->bindParam(2, $dados['motivo']);
        $stmt->execute();
    }

    public static function listar()
    {
        $conexao = ConexaoBD::conectar();
        $sql = "SELECT * FROM denuncia";
        $stmt = $conexao->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function listarPorPostagem($idpostagem)
    {
        $conexao = ConexaoBD::conectar();
        $sql = "SELECT * FROM denuncia WHERE idpostagem = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(1, $idpostagem);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}