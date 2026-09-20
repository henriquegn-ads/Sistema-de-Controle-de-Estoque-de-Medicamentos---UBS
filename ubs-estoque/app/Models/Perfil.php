<?php

require_once __DIR__ . '/../../config/database.php';

class Perfil
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function listar(): array
    {
        $sql = "SELECT *
                FROM perfis
                ORDER BY nome";

        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId(int $id): ?array
    {
        $stmt = $this->pdo->prepare(
            "SELECT *
             FROM perfis
             WHERE id = :id"
        );

        $stmt->execute(['id' => $id]);

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        return $resultado ?: null;
    }

    public function criar(array $dados): bool
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO perfis (nome, descricao)
             VALUES (:nome, :descricao)"
        );

        return $stmt->execute([
            'nome' => $dados['nome'],
            'descricao' => $dados['descricao'] ?: null
        ]);
    }

    public function atualizar(int $id, array $dados): bool
    {
        $stmt = $this->pdo->prepare(
            "UPDATE perfis
             SET nome = :nome,
                 descricao = :descricao
             WHERE id = :id"
        );

        return $stmt->execute([
            'nome' => $dados['nome'],
            'descricao' => $dados['descricao'] ?: null,
            'id' => $id
        ]);
    }

    public function excluir(int $id): bool
    {
        $stmt = $this->pdo->prepare(
            "DELETE FROM perfis
             WHERE id = :id"
        );

        return $stmt->execute(['id' => $id]);
    }
}