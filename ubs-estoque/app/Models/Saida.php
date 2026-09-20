<?php

require_once __DIR__ . '/../../config/database.php';

class Saida
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function listar(): array
    {
        $sql = "SELECT
                    s.*,
                    l.numero_lote,
                    m.nome AS medicamento_nome,
                    u.nome AS usuario_nome
                FROM saidas s
                INNER JOIN lotes l
                    ON l.id = s.lote_id
                INNER JOIN medicamentos m
                    ON m.id = l.medicamento_id
                INNER JOIN usuarios u
                    ON u.id = s.usuario_id
                ORDER BY s.data_saida DESC";

        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function criar(array $dados): bool
    {
        try {
            $this->pdo->beginTransaction();

            $stmt = $this->pdo->prepare(
                "SELECT quantidade
                 FROM lotes
                 WHERE id = :id
                 FOR UPDATE"
            );

            $stmt->execute([
                'id' => $dados['lote_id']
            ]);

            $lote = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$lote || $lote['quantidade'] < $dados['quantidade']) {
                throw new Exception('Estoque insuficiente.');
            }

            $stmt = $this->pdo->prepare(
                "INSERT INTO saidas
                (lote_id, usuario_id, destino,
                 quantidade, observacao)
                VALUES
                (:lote_id, :usuario_id, :destino,
                 :quantidade, :observacao)"
            );

            $stmt->execute([
                'lote_id' => $dados['lote_id'],
                'usuario_id' => $dados['usuario_id'],
                'destino' => $dados['destino'] ?: null,
                'quantidade' => $dados['quantidade'],
                'observacao' => $dados['observacao'] ?: null
            ]);

            $stmt = $this->pdo->prepare(
                "UPDATE lotes
                 SET quantidade = quantidade - :quantidade
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
                (:lote_id, :usuario_id, 'SAIDA',
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
        } catch (Throwable $e) {
            if ($this->pdo->inTransaction()) {
                $this->pdo->rollBack();
            }

            throw $e;
        }
    }
}