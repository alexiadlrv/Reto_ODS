<?php
require 'api.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['errores' => ['Método no permitido']]);
    exit;
}

$errores = [];

// 1. Comprobar que los campos obligatorios llegan en el POST
$camposObligatorios = ['nombre', 'tipo', 'ubicacion', 'fechaInstalacion', 'color'];
foreach ($camposObligatorios as $campo) {
    if (!isset($_POST[$campo])) {
        $errores[] = "El campo $campo no se ha enviado correctamente.";
    }
}

$datos = [
    'nombre' => strip_tags(trim($_POST['nombre'] ?? '')),
    'tipo' => $_POST['tipo'] ?? '',
    'ubicacion' => strip_tags(trim($_POST['ubicacion'] ?? '')),
    'fechaInstalacion' => $_POST['fechaInstalacion'] ?? '',
    'color' => $_POST['color'] ?? ''
];

// 2. Validar
$tiposValidos = ['vidrio', 'plastico', 'organico', 'papel', 'metal', 'resto'];

if (strlen($datos['nombre']) < 3) {
    $errores[] = 'El nombre debe tener al menos 3 caracteres.';
} elseif (strlen($datos['nombre']) > 50) {
    $errores[] = 'El nombre no puede tener más de 50 caracteres.';
}

if (!in_array($datos['tipo'], $tiposValidos)) {
    $errores[] = 'Tipo de residuo no válido.';
}

if (strlen($datos['ubicacion']) < 3) {
    $errores[] = 'La ubicación debe tener al menos 3 caracteres.';
} elseif (strlen($datos['ubicacion']) > 100) {
    $errores[] = 'La ubicación no puede tener más de 100 caracteres.';
}

if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $datos['fechaInstalacion'])) {
    $errores[] = 'La fecha de instalación no es válida.';
}
if (!preg_match('/^#[0-9a-fA-F]{6}$/', $datos['color'])) {
    $errores[] = 'El color no es válido.';
}

if (!empty($errores)) {
    http_response_code(400);
    echo json_encode(['errores' => $errores]);
    exit;
}

// 3. Llenado aleatorio de 1 a 100
$datos['llenado'] = rand(1, 100);

// 4. Estado automatico según llenado y probabilidad
if ($datos['llenado'] > 80) {
    $datos['estado'] = 'lleno';
} elseif (rand(1, 5) === 1) {
    // 1 probabilidad entre 5 de estar fuera de servicio
    $datos['estado'] = 'fuera de servicio';
} else {
    $datos['estado'] = 'operativo';
}

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

echo json_encode(['ok' => true, 'contenedor' => $respuesta]);
?>