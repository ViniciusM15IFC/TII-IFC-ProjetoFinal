<?php
require_once "ConexaoBD.php";

class PostagemDAO
{
    // ===============================
    // RF4 - Criar postagem/avaliação
    // ===============================
    public static function criarPostagem($dados)
    {
        try {
            $sql = "INSERT INTO postagem (idusuario, idconteudo, idcategoria, nota, texto, datapostagem)
                VALUES (?, ?, ?, ?, ?, NOW())";

            $conexao = ConexaoBD::conectar();
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(1, $dados['idusuario'], PDO::PARAM_INT);  // Corrigido: use $dados['idusuario']
            $stmt->bindParam(2, $dados['idconteudo'], PDO::PARAM_INT);
            $stmt->bindParam(3, $dados['idcategoria'], PDO::PARAM_INT);
            $stmt->bindParam(4, $dados['nota'], PDO::PARAM_INT);
            $stmt->bindParam(5, $dados['texto'], PDO::PARAM_STR);

            if ($stmt->execute()) {
                return true;  // Sucesso
            } else {
                return false;  // Falha na execução
            }
        } catch (PDOException $e) {
            error_log("Erro ao criar postagem: " . $e->getMessage());
            return false;  // Falha por exceção
        }
    }

    // ===============================
    // Listar todas as postagens
    // ===============================
    public static function listar()
    {
        $sql = "SELECT 
                p.*,
                u.nomeusuario,
                u.foto,
                COALESCE(f.nomefilme, s.nomeserie, l.nomelivro) AS nomeconteudo,
                COALESCE(f.imagem, s.imagem, l.imagem) AS imagemconteudo
            FROM postagem p
            JOIN usuario u ON p.idusuario = u.idusuario
            LEFT JOIN filme f ON p.idcategoria = 1 AND p.idconteudo = f.idfilme
            LEFT JOIN serie s ON p.idcategoria = 2 AND p.idconteudo = s.idserie
            LEFT JOIN livro l ON p.idcategoria = 3 AND p.idconteudo = l.idlivro
            ORDER BY p.datapostagem DESC";

        $conexao = ConexaoBD::conectar();
        $stmt = $conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public static function listarFeed($idUsuario)
    {
        $sql = "SELECT 
        p.*,
        u.nomeusuario,
        u.foto,
        COALESCE(f.nomefilme, s.nomeserie, l.nomelivro) AS nomeconteudo,
        COALESCE(f.imagem, s.imagem, l.imagem) AS imagemconteudo
        FROM postagem p
        JOIN usuario u ON p.idusuario = u.idusuario
        LEFT JOIN filme f ON p.idcategoria = 1 AND p.idconteudo = f.idfilme
        LEFT JOIN serie s ON p.idcategoria = 2 AND p.idconteudo = s.idserie
        LEFT JOIN livro l ON p.idcategoria = 3 AND p.idconteudo = l.idlivro
        WHERE p.idusuario = :idUsuario
        OR p.idusuario IN (
            SELECT s.idseguido FROM seguido s WHERE s.idusuario = :idUsuario
        )
        ORDER BY p.datapostagem DESC;
        ";

        $conexao = ConexaoBD::conectar();
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // ===============================
    // Listar postagens de um usuário
    // ===============================
    public static function listarPorUsuario($idUsuario)
    {
        $sql = "SELECT p.*, 
                   u.nomeusuario, 
                   IFNULL(u.foto, 'profile-placeholder.png') AS foto,  -- Valor padrão caso foto seja nula
                   COALESCE(f.nomefilme, s.nomeserie, l.nomelivro) AS nomeconteudo,
                   COALESCE(f.imagem, s.imagem, l.imagem) AS imagemconteudo
            FROM postagem p
            JOIN usuario u ON p.idusuario = u.idusuario
            LEFT JOIN filme f ON p.idcategoria = 1 AND p.idconteudo = f.idfilme
            LEFT JOIN serie s ON p.idcategoria = 2 AND p.idconteudo = s.idserie
            LEFT JOIN livro l ON p.idcategoria = 3 AND p.idconteudo = l.idlivro
            WHERE p.idusuario = ?
            ORDER BY p.datapostagem DESC";

        $conexao = ConexaoBD::conectar();
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(1, $idUsuario, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ===============================
    // Excluir postagem (por dono ou admin)
    // ===============================
    public static function excluirPostagem($idPostagem)
    {
        $sql = "DELETE FROM postagem WHERE idpostagem = ?";
        $conexao = ConexaoBD::conectar();
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(1, $idPostagem, PDO::PARAM_INT);
        $stmt->execute();
    }

    // ===============================
// Obter autor de uma postagem
// ===============================
    public static function getAutorPostagem($idPostagem)
    {
        $sql = "SELECT idusuario FROM postagem WHERE idpostagem = ?";
        $conexao = ConexaoBD::conectar();
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(1, $idPostagem, PDO::PARAM_INT);
        $stmt->execute();

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        return $resultado ? $resultado['idusuario'] : null;
    }

    public static function buscarFeed($idUsuario, $texto)
    {
        // Criar a consulta SQL com filtros por texto, nome do usuário, e nome do conteúdo (filme/série/livro)
        $sql = "SELECT 
            p.*,
            u.nomeusuario,
            u.foto,
            COALESCE(f.nomefilme, s.nomeserie, l.nomelivro) AS nomeconteudo,
            COALESCE(f.imagem, s.imagem, l.imagem) AS imagemconteudo
        FROM postagem p
        JOIN usuario u ON p.idusuario = u.idusuario
        LEFT JOIN filme f ON p.idcategoria = 1 AND p.idconteudo = f.idfilme
        LEFT JOIN serie s ON p.idcategoria = 2 AND p.idconteudo = s.idserie
        LEFT JOIN livro l ON p.idcategoria = 3 AND p.idconteudo = l.idlivro
        WHERE (p.idusuario = :idUsuario
            OR p.idusuario IN (
                SELECT s.idseguido FROM seguido s WHERE s.idusuario = :idUsuario
            ))
            AND (
                p.texto LIKE :texto 
                OR f.nomefilme LIKE :texto  -- Busca por nome de filme
                OR s.nomeserie LIKE :texto  -- Busca por nome de série
                OR l.nomelivro LIKE :texto  -- Busca por nome de livro
                OR u.nomeusuario LIKE :texto  -- Busca por nome de usuário
            )
        ORDER BY p.datapostagem DESC";

        // Conectar ao banco de dados
        $conexao = ConexaoBD::conectar();
        $stmt = $conexao->prepare($sql);

        // Definir os parâmetros da consulta
        $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
        $stmt->bindValue(':texto', '%' . $texto . '%', PDO::PARAM_STR);  // Adiciona os caracteres de coringa ao redor do texto

        // Executar a consulta
        $stmt->execute();

        // Retornar os resultados
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function buscarTudo($texto)
    {
        // Criar a consulta SQL com filtros por texto, nome do usuário, e nome do conteúdo (filme/série/livro)
        $sql = "SELECT 
            p.*,
            u.nomeusuario,
            u.foto,
            COALESCE(f.nomefilme, s.nomeserie, l.nomelivro) AS nomeconteudo,
            COALESCE(f.imagem, s.imagem, l.imagem) AS imagemconteudo
        FROM postagem p
        JOIN usuario u ON p.idusuario = u.idusuario
        LEFT JOIN filme f ON p.idcategoria = 1 AND p.idconteudo = f.idfilme
        LEFT JOIN serie s ON p.idcategoria = 2 AND p.idconteudo = s.idserie
        LEFT JOIN livro l ON p.idcategoria = 3 AND p.idconteudo = l.idlivro
        WHERE (
                p.texto LIKE :texto 
                OR f.nomefilme LIKE :texto  -- Busca por nome de filme
                OR s.nomeserie LIKE :texto  -- Busca por nome de série
                OR l.nomelivro LIKE :texto  -- Busca por nome de livro
                OR u.nomeusuario LIKE :texto  -- Busca por nome de usuário
            )
        ORDER BY p.datapostagem DESC";

        // Conectar ao banco de dados
        $conexao = ConexaoBD::conectar();
        $stmt = $conexao->prepare($sql);

        // Definir os parâmetros da consulta
        $stmt->bindValue(':texto', '%' . $texto . '%', PDO::PARAM_STR);  // Adiciona os caracteres de coringa ao redor do texto

        // Executar a consulta
        $stmt->execute();

        // Retornar os resultados
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>