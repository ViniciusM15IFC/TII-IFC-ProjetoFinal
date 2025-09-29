<?php
require "ConexaoBD.php";
require "Util.php";

class UsuarioDAO
{

    public static function cadastrarUsuario($dados)
    {
        // Verifica se as senhas coincidem
        if ($dados['senha'] !== $dados['confirmarsenha']) {
            echo "As senhas não coincidem!";
            return;
        }

        $conexao = ConexaoBD::conectar();

        // Criptografa a senha antes de salvar
        $senhaCriptografada = md5($dados['senha']);

        $sql = "INSERT INTO usuario (nomeusuario, email, senha, datanasc, foto) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conexao->prepare($sql);

        $foto = Util::salvarArquivo();

        // Bind dos parâmetros
        $stmt->bindParam(1, $dados['nome']);
        $stmt->bindParam(2, $dados['email']);
        $stmt->bindParam(3, $senhaCriptografada);
        $stmt->bindParam(4, $dados['datanasc']);
        $stmt->bindParam(5, $foto);

        // Executa a inserção
        $stmt->execute();
    }

    public static function validarUsuario($dados)
    {
        $senhaCriptografada = md5($dados['senha']);
        $sql = "SELECT * FROM usuario WHERE email = ? AND senha = ?";

        $conexao = ConexaoBD::conectar();
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(1, $dados['email']);
        $stmt->bindParam(2, $senhaCriptografada);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function consultarUsuario($email)
    {
        $sql = "SELECT * FROM usuario WHERE email = ?";

        $conexao = ConexaoBD::conectar();

        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(1, $email);
        $conexao = ConexaoBD::conectar();
        $resultado = $conexao->query($sql);

        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>