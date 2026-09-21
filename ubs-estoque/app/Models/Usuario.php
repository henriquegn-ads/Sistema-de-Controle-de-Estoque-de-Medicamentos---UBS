<?php

require_once __DIR__ . '/../../config/database.php';

class Usuario
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function buscarPorEmail(string $email): ?array
    {
        $sql = "SELECT u.id, u.nome, u.email, u.senha, u.perfil_id, u.ativo,
                       p.nome AS perfil_nome
                FROM usuarios u
                INNER JOIN perfis p ON p.id = u.perfil_id
                WHERE u.email = :email
                LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':email' => $email]);

        $usuario = $stmt->fetch();

        return $usuario ?: null;
    }

    public function listar(): array
    {
        $sql = "SELECT u.id, u.nome, u.email, u.perfil_id, u.ativo,
                       p.nome AS perfil_nome
                FROM usuarios u
                INNER JOIN perfis p ON p.id = u.perfil_id
                ORDER BY u.nome";

        return $this->db->query($sql)->fetchAll();
    }

    public function buscarPorId(int $id): ?array
    {
        $stmt = $this->db->prepare(
            "SELECT u.id, u.nome, u.email, u.perfil_id, u.ativo,
                    p.nome AS perfil_nome
             FROM usuarios u
             INNER JOIN perfis p ON p.id = u.perfil_id
             WHERE u.id = :id
             LIMIT 1"
        );

        $stmt->execute([':id' => $id]);

        $usuario = $stmt->fetch();

        return $usuario ?: null;
    }

    public function cadastrar(string $nome, string $email, string $senha, int $perfilId): bool
    {
        $stmt = $this->db->prepare(
            "INSERT INTO usuarios
             (nome, email, senha, perfil_id, ativo)
             VALUES (:nome, :email, :senha, :perfil_id, 1)"
        );

        return $stmt->execute([
            ':nome' => $nome,
            ':email' => $email,
            ':senha' => password_hash($senha, PASSWORD_DEFAULT),
            ':perfil_id' => $perfilId
        ]);
    }

    public function atualizar(int $id, string $nome, string $email, int $perfilId, ?string $senha = null): bool
    {
        if ($senha !== null && $senha !== '') {
            $stmt = $this->db->prepare(
                "UPDATE usuarios
                 SET nome = :nome,
                     email = :email,
                     senha = :senha,
                     perfil_id = :perfil_id
                 WHERE id = :id"
            );

            return $stmt->execute([
                ':id' => $id,
                ':nome' => $nome,
                ':email' => $email,
                ':senha' => password_hash($senha, PASSWORD_DEFAULT),
                ':perfil_id' => $perfilId
            ]);
        }

        $stmt = $this->db->prepare(
            "UPDATE usuarios
             SET nome = :nome,
                 email = :email,
                 perfil_id = :perfil_id
             WHERE id = :id"
        );

        return $stmt->execute([
            ':id' => $id,
            ':nome' => $nome,
            ':email' => $email,
            ':perfil_id' => $perfilId
        ]);
    }

    public function alterarStatus(int $id): bool
    {
        $stmt = $this->db->prepare(
            "UPDATE usuarios
             SET ativo = IF(ativo = 1, 0, 1)
             WHERE id = :id"
        );

        return $stmt->execute([':id' => $id]);
    }

    public function excluir(int $id): bool
    {
        $stmt = $this->db->prepare(
            "DELETE FROM usuarios WHERE id = :id"
        );

        return $stmt->execute([':id' => $id]);
    }
}
