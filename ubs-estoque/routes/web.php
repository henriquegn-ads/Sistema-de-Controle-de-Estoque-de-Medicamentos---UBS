<?php

require_once __DIR__ . '/../config/auth.php';
require_once __DIR__ . '/../app/Controllers/AuthController.php';
require_once __DIR__ . '/../app/Controllers/DashboardController.php';
require_once __DIR__ . '/../app/Controllers/MedicamentoController.php';
require_once __DIR__ . '/../app/Controllers/UsuarioController.php';

Auth::iniciarSessao();

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$basePath = '/ubs-estoque/public';

if (strpos($uri, $basePath) === 0) {
    $uri = substr($uri, strlen($basePath));
}

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

if ($uri === '/usuarios/create' && $method === 'GET') {
    (new UsuarioController())->create();
    exit;
}

if ($uri === '/usuarios/store' && $method === 'POST') {
    (new UsuarioController())->store();
    exit;
}

http_response_code(404);
echo 'Página não encontrada.';
