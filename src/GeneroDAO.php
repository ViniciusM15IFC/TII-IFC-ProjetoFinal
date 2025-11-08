<?php
require "autoload.php";


class GeneroDAO
{
    public static function consultar()
    {
        $conexao = ConexaoBD::conectar();
        $sql = "SELECT * FROM genero";
        $stmt = $conexao->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function consultarPorID($id)
    {
        $conexao = ConexaoBD::conectar();
        $sql = "SELECT * FROM genero WHERE idgenero = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}