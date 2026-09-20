<?php

require_once __DIR__ . '/../../config/database.php';

class Entrada
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function listar(): array
    {
        $sql = "SELECT
                    e.*,
                    l.numero_lote,
                    m.nome AS medicamento_nome,
                    f.razao_social AS fornecedor_nome,
                    u.nome AS usuario_nome
                FROM entradas e
                INNER JOIN lotes l
                    ON l.id = e.lote_id
                INNER JOIN medicamentos m
                    ON m.id = l.medicamento_id
                INNER JOIN fornecedores f
                    ON f.id = e.fornecedor_id
                INNER JOIN usuarios u
                    ON u.id = e.usuario_id
                ORDER BY e.data_entrada DESC";

        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function criar(array $dados): bool
    {
        try {
            $this->pdo->beginTransaction();

            $stmt = $this->pdo->prepare(
                "INSERT INTO entradas
                (lote_id, fornecedor_id, usuario_id,
                 quantidade, valor_unitario, observacao)
                VALUES
                (:lote_id, :fornecedor_id, :usuario_id,
                 :quantidade, :valor_unitario, :observacao)"
            );

            $stmt->execute([
                'lote_id' => $dados['lote_id'],
                'fornecedor_id' => $dados['fornecedor_id'],
                'usuario_id' => $dados['usuario_id'],
                'quantidade' => $dados['quantidade'],
                'valor_unitario' => $dados['valor_unitario'],
                'observacao' => $dados['observacao'] ?: null
            ]);

            $stmt = $this->pdo->prepare(
                "UPDATE lotes
                 SET quantidade = quantidade + :quantidade
                 WHERE id = :lote_id"
            );

            $stmt->execute([
                'quantidade' => $dados['quantidade'],
                'lote_id' => $dados['lote_id']
            ]);

            $stmt = $this->pdo->prepare(
                "INSERT INTO movimentacoes
                (lote_id, usuario_id, tipo, quantidade, observacao)
                VALUES
                (:lote_id, :usuario_id, 'ENTRADA',
                 :quantidade, :observacao)"
            );

            $stmt->execute([
                'lote_id' => $dados['lote_id'],
                'usuario_id' => $dados['usuario_id'],
                'quantidade' => $dados['quantidade'],
                'observacao' => $dados['observacao'] ?: null
            ]);

            $this->pdo->commit();

            return true;
        } catch (PDOException $e) {
            $this->pdo->rollBack();
            throw $e;
        }
    }
}