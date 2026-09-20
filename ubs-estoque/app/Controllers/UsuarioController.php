<?php

require_once __DIR__ . '/../Models/Usuario.php';
require_once __DIR__ . '/../Models/Perfil.php';
require_once __DIR__ . '/../../config/auth.php';

class UsuarioController
{
    private Usuario $usuario;
    private Perfil $perfil;

    public function __construct()
    {
        $this->usuario = new Usuario();
        $this->perfil = new Perfil();
    }

    public function create(): void
    {
        Auth::exigirPerfil(['Administrador']);

        $perfis = $this->perfil->listar();
        $erro = $_SESSION['erro_usuario'] ?? null;
        $sucesso = $_SESSION['sucesso_usuario'] ?? null;

        unset($_SESSION['erro_usuario'], $_SESSION['sucesso_usuario']);

        require_once __DIR__ . '/../Views/usuarios/create.php';
    }

    public function store(): void
    {
        Auth::exigirPerfil(['Administrador']);

        $nome = trim($_POST['nome'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $senha = $_POST['senha'] ?? '';
        $perfilId = (int) ($_POST['perfil_id'] ?? 0);

        if ($nome === '' || $email === '' || $senha === '' || $perfilId <= 0) {
            $_SESSION['erro_usuario'] = 'Preencha todos os campos obrigatórios.';
            header('Location: /ubs-estoque/public/usuarios/create');
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['erro_usuario'] = 'Informe um e-mail válido.';
            header('Location: /ubs-estoque/public/usuarios/create');
            exit;
        }

        try {
            $this->usuario->cadastrar($nome, $email, $senha, $perfilId);
            $_SESSION['sucesso_usuario'] = 'Usuário cadastrado com sucesso.';
        } catch (PDOException $e) {
            $_SESSION['erro_usuario'] = 'Não foi possível cadastrar o usuário.';
        }

        header('Location: /ubs-estoque/public/usuarios/create');
        exit;
    }
}
