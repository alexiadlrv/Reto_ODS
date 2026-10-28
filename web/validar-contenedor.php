<?php
// Valida los datos de un contenedor y devuelve un array de errores.
// Si no hay errores, devuelve un array vacío.
function validarContenedor($datos) {
    $errores = [];
    $tiposValidos = ['organico','plastico','vidrio','papel','metal','resto'];
    $estadosValidos = ['operativo','averiado','mantenimiento'];

    if (strlen($datos['nombre']) < 3) $errores[] = 'El nombre debe tener al menos 3 caracteres.';
    if (!in_array($datos['tipo'], $tiposValidos)) $errores[] = 'Tipo de residuo no válido.';
    if (strlen($datos['ubicacion']) < 3) $errores[] = 'La ubicación debe tener al menos 3 caracteres.';
    if ($datos['capacidad'] <= 0) $errores[] = 'La capacidad debe ser mayor que 0.';
    if ($datos['llenado'] < 0 || $datos['llenado'] > 100) $errores[] = 'El llenado debe estar entre 0 y 100.';
    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $datos['fechaInstalacion'])) $errores[] = 'La fecha no es válida.';
    if (!preg_match('/^#[0-9a-fA-F]{6}$/', $datos['color'])) $errores[] = 'El color no es válido.';
    if (!in_array($datos['estado'], $estadosValidos)) $errores[] = 'Estado no válido.';

    return $errores;
}

// Recoge los campos del contenedor desde $_POST
function recogerContenedor() {
    return [
        'nombre' => trim($_POST['nombre'] ?? ''),
        'tipo' => $_POST['tipo'] ?? '',
        'ubicacion' => trim($_POST['ubicacion'] ?? ''),
        'capacidad' => (int)($_POST['capacidad'] ?? 0),
        'llenado' => (int)($_POST['llenado'] ?? 0),
        'fechaInstalacion' => $_POST['fechaInstalacion'] ?? '',
        'color' => $_POST['color'] ?? '',
        'estado' => $_POST['estado'] ?? ''
    ];
}
?>