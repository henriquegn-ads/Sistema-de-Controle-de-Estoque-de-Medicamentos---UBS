<?php

require_once __DIR__ . '/../../config/database.php';

class Arquivo
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function listar(): array
    {
        $sql = "SELECT
                    a.*,
                    u.nome AS usuario_nome
                FROM arquivos a
                LEFT JOIN usuarios u
                    ON u.id = a.usuario_id
                ORDER BY a.data_upload DESC";

        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId(int $id): ?array
    {
        $stmt = $this->pdo->prepare(
            "SELECT *
             FROM arquivos
             WHERE id = :id"
        );

        $stmt->execute(['id' => $id]);

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        return $resultado ?: null;
    }

    public function criar(array $dados): bool
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO arquivos
            (usuario_id, nome_original,
             nome_servidor, tipo, tamanho)
            VALUES
            (:usuario_id, :nome_original,
             :nome_servidor, :tipo, :tamanho)"
        );

        return $stmt->execute([
            'usuario_id' => $dados['usuario_id'],
            'nome_original' => $dados['nome_original'],
            'nome_servidor' => $dados['nome_servidor'],
            'tipo' => $dados['tipo'],
            'tamanho' => $dados['tamanho']
        ]);
    }

    public function excluir(int $id): bool
    {
        $stmt = $this->pdo->prepare(
            "DELETE FROM arquivos
             WHERE id = :id"
        );

        return $stmt->execute(['id' => $id]);
    }
}