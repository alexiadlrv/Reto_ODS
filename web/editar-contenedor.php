<?php

    require 'api.php';

    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    $contenedor = null;
    $error = '';

    if ($id > 0) {
        $contenedor = llamarApi('GET', API_URL . '/' . $id);
        if ($contenedor === null) {
            $error = 'No se pudo conectar con la API. ¿Está arrancada?';
        } elseif (isset($contenedor['error'])) {
            $error = 'No existe ese contenedor.';
            $contenedor = null;
        }
    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Contenedor</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/contenedores.css">
</head>
<body>

    <header>
        <div id="logo">
           <h2><img src="multimedia/icono.ico" class="logo"><span>Eco</span>Contenedores</h2>
        </div>

         <nav>
            <ul class="menu">
                <li><a href="index.php">Inicio</a></li>
                <li>
                    <a href="contenedores.php">Contenedores ▾</a>
                    <ul class="submenu">
                        <li><a href="contenedores.php#nuevo-contenedor-agregar">Añadir contenedor</a></li>
                        <li><a href="editar-lista.php">Editar contenedor</a></li>
                    </ul>
                </li>
                <li><a href="ODS.html">ODS</a></li>
                <li><a href="contacto.php">Formulario</a></li>
             </ul>
        </nav>
    </header>

    <div class="contenedor-banner" style="height: 150px;">
        <div class="contenido-banner">
            <div class="titulo-banner">
                <h1>Editar <span>Contenedor</span></h1>
            </div>
            <div class="parrafos-banner">
                <p>Modifica los datos del contenedor inteligente seleccionado.</p>
            </div>
        </div>
    </div>

    <?php if ($error !== ''): ?>
        <div class="error-form">
            <?php echo htmlspecialchars($error); ?>
        </div>

        <div style="margin: 30px 50px;">
            <a href="contenedores.php" class="boton">Volver al listado</a>
        </div>
    <?php elseif ($contenedor): ?>
        
        <form action="procesar-edicion-contenedor.php" method="post" id="nuevo-contenedor-agregar" class="form-edicion">
            
            <input type="hidden" name="id" value="<?php echo intval($contenedor['id']); ?>">

            <div class="contenedor-titulo-agregar">
                <div class="logo-titulo-agregar">
                    <img src="multimedia/imgBuscador.png" alt="editar">
                </div>
                <div class="titulo-agregar">
                    <h1>Contenedor: <?php echo htmlspecialchars($contenedor['nombre']); ?></h1>
                    <span>ID del sistema: <?php echo intval($contenedor['id']); ?></span>
                </div>
            </div>

            <div class="datos-form-agregar">
                <div class="subtitulo-form-agregar">
                    <img src="multimedia/icono-verde.png" alt="basura">
                    <p>Información General</p>
                </div>

                <div class="contenido-form-agregar">
                    <div class="orden-form-agregar">
                        <label for="nombre">Identificador del Contenedor</label>
                        <input type="text" name="nombre" id="nombre" value="<?php echo htmlspecialchars($contenedor['nombre']); ?>" required minlength="3" maxlength="50">
                    </div>

                    <div class="orden-form-agregar">
                        <label for="tipo">Tipo de residuo</label>
                        <select name="tipo" id="tipo" required>
                            <?php 
                            $tipos = ['organico' => 'Orgánico', 'papel' => 'Papel y Cartón', 'vidrio' => 'Vidrio', 'plastico' => 'Plástico', 'metal' => 'Metal', 'resto' => 'Resto'];
                            foreach ($tipos as $valor => $texto) {
                                $selected = ($contenedor['tipo'] === $valor) ? 'selected' : '';
                                echo "<option value=\"$valor\" $selected>$texto</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="datos-form-agregar">
                <div class="subtitulo-form-agregar">
                    <img src="multimedia/lugar.png" alt="ubi">
                    <p>Ubicación</p>
                </div>

                <div class="contenido-form-agregar">
                    <div class="orden-form-agregar">
                        <label for="ubicacion">Dirección</label>
                        <input type="text" name="ubicacion" id="ubicacion" value="<?php echo htmlspecialchars($contenedor['ubicacion']); ?>" required minlength="3" maxlength="100">
                    </div>

                    <div class="orden-form-agregar">
                        <label for="fechaInstalacion">Fecha de Instalación</label>
                        <input type="date" name="fechaInstalacion" id="fechaInstalacion" value="<?php echo htmlspecialchars($contenedor['fechaInstalacion']); ?>" required>
                    </div>
                </div>
            </div>

            <div class="datos-form-agregar">
                <div class="subtitulo-form-agregar">
                    <img src="multimedia/hoja.png" alt="color">
                    <p>Color identificativo</p>
                </div>

                <div class="contenido-form-agregar">
                    <div class="orden-form-agregar">
                        <label for="color">Color</label>
                        <input type="color" name="color" id="color" value="<?php echo htmlspecialchars($contenedor['color']); ?>" required>
                    </div>
                </div>
            </div>

            <div class="boton-form-nuevo" style="display: flex; gap: 15px;">
                <input type="submit" value="Guardar Cambios">
                <a href="contenedores.php" class="boton" style="padding: 15px 25px; background: #979797; border-radius: 15px; text-decoration: none;">Cancelar</a>
            </div>
        </form>

        <!-- JS para procesar el guardado sin mostrar JSON crudo -->
        <script>
        document.querySelector('.form-edicion').addEventListener('submit', function (e) {
            e.preventDefault();
            const form = this;
            fetch(form.action, { method: 'POST', body: new FormData(form) })
                .then(function (r) { return r.json(); })
                .then(function (data) {
                    if (data.ok) {
                        alert('Contenedor actualizado correctamente.');
                        window.location.href = 'contenedores.php';
                    } else {
                        alert('Errores:\n' + data.errores.join('\n'));
                    }
                })
                .catch(function () {
                    alert('No se pudo conectar con el servidor.');
                });
        });
        </script>

    <?php endif; ?>

    <footer id="contacto" class="footer">
        <p>EcoContenedores - Reto Digitalizamos los ODS</p>
        <p>Contacto: contacto@ecocontenedores.com</p>
    </footer>
</body>
</html>