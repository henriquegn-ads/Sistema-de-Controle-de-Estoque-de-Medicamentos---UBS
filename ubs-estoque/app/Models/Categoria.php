<?php

require_once __DIR__ . '/../../config/database.php';

class Categoria
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function listar(): array
    {
        $sql = "SELECT *
                FROM categorias
                ORDER BY nome";

        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId(int $id): ?array
    {
        $stmt = $this->pdo->prepare(
            "SELECT *
             FROM categorias
             WHERE id = :id"
        );

        $stmt->execute(['id' => $id]);

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        return $resultado ?: null;
    }

    public function criar(string $nome): bool
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO categorias (nome)
             VALUES (:nome)"
        );

        return $stmt->execute([
            'nome' => $nome
        ]);
    }

    public function atualizar(int $id, string $nome): bool
    {
        $stmt = $this->pdo->prepare(
            "UPDATE categorias
             SET nome = :nome
             WHERE id = :id"
        );

        return $stmt->execute([
            'nome' => $nome,
            'id' => $id
        ]);
    }

    public function excluir(int $id): bool
    {
        $stmt = $this->pdo->prepare(
            "DELETE FROM categorias
             WHERE id = :id"
        );

        return $stmt->execute(['id' => $id]);
    }
}