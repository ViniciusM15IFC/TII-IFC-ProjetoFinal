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

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        if($stmt->rowCount() > 0) {
            return $usuario['idusuario'];
        } else {
            return false; 

        }
    
    }

    public static function consultarUsuario($email)
    {
        $sql = "SELECT * FROM usuario WHERE email = ?";

        $conexao = ConexaoBD::conectar();

        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(1, $email, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC); // Retorna apenas UM usuário
    }

    public static function listarUsuarios()
    {
        $sql = "SELECT * FROM usuario";

        $conexao = ConexaoBD::conectar();

        $stmt = $conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retorna apenas UM usuário
    }

    public static function buscarUsuarios($texto)
    {
        $sql = "SELECT * FROM usuario WHERE nomeusuario LIKE ?";

        $conexao = ConexaoBD::conectar();

        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(1, $texto, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retorna apenas UM usuário
    }
}
?>