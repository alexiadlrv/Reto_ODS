<?php

    require 'api.php';
    $contenedores = llamarApi('GET', API_URL);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccionar Contenedor para Editar</title>
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
                        <!-- Enlace corregido a esta misma página -->
                        <li><a href="editar-lista.php">Editar contenedor</a></li>
                    </ul>
                </li>
                <li><a href="ODS.html">ODS</a></li>
                <li><a href="contacto.php">Contacto</a></li>
             </ul>
        </nav>
    </header>

    <div class="contenedor-banner" style="height: 150px;">
        <div class="contenido-banner">
            <div class="titulo-banner">
                <h1>Seleccionar <span>Contenedor</span></h1>
            </div>
            <div class="parrafos-banner">
                <p>Elige el contenedor que deseas modificar de la lista inferior.</p>
            </div>
        </div>
    </div>

    <div class="bloque-contenedores" style="margin-top: 30px;">
        <div class="contenedores">

            <?php if($contenedores === null): ?>
                <p class="error">Error: no se ha podido conectar con la API de Node.js.</p>
            <?php elseif(empty($contenedores)): ?>
                <p class="error">No hay contenedores registrados en el sistema.</p>
            <?php else: ?>

                <?php foreach ($contenedores as $c):
                    $tipoResiduo = strtolower($c["tipo"] ?? "general");

                    if(strpos($tipoResiduo, "plastico") !== false ){
                        $imgContenedor = "multimedia/contenedor-amarillo.png";
                        $imgIcono = "multimedia/icono-amarillo.png";
                        $nombreTipo = "Plastico";
                    }else if (strpos($tipoResiduo, "papel") !== false){
                        $imgContenedor = "multimedia/contenedor-azul.png";
                        $imgIcono = "multimedia/icono-azul.png";
                        $nombreTipo = "Papel y Carton";
                    }else if (strpos($tipoResiduo, "vidrio") !== false){
                        $imgContenedor = "multimedia/contenedor-verde.png";
                        $imgIcono = "multimedia/icono-verde.png";
                        $nombreTipo = "Vidrio";
                    }else{
                        $imgContenedor = "multimedia/contenedor-marron.png";
                        $imgIcono = "multimedia/icono-marron.png";
                        $nombreTipo = ucfirst($tipoResiduo);
                    }
                ?>

                <div class="contenido-contenedores">
                    <div class="imagen-contenedores">
                        <img src="<?php echo htmlspecialchars($imgContenedor)?>" alt="<?php echo htmlspecialchars($nombreTipo) ?>">
                    </div>

                    <div class="titulo-contenedores">
                        <img src="<?php echo htmlspecialchars($imgIcono)?>" alt="<?php echo htmlspecialchars($tipoResiduo) ?>">
                        <p><?php echo htmlspecialchars($nombreTipo); ?></p>
                    </div>

                    <div class="sensor">
                        <div class="punto"></div>
                        <p>Sensor conectado</p>
                    </div>

                    <div class="estado">
                        <p>Estado: <?php echo ucfirst($c["estado"]); ?></p>
                    </div>

                    <div class="calle">
                        <p><?php echo htmlspecialchars($c["ubicacion"]) ?></p>
                    </div>

                    <div class="nivel">
                        <span>Nivel de llenado:</span>
                        <strong id="porcentaje"><?php echo intval($c["llenado"])?>%</strong>
                    </div>

                    <!-- Boton que lleva a la pagina de editar con el ID correcto -->
                    <div class="detalles">
                        <a href="editar-contenedor.php?id=<?php echo intval($c['id']); ?>">Editar este contenedor</a>
                    </div>
                </div>

                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <footer id="contacto" class="footer">
         <p>EcoContenedores - Reto Digitalizamos los ODS</p>
        <p>Contacto: contacto@ecocontenedores.com</p>
    </footer>
</body>
</html>