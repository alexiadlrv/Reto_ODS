<?php
require 'api.php';

header('Content-Type: application/json');

$lista = llamarApi('GET', API_CONTENEDORES);

if ($lista === null) {
    http_response_code(502);
    echo json_encode(['error' => 'API no disponible']);
    exit;
}

echo json_encode($lista);
?>