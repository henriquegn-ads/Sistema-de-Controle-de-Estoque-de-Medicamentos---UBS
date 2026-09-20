<?php

require_once __DIR__ . '/../../config/database.php';

class Perfil
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function listar(): array
    {
        return $this->db->query("SELECT id, nome FROM perfis ORDER BY nome")->fetchAll();
    }
}
