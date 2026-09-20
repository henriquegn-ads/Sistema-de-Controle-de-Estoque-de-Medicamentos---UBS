<?php

require_once __DIR__ . '/../../config/database.php';

class Lote
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function listar(): array
    {
        $sql = "SELECT
                    l.*,
                    m.nome AS medicamento_nome
                FROM lotes l
                INNER JOIN medicamentos m
                    ON m.id = l.medicamento_id
                ORDER BY l.data_validade";

        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId(int $id): ?array
    {
        $stmt = $this->pdo->prepare(
            "SELECT
                l.*,
                m.nome AS medicamento_nome
             FROM lotes l
             INNER JOIN medicamentos m
                ON m.id = l.medicamento_id
             WHERE l.id = :id"
        );

        $stmt->execute(['id' => $id]);

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        return $resultado ?: null;
    }

    public function criar(array $dados): bool
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO lotes
            (medicamento_id, numero_lote,
             data_fabricacao, data_validade, quantidade)
            VALUES
            (:medicamento_id, :numero_lote,
             :data_fabricacao, :data_validade, :quantidade)"
        );

        return $stmt->execute([
            'medicamento_id' => $dados['medicamento_id'],
            'numero_lote' => $dados['numero_lote'],
            'data_fabricacao' => $dados['data_fabricacao'] ?: null,
            'data_validade' => $dados['data_validade'],
            'quantidade' => $dados['quantidade']
        ]);
    }

    public function atualizarQuantidade(
        int $id,
        int $quantidade
    ): bool {
        $stmt = $this->pdo->prepare(
            "UPDATE lotes
             SET quantidade = :quantidade
             WHERE id = :id"
        );

        return $stmt->execute([
            'quantidade' => $quantidade,
            'id' => $id
        ]);
    }
}