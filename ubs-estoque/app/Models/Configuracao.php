<?php

require_once __DIR__ . '/../../config/database.php';

class Configuracao
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function buscar(): ?array
    {
        $stmt = $this->pdo->query(
            "SELECT *
             FROM configuracoes
             ORDER BY id
             LIMIT 1"
        );

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        return $resultado ?: null;
    }

    public function atualizar(array $dados): bool
    {
        $configuracao = $this->buscar();

        if ($configuracao) {
            $stmt = $this->pdo->prepare(
                "UPDATE configuracoes
                 SET nome_unidade = :nome_unidade,
                     cnes = :cnes,
                     endereco = :endereco,
                     bairro = :bairro,
                     cidade = :cidade,
                     estado = :estado
                 WHERE id = :id"
            );

            return $stmt->execute([
                'nome_unidade' => $dados['nome_unidade'],
                'cnes' => $dados['cnes'],
                'endereco' => $dados['endereco'],
                'bairro' => $dados['bairro'],
                'cidade' => $dados['cidade'],
                'estado' => $dados['estado'],
                'id' => $configuracao['id']
            ]);
        }

        $stmt = $this->pdo->prepare(
            "INSERT INTO configuracoes
            (nome_unidade, cnes, endereco,
             bairro, cidade, estado)
            VALUES
            (:nome_unidade, :cnes, :endereco,
             :bairro, :cidade, :estado)"
        );

        return $stmt->execute([
            'nome_unidade' => $dados['nome_unidade'],
            'cnes' => $dados['cnes'],
            'endereco' => $dados['endereco'],
            'bairro' => $dados['bairro'],
            'cidade' => $dados['cidade'],
            'estado' => $dados['estado']
        ]);
    }
}