<?php

require_once __DIR__ . '/../config/auth.php';
require_once __DIR__ . '/../app/Controllers/AuthController.php';
require_once __DIR__ . '/../app/Controllers/DashboardController.php';
require_once __DIR__ . '/../app/Controllers/MedicamentoController.php';
require_once __DIR__ . '/../app/Controllers/UsuarioController.php';
require_once __DIR__ . '/../app/Controllers/PerfilController.php';

Auth::iniciarSessao();

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$uri = rtrim($uri, '/');

if ($uri === '') {
    $uri = '/';
}

$method = $_SERVER['REQUEST_METHOD'];

if ($uri === '/login' && $method === 'GET') {
    (new AuthController())->login();
    exit;
}

if ($uri === '/login' && $method === 'POST') {
    (new AuthController())->autenticar();
    exit;
}

if ($uri === '/logout' && $method === 'GET') {
    (new AuthController())->logout();
    exit;
}

if ($uri === '/' && $method === 'GET') {
    Auth::exigirLogin();
    (new DashboardController())->index();
    exit;
}

if ($uri === '/medicamentos' && $method === 'GET') {
    Auth::exigirLogin();
    (new MedicamentoController())->index();
    exit;
}

if ($uri === '/medicamentos/create' && $method === 'GET') {
    Auth::exigirLogin();
    (new MedicamentoController())->create();
    exit;
}

if ($uri === '/medicamentos/store' && $method === 'POST') {
    Auth::exigirLogin();
    (new MedicamentoController())->store();
    exit;
}

if (preg_match('#^/medicamentos/edit/(\d+)$#', $uri, $matches) && $method === 'GET') {
    Auth::exigirLogin();
    (new MedicamentoController())->edit((int) $matches[1]);
    exit;
}

if (preg_match('#^/medicamentos/update/(\d+)$#', $uri, $matches) && $method === 'POST') {
    Auth::exigirLogin();
    (new MedicamentoController())->update((int) $matches[1]);
    exit;
}

if (preg_match('#^/medicamentos/delete/(\d+)$#', $uri, $matches) && $method === 'POST') {
    Auth::exigirLogin();
    (new MedicamentoController())->delete((int) $matches[1]);
    exit;
}

if ($uri === '/usuarios' && $method === 'GET') {
    Auth::exigirLogin();
    (new UsuarioController())->index();
    exit;
}

if ($uri === '/usuarios' && $method === 'GET') {
    Auth::exigirLogin();
    (new UsuarioController())->index();
    exit;
}

if ($uri === '/usuarios/create' && $method === 'GET') {
    Auth::exigirLogin();
    (new UsuarioController())->create();
    exit;
}

if ($uri === '/usuarios/store' && $method === 'POST') {
    Auth::exigirLogin();
    (new UsuarioController())->store();
    exit;
}

if (preg_match('#^/usuarios/edit/(\d+)$#', $uri, $matches) && $method === 'GET') {
    Auth::exigirLogin();
    (new UsuarioController())->edit((int) $matches[1]);
    exit;
}

if (preg_match('#^/usuarios/update/(\d+)$#', $uri, $matches) && $method === 'POST') {
    Auth::exigirLogin();
    (new UsuarioController())->update((int) $matches[1]);
    exit;
}

if (preg_match('#^/usuarios/status/(\d+)$#', $uri, $matches) && $method === 'POST') {
    Auth::exigirLogin();
    (new UsuarioController())->toggleStatus((int) $matches[1]);
    exit;
}

if (preg_match('#^/usuarios/delete/(\d+)$#', $uri, $matches) && $method === 'POST') {
    Auth::exigirLogin();
    (new UsuarioController())->delete((int) $matches[1]);
    exit;
}

if ($uri === '/perfis' && $method === 'GET') {
    Auth::exigirLogin();
    (new PerfilController())->index();
    exit;
}

if ($uri === '/perfis/create' && $method === 'GET') {
    Auth::exigirLogin();
    (new PerfilController())->create();
    exit;
}

if ($uri === '/perfis/store' && $method === 'POST') {
    Auth::exigirLogin();
    (new PerfilController())->store();
    exit;
}

if (preg_match('#^/perfis/edit/(\d+)$#', $uri, $matches) && $method === 'GET') {
    Auth::exigirLogin();
    (new PerfilController())->edit((int) $matches[1]);
    exit;
}

if (preg_match('#^/perfis/update/(\d+)$#', $uri, $matches) && $method === 'POST') {
    Auth::exigirLogin();
    (new PerfilController())->update((int) $matches[1]);
    exit;
}

http_response_code(404);
echo 'Página não encontrada.';