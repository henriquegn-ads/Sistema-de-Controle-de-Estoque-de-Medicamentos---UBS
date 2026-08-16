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

if ($uri === '/') {

    $controller = new DashboardController();
    $controller->index();

    exit;
}

if ($uri === '/login') {

    $controller = new AuthController();
    $controller->login();

    exit;
}

if ($uri === '/usuarios') {

    $controller = new UsuarioController();
    $controller->index();

    exit;
}

if ($uri === '/perfis') {

    $controller = new PerfilController();
    $controller->index();

    exit;
}

if ($uri === '/medicamentos') {

    $controller = new MedicamentoController();
    $controller->index();

    exit;
}

if ($uri === '/categorias') {

    $controller = new CategoriaController();
    $controller->index();

    exit;
}

if ($uri === '/fornecedores') {

    $controller = new FornecedorController();
    $controller->index();

    exit;
}

if ($uri === '/entradas') {

    $controller = new EntradaController();
    $controller->index();

    exit;
}

if ($uri === '/saidas') {

    $controller = new SaidaController();
    $controller->index();

    exit;
}

if ($uri === '/relatorios') {

    $controller = new RelatorioController();
    $controller->index();

    exit;
}

if ($uri === '/configuracoes') {

    $controller = new ConfiguracaoController();
    $controller->index();

    exit;
}

http_response_code(404);

echo 'Página não encontrada.';