<?php

declare(strict_types=1);

// bootstrap y contenedor simple
$container = require __DIR__ . '/../src/bootstrap.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

header('Content-Type: application/json; charset=utf-8');

if ($uri === '/teatros' && $method === 'GET') {
    $container['teatros_controller']->index();
    exit;
}

http_response_code(404);
echo json_encode(['error' => 'Endpoint not found']);
