<?php
require 'api.php';
require 'validar-contenedor.php';

header('Content-Type: application/json');

// Solo POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['errores' => ['Método no permitido']]);
    exit;
}

// Recoger y validar
$datos = recogerContenedor();
$errores = validarContenedor($datos);

if (!empty($errores)) {
    http_response_code(400);
    echo json_encode(['errores' => $errores]);
    exit;
}

// Llamar a la API
$respuesta = llamarApi('POST', API_CONTENEDORES, $datos);

if ($respuesta === null) {
    http_response_code(502);
    echo json_encode(['errores' => ['No se pudo conectar con la API. ¿Está arrancada?']]);
    exit;
}

if (isset($respuesta['error'])) {
    http_response_code(400);
    echo json_encode(['errores' => [$respuesta['error']]]);
    exit;
}

echo json_encode(['ok' => true, 'contenedor' => $respuesta]);
?>