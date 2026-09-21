<?php

require_once __DIR__ . '/../../config/database.php';

class Medicamento
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function cadastrar(array $dados): bool
    {
        $sql = "INSERT INTO medicamentos
                (nome, principio_ativo, fabricante, unidade_medida, estoque_minimo)
                VALUES
                (:nome, :principio_ativo, :fabricante, :unidade_medida, :estoque_minimo)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':nome' => $dados['nome'],
            ':principio_ativo' => $dados['principio_ativo'],
            ':fabricante' => $dados['fabricante'],
            ':unidade_medida' => $dados['unidade_medida'],
            ':estoque_minimo' => $dados['estoque_minimo']
        ]);
    }

    public function listar(): array
    {
        $sql = "SELECT
                    m.id,
                    m.nome,
                    m.principio_ativo,
                    m.fabricante,
                    m.unidade_medida,
                    m.estoque_minimo,
                    COALESCE(SUM(CASE
                        WHEN mv.tipo = 'ENTRADA' THEN mv.quantidade
                        WHEN mv.tipo = 'SAIDA' THEN -mv.quantidade
                        ELSE 0
                    END), 0) AS saldo_atual,
                    m.created_at
                FROM medicamentos m
                LEFT JOIN lotes l
                    ON l.medicamento_id = m.id
                LEFT JOIN movimentacoes mv
                    ON mv.lote_id = l.id
                GROUP BY
                    m.id,
                    m.nome,
                    m.principio_ativo,
                    m.fabricante,
                    m.unidade_medida,
                    m.estoque_minimo,
                    m.created_at
                ORDER BY m.nome";

        return $this->db->query($sql)->fetchAll();
    }

    public function buscarPorId(int $id): ?array
    {
        $sql = "SELECT
                    m.id,
                    m.nome,
                    m.principio_ativo,
                    m.fabricante,
                    m.unidade_medida,
                    m.estoque_minimo,
                    COALESCE(SUM(CASE
                        WHEN mv.tipo = 'ENTRADA' THEN mv.quantidade
                        WHEN mv.tipo = 'SAIDA' THEN -mv.quantidade
                        ELSE 0
                    END), 0) AS saldo_atual,
                    m.created_at
                FROM medicamentos m
                LEFT JOIN lotes l
                    ON l.medicamento_id = m.id
                LEFT JOIN movimentacoes mv
                    ON mv.lote_id = l.id
                WHERE m.id = :id
                GROUP BY
                    m.id,
                    m.nome,
                    m.principio_ativo,
                    m.fabricante,
                    m.unidade_medida,
                    m.estoque_minimo,
                    m.created_at";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);

        $medicamento = $stmt->fetch();

        return $medicamento ?: null;
    }

    public function atualizar(int $id, array $dados): bool
    {
        $sql = "UPDATE medicamentos
                SET nome = :nome,
                    principio_ativo = :principio_ativo,
                    fabricante = :fabricante,
                    unidade_medida = :unidade_medida,
                    estoque_minimo = :estoque_minimo
                WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':id' => $id,
            ':nome' => $dados['nome'],
            ':principio_ativo' => $dados['principio_ativo'],
            ':fabricante' => $dados['fabricante'],
            ':unidade_medida' => $dados['unidade_medida'],
            ':estoque_minimo' => $dados['estoque_minimo']
        ]);
    }

    public function excluir(int $id): bool
    {
        $sql = "DELETE FROM medicamentos WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([':id' => $id]);
    }
}
