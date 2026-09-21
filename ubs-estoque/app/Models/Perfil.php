<?php

require_once __DIR__ . '/../../config/database.php';

class Perfil
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function listar(string $busca = ''): array
    {
        $sql = "SELECT
                    p.id,
                    p.nome,
                    COUNT(u.id) AS total_usuarios
                FROM perfis p
                LEFT JOIN usuarios u ON u.perfil_id = p.id";

        $params = [];

        if ($busca !== '') {
            $sql .= " WHERE p.nome LIKE :busca";
            $params[':busca'] = '%' . $busca . '%';
        }

        $sql .= " GROUP BY p.id, p.nome
                  ORDER BY p.nome";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll();
    }

    public function buscarPorId(int $id): ?array
    {
        $stmt = $this->db->prepare(
            "SELECT
                p.id,
                p.nome,
                COUNT(u.id) AS total_usuarios
             FROM perfis p
             LEFT JOIN usuarios u ON u.perfil_id = p.id
             WHERE p.id = :id
             GROUP BY p.id, p.nome
             LIMIT 1"
        );

        $stmt->execute([
            ':id' => $id
        ]);

        $perfil = $stmt->fetch();

        return $perfil ?: null;
    }

    public function cadastrar(string $nome): bool
    {
        $stmt = $this->db->prepare(
            "INSERT INTO perfis (nome)
             VALUES (:nome)"
        );

        return $stmt->execute([
            ':nome' => $nome
        ]);
    }

    public function atualizar(int $id, string $nome): bool
    {
        $stmt = $this->db->prepare(
            "UPDATE perfis
             SET nome = :nome
             WHERE id = :id"
        );

        return $stmt->execute([
            ':id' => $id,
            ':nome' => $nome
        ]);
    }

    public function existeNome(string $nome, ?int $id = null): bool
    {
        $sql = "SELECT id
                FROM perfis
                WHERE nome = :nome";

        $params = [
            ':nome' => $nome
        ];

        if ($id !== null) {
            $sql .= " AND id <> :id";
            $params[':id'] = $id;
        }

        $sql .= " LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return (bool) $stmt->fetch();
    }

    public function excluir(int $id): bool
    {
        if ($id === 1) {
            return false;
        }

        $stmt = $this->db->prepare(
            "DELETE FROM perfis
             WHERE id = :id
             AND id <> 1"
        );

        return $stmt->execute([
            ':id' => $id
        ]);
    }
}