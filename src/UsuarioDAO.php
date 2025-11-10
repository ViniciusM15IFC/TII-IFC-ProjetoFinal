<?php
require_once __DIR__ . "/../src/autoload.php";

class UsuarioDAO
{

    public static function cadastrarUsuario($dados)
    {

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
        if ($stmt->rowCount() > 0) {
            return $usuario;
        } else {
            return false;

        }

    }

    public static function consultarUsuario($id)
    {
        $sql = "SELECT * FROM usuario WHERE idusuario = ?";

        $conexao = ConexaoBD::conectar();

        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_STR);
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
        $texto = "$texto%";

        $conexao = ConexaoBD::conectar();

        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(1, $texto, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retorna apenas UM usuário
    }

public static function excluirUsuario($idUsuario)
{
    $conexao = ConexaoBD::conectar();

    // Inicia uma transação para garantir integridade
    $conexao->beginTransaction();

    try {
        // 1️⃣ Apagar comentários feitos pelo usuário
        $sql = "DELETE FROM comentario WHERE idusuario = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->execute([$idUsuario]);

        // 2️⃣ Apagar postagens do usuário
        $sql = "DELETE FROM postagem WHERE idusuario = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->execute([$idUsuario]);

        // 3️⃣ Apagar relações de seguidores (seguindo ou sendo seguido)
        $sql = "DELETE FROM seguido WHERE idusuario = ? OR idseguido = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->execute([$idUsuario, $idUsuario]);

        // 4️⃣ Finalmente, apagar o próprio usuário
        $sql = "DELETE FROM usuario WHERE idusuario = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->execute([$idUsuario]);

        // Confirma as exclusões
        $conexao->commit();
    } catch (Exception $e) {
        // Reverte se der erro
        $conexao->rollBack();
        throw $e;
    }
}


    public static function listarSeguidos($idusuario)
    {
        $conexao = ConexaoBD::conectar();

        $sql = "SELECT u.*
            FROM seguido s
            JOIN usuario u ON s.idseguido = u.idusuario
            WHERE s.idusuario = ?";

        $stmt = $conexao->prepare($sql);
        $stmt->execute([$idusuario]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function restringirPerfil($idusuario)
    {
        $conexao = ConexaoBD::conectar();
        $sql = "UPDATE usuario SET restrito = 'true' WHERE idusuario = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(1, $idusuario, PDO::PARAM_INT);
        $stmt->execute();

    }

}
?>