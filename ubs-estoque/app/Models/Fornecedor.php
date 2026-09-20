<?php

require_once __DIR__ . '/../../config/database.php';

class Fornecedor
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function listar(): array
    {
        return $this->pdo
            ->query("SELECT * FROM fornecedores ORDER BY razao_social")
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId(int $id): ?array
    {
        $stmt = $this->pdo->prepare(
            "SELECT *
             FROM fornecedores
             WHERE id = :id"
        );

        $stmt->execute(['id' => $id]);

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        return $resultado ?: null;
    }

    public function criar(array $dados): bool
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO fornecedores
            (razao_social, nome_fantasia, cnpj, telefone,
             email, endereco, cidade, estado)
            VALUES
            (:razao_social, :nome_fantasia, :cnpj, :telefone,
             :email, :endereco, :cidade, :estado)"
        );

        return $stmt->execute([
            'razao_social' => $dados['razao_social'],
            'nome_fantasia' => $dados['nome_fantasia'] ?: null,
            'cnpj' => $dados['cnpj'] ?: null,
            'telefone' => $dados['telefone'] ?: null,
            'email' => $dados['email'] ?: null,
            'endereco' => $dados['endereco'] ?: null,
            'cidade' => $dados['cidade'] ?: null,
            'estado' => $dados['estado'] ?: null
        ]);
    }

    public function atualizar(int $id, array $dados): bool
    {
        $stmt = $this->pdo->prepare(
            "UPDATE fornecedores
             SET razao_social = :razao_social,
                 nome_fantasia = :nome_fantasia,
                 cnpj = :cnpj,
                 telefone = :telefone,
                 email = :email,
                 endereco = :endereco,
                 cidade = :cidade,
                 estado = :estado
             WHERE id = :id"
        );

        return $stmt->execute([
            'razao_social' => $dados['razao_social'],
            'nome_fantasia' => $dados['nome_fantasia'] ?: null,
            'cnpj' => $dados['cnpj'] ?: null,
            'telefone' => $dados['telefone'] ?: null,
            'email' => $dados['email'] ?: null,
            'endereco' => $dados['endereco'] ?: null,
            'cidade' => $dados['cidade'] ?: null,
            'estado' => $dados['estado'] ?: null,
            'id' => $id
        ]);
    }

    public function excluir(int $id): bool
    {
        $stmt = $this->pdo->prepare(
            "DELETE FROM fornecedores
             WHERE id = :id"
        );

        return $stmt->execute(['id' => $id]);
    }
}