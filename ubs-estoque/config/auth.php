<?php

class Auth
{
    public static function iniciarSessao(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function autenticado(): bool
    {
        self::iniciarSessao();
        return isset($_SESSION['usuario_id']);
    }

    public static function exigirLogin(): void
    {
        if (!self::autenticado()) {
            header('Location: /ubs-estoque/public/login');
            exit;
        }
    }

    public static function exigirPerfil(array $perfis): void
    {
        self::exigirLogin();

        if (!in_array($_SESSION['perfil_nome'] ?? '', $perfis, true)) {
            http_response_code(403);
            echo 'Acesso negado.';
            exit;
        }
    }

    public static function login(array $usuario): void
    {
        self::iniciarSessao();
        session_regenerate_id(true);

        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['nome'];
        $_SESSION['usuario_email'] = $usuario['email'];
        $_SESSION['perfil_id'] = $usuario['perfil_id'];
        $_SESSION['perfil_nome'] = $usuario['perfil_nome'];
    }

    public static function logout(): void
    {
        self::iniciarSessao();
        $_SESSION = [];

        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
        }

        session_destroy();
    }
}
