<?php
require_once "ConexaoBD.php";
require "Util.php";

class AdminDAO
{
    public static function validarAdmin($idusuario)
    {
        $sql = "SELECT * FROM admin WHERE idusuario = ?";

        $conexao = ConexaoBD::conectar();
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(1, $idusuario);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>