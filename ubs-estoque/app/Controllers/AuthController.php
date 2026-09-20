<?php

require_once __DIR__ . '/../Models/Usuario.php';
require_once __DIR__ . '/../../config/auth.php';

class AuthController
{
    private Usuario $usuario;

    public function __construct()
    {
        $this->usuario = new Usuario();
    }

    public function login(): void
    {
        Auth::iniciarSessao();

        if (Auth::autenticado()) {
            header('Location: /ubs-estoque/public/');
            exit;
        }

        $erro = $_SESSION['erro_login'] ?? null;
        unset($_SESSION['erro_login']);

        require_once __DIR__ . '/../Views/auth/login.php';
    }

    public function autenticar(): void
    {
        Auth::iniciarSessao();

        $email = trim($_POST['email'] ?? '');
        $senha = $_POST['senha'] ?? '';

        if ($email === '' || $senha === '') {
            $_SESSION['erro_login'] = 'Informe o e-mail e a senha.';
            header('Location: /ubs-estoque/public/login');
            exit;
        }

        $usuario = $this->usuario->buscarPorEmail($email);

        if ($usuario === null || !password_verify($senha, $usuario['senha'])) {
            $_SESSION['erro_login'] = 'E-mail ou senha inválidos.';
            header('Location: /ubs-estoque/public/login');
            exit;
        }

        Auth::login($usuario);

        header('Location: /ubs-estoque/public/');
        exit;
    }

    public function logout(): void
    {
        Auth::logout();

        header('Location: /ubs-estoque/public/login');
        exit;
    }
}
