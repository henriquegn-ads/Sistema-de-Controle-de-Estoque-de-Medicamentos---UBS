<?php

require_once __DIR__ . '/../../config/database.php';

class Movimentacao
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function listar(): array
    {
        $sql = "SELECT
                    mv.*,
                    l.numero_lote,
                    m.nome AS medicamento_nome,
                    u.nome AS usuario_nome
                FROM movimentacoes mv
                INNER JOIN lotes l
                    ON l.id = mv.lote_id
                INNER JOIN medicamentos m
                    ON m.id = l.medicamento_id
                INNER JOIN usuarios u
                    ON u.id = mv.usuario_id
                ORDER BY mv.data_movimentacao DESC";

        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarPorPeriodo(
        string $dataInicial,
        string $dataFinal
    ): array {
        $sql = "SELECT
                    mv.*,
                    l.numero_lote,
                    m.nome AS medicamento_nome,
                    u.nome AS usuario_nome
                FROM movimentacoes mv
                INNER JOIN lotes l
                    ON l.id = mv.lote_id
                INNER JOIN medicamentos m
                    ON m.id = l.medicamento_id
                INNER JOIN usuarios u
                    ON u.id = mv.usuario_id
                WHERE DATE(mv.data_movimentacao)
                BETWEEN :data_inicial AND :data_final
                ORDER BY mv.data_movimentacao DESC";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            'data_inicial' => $dataInicial,
            'data_final' => $dataFinal
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}