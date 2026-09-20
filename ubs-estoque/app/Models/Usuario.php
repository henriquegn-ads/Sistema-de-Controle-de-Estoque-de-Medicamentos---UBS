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
        $sql = "SELECT u.id, u.nome, u.email, u.senha, u.perfil_id,
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

    public function cadastrar(string $nome, string $email, string $senha, int $perfilId): bool
    {
        $sql = "INSERT INTO usuarios
                (nome, email, senha, perfil_id)
                VALUES (:nome, :email, :senha, :perfil_id)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':nome' => $nome,
            ':email' => $email,
            ':senha' => password_hash($senha, PASSWORD_DEFAULT),
            ':perfil_id' => $perfilId
        ]);
    }
}
