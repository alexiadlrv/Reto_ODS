<?php
require 'api.php';

header('Content-Type: application/json');

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    http_response_code(400);
    echo json_encode(['error' => 'id no válido']);
    exit;
}

$contenedor = llamarApi('GET', API_CONTENEDORES . '/' . $id);

if ($contenedor === null) {
    http_response_code(502);
    echo json_encode(['error' => 'API no disponible']);
    exit;
}
if (isset($contenedor['error'])) {
    http_response_code(404);
    echo json_encode(['error' => 'No existe']);
    exit;
}

echo json_encode($contenedor);
?>