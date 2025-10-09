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
}