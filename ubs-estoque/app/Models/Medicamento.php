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
}