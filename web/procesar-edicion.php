<?php
require 'api.php';
require 'validar-contenedor.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['errores' => ['Método no permitido']]);
    exit;
}

$id = (int)($_POST['id'] ?? 0);
if ($id <= 0) {
    http_response_code(400);
    echo json_encode(['errores' => ['Falta el id del contenedor']]);
    exit;
}

$datos = recogerContenedor();
$errores = validarContenedor($datos);

if (!empty($errores)) {
    http_response_code(400);
    echo json_encode(['errores' => $errores]);
    exit;
}

$respuesta = llamarApi('PUT', API_CONTENEDORES . '/' . $id, $datos);

if ($respuesta === null) {
    http_response_code(502);
    echo json_encode(['errores' => ['No se pudo conectar con la API.']]);
    exit;
}

if (isset($respuesta['error'])) {
    http_response_code(400);
    echo json_encode(['errores' => [$respuesta['error']]]);
    exit;
}

echo json_encode(['ok' => true, 'contenedor' => $respuesta]);
?>