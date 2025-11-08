<?php
class ConexaoBD{
    public static function conectar():PDO{
        $conexao = new PDO("mysql:host=localhost:3306;dbname=tii-ifc-projetofinal","root","1234");
        return $conexao;
    }
}

ConexaoBD::conectar();
