<?php

require_once __DIR__ . '/../app/Controllers/AuthController.php';
require_once __DIR__ . '/../app/Controllers/DashboardController.php';
require_once __DIR__ . '/../app/Controllers/UsuarioController.php';
require_once __DIR__ . '/../app/Controllers/PerfilController.php';
require_once __DIR__ . '/../app/Controllers/MedicamentoController.php';
require_once __DIR__ . '/../app/Controllers/CategoriaController.php';
require_once __DIR__ . '/../app/Controllers/FornecedorController.php';
require_once __DIR__ . '/../app/Controllers/EntradaController.php';
require_once __DIR__ . '/../app/Controllers/SaidaController.php';
require_once __DIR__ . '/../app/Controllers/RelatorioController.php';
require_once __DIR__ . '/../app/Controllers/ConfiguracaoController.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$basePath = '/ubs-estoque';

if (strpos($uri, $basePath) === 0) {
    $uri = substr($uri, strlen($basePath));
}

$uri = rtrim($uri, '/');

if ($uri === '') {
    $uri = '/';
}

$method = $_SERVER['REQUEST_METHOD'];

if ($uri === '/' && $method === 'GET') {

    $controller = new DashboardController();
    $controller->index();

    exit;
}

if ($uri === '/login' && $method === 'GET') {

    $controller = new AuthController();
    $controller->login();

    exit;
}

if ($uri === '/usuarios' && $method === 'GET') {

    $controller = new UsuarioController();
    $controller->index();

    exit;
}

if ($uri === '/perfis' && $method === 'GET') {

    $controller = new PerfilController();
    $controller->index();

    exit;
}

if ($uri === '/medicamentos' && $method === 'GET') {

    $controller = new MedicamentoController();
    $controller->index();

    exit;
}

if ($uri === '/medicamentos/create' && $method === 'GET') {

    $controller = new MedicamentoController();
    $controller->create();

    exit;
}

if ($uri === '/medicamentos/store' && $method === 'POST') {

    $controller = new MedicamentoController();
    $controller->store();

    exit;
}

if ($uri === '/categorias' && $method === 'GET') {

    $controller = new CategoriaController();
    $controller->index();

    exit;
}

if ($uri === '/fornecedores' && $method === 'GET') {

    $controller = new FornecedorController();
    $controller->index();

    exit;
}

if ($uri === '/entradas' && $method === 'GET') {

    $controller = new EntradaController();
    $controller->index();

    exit;
}

if ($uri === '/saidas' && $method === 'GET') {

    $controller = new SaidaController();
    $controller->index();

    exit;
}

if ($uri === '/relatorios' && $method === 'GET') {

    $controller = new RelatorioController();
    $controller->index();

    exit;
}

if ($uri === '/configuracoes' && $method === 'GET') {

    $controller = new ConfiguracaoController();
    $controller->index();

    exit;
}

http_response_code(404);

echo 'Página não encontrada.';