<?php
require_once "ConexaoBD.php";

class SeguidoDAO {
    public static function seguir($idusuario, $idseguido)
    {
        $sql = "INSERT INTO seguido (idusuario, idseguido) VALUES (?, ?)";

        $conexao = ConexaoBD::conectar();

        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(1, $idusuario, PDO::PARAM_STR);
        $stmt->bindParam(2, $idseguido, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retorna apenas UM usuário
    }
    public static function deixarDeSeguir($idusuario, $idseguido)
    {
        $sql = "DELETE FROM seguido WHERE idusuario = ? AND idseguido = ?";

        $conexao = ConexaoBD::conectar();

        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(1, $idusuario, PDO::PARAM_STR);
        $stmt->bindParam(2, $idseguido, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retorna apenas UM usuário
    }

    public static function listarSeguidos($idusuario)
    {
        $sql = "SELECT u.* FROM seguido s
                JOIN usuario u ON s.idseguido = u.idusuario
                WHERE s.idusuario = ?";

        $conexao = ConexaoBD::conectar();

        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(1, $idusuario, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retorna todos os seguidos
    }

    public static function seguidoOuNao($idusuario, $idseguido)
    {
        $sql = "SELECT * FROM seguido WHERE idusuario = ? AND idseguido = ?";

        $conexao = ConexaoBD::conectar();

        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(1, $idusuario, PDO::PARAM_STR);
        $stmt->bindParam(2, $idseguido, PDO::PARAM_STR);
        $stmt->execute();


        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retorna apenas UM usuário

    }
}