<?php

require_once __DIR__ . '/../../config/database.php';

class Usuario
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function listar(): array
    {
        $sql = "SELECT u.*, p.nome AS perfil_nome
                FROM usuarios u
                INNER JOIN perfis p ON p.id = u.perfil_id
                ORDER BY u.nome";

        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId(int $id): ?array
    {
        $sql = "SELECT u.*, p.nome AS perfil_nome
                FROM usuarios u
                INNER JOIN perfis p ON p.id = u.perfil_id
                WHERE u.id = :id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        return $resultado ?: null;
    }

    public function buscarPorUsuario(string $usuario): ?array
    {
        $sql = "SELECT *
                FROM usuarios
                WHERE usuario = :usuario
                LIMIT 1";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['usuario' => $usuario]);

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        return $resultado ?: null;
    }

    public function criar(array $dados): bool
    {
        $sql = "INSERT INTO usuarios
                (nome, cpf, email, telefone, usuario, senha, perfil_id, ativo)
                VALUES
                (:nome, :cpf, :email, :telefone, :usuario, :senha, :perfil_id, 1)";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            'nome' => $dados['nome'],
            'cpf' => $dados['cpf'] ?: null,
            'email' => $dados['email'],
            'telefone' => $dados['telefone'] ?: null,
            'usuario' => $dados['usuario'],
            'senha' => $dados['senha'],
            'perfil_id' => $dados['perfil_id']
        ]);
    }

    public function atualizar(int $id, array $dados): bool
    {
        if (isset($dados['senha'])) {
            $sql = "UPDATE usuarios
                    SET nome = :nome,
                        cpf = :cpf,
                        email = :email,
                        telefone = :telefone,
                        usuario = :usuario,
                        senha = :senha,
                        perfil_id = :perfil_id,
                        ativo = :ativo
                    WHERE id = :id";

            $parametros = [
                'nome' => $dados['nome'],
                'cpf' => $dados['cpf'] ?: null,
                'email' => $dados['email'],
                'telefone' => $dados['telefone'] ?: null,
                'usuario' => $dados['usuario'],
                'senha' => $dados['senha'],
                'perfil_id' => $dados['perfil_id'],
                'ativo' => $dados['ativo'],
                'id' => $id
            ];
        } else {
            $sql = "UPDATE usuarios
                    SET nome = :nome,
                        cpf = :cpf,
                        email = :email,
                        telefone = :telefone,
                        usuario = :usuario,
                        perfil_id = :perfil_id,
                        ativo = :ativo
                    WHERE id = :id";

            $parametros = [
                'nome' => $dados['nome'],
                'cpf' => $dados['cpf'] ?: null,
                'email' => $dados['email'],
                'telefone' => $dados['telefone'] ?: null,
                'usuario' => $dados['usuario'],
                'perfil_id' => $dados['perfil_id'],
                'ativo' => $dados['ativo'],
                'id' => $id
            ];
        }

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute($parametros);
    }

    public function excluir(int $id): bool
    {
        $stmt = $this->pdo->prepare(
            "DELETE FROM usuarios WHERE id = :id"
        );

        return $stmt->execute(['id' => $id]);
    }
}