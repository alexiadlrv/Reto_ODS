<?php
    require "api.php";

    $contenedores = [];
    $errorFormulario = "";

    if(isset($_GET["enviar"])){
        if (isset($_GET["id"])){
            if(isset($_GET["ubicacion"])){
                if(isset($_GET["tipo"])){
                    if(isset($_GET["estado"])){
                        $id = trim(strip_tags($_GET["id"]));
                        $ubicacion = trim(strip_tags($_GET["ubicacion"]));
                        $tipo = $_GET["tipo"];
                        $estado = $_GET["estado"];

                        $correcto = true;
                        $patron = '/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ\s,\.-\/]+$/';

                        if($id !== ""){
                            if(!ctype_digit($id)){
                                $errorFormulario .= "Error: El id del contenedor solo debe contener números enteros. <br>";
                                $correcto = false;
                            }else if(intval($id) < 0){
                                $errorFormulario .= "Error: El id del contenedor no puede ser menor a 0. <br>";
                                $correcto = false;
                            }
                        }

                        if($ubicacion !== ""){
                            if(!preg_match($patron, $ubicacion)){
                                $errorFormulario .= "Error: La ubicacion contiene caracteres no permitidos. <br>";
                                $correcto = false;
                            }
                        }

                        if($correcto){
                            $parametros = [];
                            if($id !== ""){
                                $parametros["id"] = $id;
                            }

                            if($ubicacion !== ""){
                                $parametros["ubicacion"] = $ubicacion;
                            }

                            $parametros["tipo"] = $tipo;

                            $parametros["estado"] = $estado;

                            $urlConsulta = API_URL;
                            if(!empty($parametros)){
                                $urlConsulta .= "?" . http_build_query($parametros);
                            }

                            $contenedores = llamarApi("GET", $urlConsulta);

                        }
                    }
                }
            }
        }
    }else{
        $contenedores = llamarApi("GET" , API_URL);
    }

    function seleccionar($campo, $valor) {
        if(isset($_GET[$campo])){
            if($_GET[$campo] === $valor){
                return "selected";
            }
        }else{
            return "";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contenedores</title>
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
                        <li><a href="editar-contenedor.php">Editar contenedor</a></li>
                    </ul>
                </li>
                <li><a href="contacto.php">Formulario</a></li>
             </ul>
        </nav>

    </header>

    <div class="contenedor-banner">
        <div class="contenido-banner">
            <div class="titulo-pequeño">
                <div class="punto"></div>
                <p>TECNOLOGIA loT</p>
            </div>

            <div class="titulo-banner">
                <h1>Contenedores <span>inteligentes</span></h1>
            </div>

            <div class="parrafos-banner">
                <p>Sensores loT que monitorizan el nivel de llenado, optimizan las rutas de rocogida y ayudan a mantener nuestras ciudades más limpias y sostenibles.</p>
            </div>
        </div>

    </div>

    <div class="bloque-añadir">
        <div class="contenedor-titulo">
            <div class="titulo-contenedor">
                <div class="guion"></div>
                <h2>Nuestros contenedores</h2>
            </div>

            <p class = "texto">Cada residuo cuenta. Descubre el estado de nuestros contenedores inteligentes y cómo contribuyen a un gestion más eficiente.</p>
        </div>

        <div class="boton-añadir">
            <a href="#"> + Agregar Contenedor</a>
        </div>
    </div>
    <section id="seccion-buscador" >
    <form action="" method="get" class="form-busqueda">
        <div class="campo">
            <div class="titulo-campo">
                <img src="multimedia/buscador.png" alt="buscador">
                <label for="id">Identificador</label>
            </div>

            <input type="text" name="id" id="id" placeholder="Ej. 1" value = "<?php echo htmlspecialchars($id ?? ""); ?>">
        </div>

        <div class="campo">
            <div class="titulo-campo">
                <img src="multimedia/lugar.png" alt="ubicacion">
                <label for="ubicacion">Ubicacion</label>
            </div>
            <input type="text" id="ubicacion" name="ubicacion" placeholder="Ej. Gran Via, Bilbao" value = "<?php echo htmlspecialchars($ubicacion ?? ""); ?>">
        </div>

        <div class="campo">
            <div class="titulo-campo">
                <img src="multimedia/tipo.png" alt="tipo">
                <label for="tipo">Tipo de Residuo</label>
            </div>

            <select name="tipo" id="tipo">
                <option value="">Todos los Tipos</option>
                <option value="plastico" <?php echo seleccionar("tipo", "plastico"); ?>>Plastico</option>
                <option value="papel" <?php echo seleccionar("tipo", "papel"); ?>>Papel y Carton</option>
                <option value="vidrio" <?php echo seleccionar("tipo", "vidrio"); ?>>Vidrio</option>
                <option value="organico" <?php echo seleccionar("tipo", "organico"); ?>>Organico</option>
            </select>
        </div>

        <div class="campo">
            <div class="titulo-campo">
                <img src="multimedia/estado.png" alt="estado">
                <label for="estado">Estado</label>
            </div>

            <select name="estado" id="estado">
                <option value="">Todos los Tipos</option>
                <option value="operativo" <?php echo seleccionar("estado", "operativo"); ?>>Operativo</option>
                <option value="lleno" <?php echo seleccionar("estado", "lleno"); ?>>Lleno</option>
                <option value="averiado" <?php echo seleccionar("estado", "averiado"); ?>>Fuera de Servicio</option>
            </select>
        </div>

        <button type="submit" name="enviar" id="enviar"> Buscar Contenedor </button>
    </form>
    </section>

    <?php if(!empty($errorFormulario)): ?>
        <div class="error-form">
            <?php echo $errorFormulario; ?>
        </div>
    <?php endif; ?>

    <div class="bloque-contenedores">
        <div class="contenedores">

            <?php if($contenedores === null): ?>
                <p class = "error"> Error no se ha podido conectar con la API de Node.js. </p>
            <?php elseif(empty($contenedores)): ?>
                <p class="error"> No se han encontrado contenedores con esa busqueda. </p>
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
                        <p>Estado:<?php echo ucfirst($c["estado"]); ?></p>
                    </div>

                    <div class="calle">
                        <p><?php echo htmlspecialchars($c["ubicacion"]) ?></p>
                    </div>

                    <div class="nivel">
                        <span>Nivel de llenado:</span>
                        <strong id="porcentaje"><?php echo intval($c["llenado"])?>%</strong>
                    </div>

                    <div class="detalles">
                        <a href="detalle.php?id=<?php echo intval($c['id']); ?>"> Ver detalles</a>
                    </div>
                </div>

                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <div class="bloque-funcion">
        <div class="contenido-funcion">
            <div class="titulo-pequeño-funcion">
                <div class="guion-pequeño"></div>
                <p>CÓMO FUNCIONA</p>
            </div>

            <div class="titulo-funcion">
                <h2>Tecnología que convierte residuos en soluciones</h2>
                <p>Nuestros contenedores inteligentes utilizan sensores loT para <br> monitorizar el nivel de llenado y enviar la información en tiempo real.<br> Así, optimizamos las rutas de recogida y reducimos el impacto ambiental.</p>
            </div>
        </div>

        <div class="bloques">
            <div class="datos">
                <img src="multimedia/WiFi.png" alt="wi-fi">
                <span>Sensores loT</span>
                <p>Los sensores miden el nivel de llenado en tiempo real</p>
            </div>
            <div class="datos">
                <img src="multimedia/nube.png" alt="nube">
                <span>Datos en la nube</span>
                <p>La informacion se procesa y se visualiza en la plataforma</p>
            </div>
            <div class="datos">
                <img src="multimedia/ubi.png" alt="rutas">
                <span>Rutas optimizadas</span>
                <p>Se reducen los recorridos innecesarios y la huella de carbono</p>
            </div>
        </div>
    </div>

    <div class="bloque-beneficios">
        <div class="contenido-beneficios">
            <div class="titulo-beneficios">
                <div class="guion"></div>
                <h2>Beneficios</h2>
            </div>
            <p>Una ciudad más limpia, eficiente y sostenible es posible. Nuestro sistema no solo facilita la gestión de residuos, también genera un impacto positivo en el medio ambiente y en la calidad de vida de todos.</p>
        </div>

        <div class="contenedor-beneficios">

            <div class="beneficios">
                <div class="datos-beneficios">
                    <img src="multimedia/hoja.png" alt="hoja">
                    <span>Menos emisiones</span>
                    <p>Al optimizar las rutas de recogida se reducen los desplazamientos de los camiones y las emisiones de CO2.</p>
                </div>

                <div class="datos-beneficios">
                    <img src="multimedia/hucha.png" alt="hucha">
                    <span>Mayor eficiencia</span>
                    <p>Los recursos se usan mejor, reduciendo costes y mejorando la planificación del servicio.</p>
                </div>

                <div class="datos-beneficios">
                    <img src="multimedia/ciudades.png" alt="ciudad">
                    <span>Ciudades más limpias</span>
                    <p>Contenedores siempre controlados, menos desbordamientos y un entomo más saludable para todos.</p>
                </div>

                <div class="datos-beneficios">
                    <img src="multimedia/planeta.png" alt="planeta">
                    <span>Compromiso con la ODS</span>
                    <p>Contribuimos al ODS 11 (ciudades y comunidades sostenibles) y al ODS 12 (producción y consumo responsables).</p>
                </div>
            </div>

            <div class="imagen-grande">
                <img src="multimedia/imagen-grande.png" alt="">
            </div>
        </div>
    </div>

    <!-- NUEVO CONTENEDOR -->
    <form action="procesar-alta-contenedor.php" method="post" id="nuevo-contenedor-agregar">
        <div class="contenedor-titulo-agregar">
            <div class="logo-titulo-agregar">
                <img src="multimedia/imgBuscador.png" alt="agregar">
            </div>
            <div class="titulo-agregar">
                <h1>Nuevo Contenedor</h1>
                <span>Registra un nuevo contenedor inteligente en el sistema.</span>
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
                    <input type="text" name="nombre" id="nombre" required minlength="3" maxlength="50">
                </div>

                <div class="orden-form-agregar">
                    <label for="tipo">Tipo de residuo</label>
                    <select name="tipo" id="tipo" required>
                        <option value="organico">Orgánico</option>
                        <option value="papel">Papel y Cartón</option>
                        <option value="vidrio">Vidrio</option>
                        <option value="plastico">Plástico</option>
                        <option value="metal">Metal</option>
                        <option value="resto">Resto</option>
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
                    <input type="text" name="ubicacion" id="ubicacion" required minlength="3" maxlength="100">
                </div>

                <div class="orden-form-agregar">
                    <label for="fechaInstalacion">Fecha de Instalación</label>
                    <input type="date" name="fechaInstalacion" id="fechaInstalacion" required>
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
                    <input type="color" name="color" id="color" value="#2e7d32" required>
                </div>
            </div>
        </div>

        <div class="boton-form-nuevo">
            <input type="submit" name="enviar" id="enviar" value="Agregar">
        </div>
    </form>

    <!-- JS para que el formulario de alta no muestre JSON crudo al enviar -->
    <script>
    document.getElementById('nuevo-contenedor-agregar').addEventListener('submit', function (e) {
        e.preventDefault();
        const form = this;
        fetch(form.action, { method: 'POST', body: new FormData(form) })
            .then(function (r) { return r.json(); })
            .then(function (data) {
                if (data.ok) {
                    alert('Contenedor creado correctamente.');
                    location.reload();
                } else {
                    alert('Errores:\n' + data.errores.join('\n'));
                }
            })
            .catch(function () {
                alert('No se pudo conectar con el servidor.');
            });
    });
    </script>

    <footer id="contacto" class="footer">
         <p>EcoContenedores - Reto Digitalizamos los ODS</p>
        <p>Contacto: contacto@ecocontenedores.com</p>
    </footer>
</body>
</html>