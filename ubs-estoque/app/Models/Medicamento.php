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
                (nome, principio_ativo, fabricante, unidade_medida)
                VALUES
                (:nome, :principio_ativo, :fabricante, :unidade_medida)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':nome' => $dados['nome'],
            ':principio_ativo' => $dados['principio_ativo'],
            ':fabricante' => $dados['fabricante'],
            ':unidade_medida' => $dados['unidade_medida']
        ]);
    }

    public function listar(): array
    {
        $sql = "SELECT
                    id,
                    nome,
                    principio_ativo,
                    fabricante,
                    unidade_medida,
                    created_at
                FROM medicamentos
                ORDER BY nome";

        $stmt = $this->db->query($sql);

        return $stmt->fetchAll();
    }

    public function buscarPorId(int $id): ?array
    {
        $sql = "SELECT
                    id,
                    nome,
                    principio_ativo,
                    fabricante,
                    unidade_medida,
                    created_at
                FROM medicamentos
                WHERE id = :id";

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
                    unidade_medida = :unidade_medida
                WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':id' => $id,
            ':nome' => $dados['nome'],
            ':principio_ativo' => $dados['principio_ativo'],
            ':fabricante' => $dados['fabricante'],
            ':unidade_medida' => $dados['unidade_medida']
        ]);
    }

    public function excluir(int $id): bool
    {
        $sql = "DELETE FROM medicamentos WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([':id' => $id]);
    }
}
