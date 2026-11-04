<?php
require 'api.php';

header('Content-Type: application/json');

// Solo acepta POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['errores' => ['Método no permitido']]);
    exit;
}

// 1. Recoger los datos del formulario
$datos = [
    'nombre' => trim($_POST['nombre'] ?? ''),
    'tipo' => $_POST['tipo'] ?? '',
    'ubicacion' => trim($_POST['ubicacion'] ?? ''),
    'fechaInstalacion' => $_POST['fechaInstalacion'] ?? '',
    'color' => $_POST['color'] ?? '',
    'estado' => $_POST['estado'] ?? '',
    'llenado' => $_POST['llenado'] ?? ''
];

// 2. Validar
$errores = [];
$tiposValidos = ['vidrio', 'plastico', 'organico', 'papel', 'metal', 'resto'];
$estadosValidos = ['operativo', 'averiado', 'mantenimiento'];

if (strlen($datos['nombre']) < 3 || strlen($datos['nombre']) > 50) {
    $errores[] = 'El nombre debe tener entre 3 y 50 caracteres.';
}
if (!in_array($datos['tipo'], $tiposValidos)) {
    $errores[] = 'Tipo de residuo no válido.';
}
if (strlen($datos['ubicacion']) < 3 || strlen($datos['ubicacion']) > 100) {
    $errores[] = 'La ubicación debe tener entre 3 y 100 caracteres.';
}
if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $datos['fechaInstalacion'])) {
    $errores[] = 'La fecha de instalación no es válida.';
}
if (!preg_match('/^#[0-9a-fA-F]{6}$/', $datos['color'])) {
    $errores[] = 'El color no es válido.';
}
if (!in_array($datos['estado'], $estadosValidos)) {
    $errores[] = 'Estado no válido.';
}
// El llenado puede ser 0, así que comprobamos que sea numérico y esté en rango
if ($datos['llenado'] === '' || !is_numeric($datos['llenado'])) {
    $errores[] = 'El llenado es obligatorio.';
} else {
    $llenado = (int)$datos['llenado'];
    if ($llenado < 0 || $llenado > 100) {
        $errores[] = 'El llenado debe estar entre 0 y 100.';
    }
}

// 3. Si hay errores, devolverlos
if (!empty($errores)) {
    http_response_code(400);
    echo json_encode(['errores' => $errores]);
    exit;
}

// 4. Preparar los datos para la API (llenado como número)
$datos['llenado'] = (int)$datos['llenado'];

// 5. Llamar a la API
$respuesta = llamarApi('POST', API_URL, $datos);

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

// 6. Todo bien
echo json_encode(['ok' => true, 'contenedor' => $respuesta]);
?>