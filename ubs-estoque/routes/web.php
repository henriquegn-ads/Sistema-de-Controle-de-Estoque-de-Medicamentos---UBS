<?php

session_start();

require_once __DIR__ . '/../app/Controllers/DashboardController.php';
require_once __DIR__ . '/../app/Controllers/MedicamentoController.php';

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

if ($uri === '/' && $method === 'GET') {
    $controller = new DashboardController();
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

if (preg_match('#^/medicamentos/edit/(\d+)$#', $uri, $matches) && $method === 'GET') {
    $controller = new MedicamentoController();
    $controller->edit((int) $matches[1]);
    exit;
}

if (preg_match('#^/medicamentos/update/(\d+)$#', $uri, $matches) && $method === 'POST') {
    $controller = new MedicamentoController();
    $controller->update((int) $matches[1]);
    exit;
}

if (preg_match('#^/medicamentos/delete/(\d+)$#', $uri, $matches) && $method === 'POST') {
    $controller = new MedicamentoController();
    $controller->delete((int) $matches[1]);
    exit;
}

http_response_code(404);
echo 'Página não encontrada.';
