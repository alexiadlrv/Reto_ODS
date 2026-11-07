    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link href="CSS/style.css" rel="stylesheet" type="text/css">
        <style>
           body {
                color: #333;
                margin: 0;
                padding: 0;
                background-image: url('./multimedia/fondoformbilb.jpeg');
                background-repeat: no-repeat;
                background-size: cover;          
                background-position: center;    
                background-attachment: fixed;    
                min-height: 100vh;              
            }

            .orden-form {
                display: flex;
                justify-content: center;
                gap: 30px;
                align-items: stretch; 
            }

            .orden-form fieldset {
                flex: 1;           
                background-color: white; 
                padding: 20px;
                margin-bottom: 25px;
                box-sizing: border-box;
                border-radius: 24px;
            }
            
            
            .contenedor {
                margin: 60px 30px;
                padding: 40px;
                box-shadow: 0 4px 20px rgba(0,0,0,0.15);
                background: rgba(255, 255, 255, 0.03); 
                backdrop-filter: blur(3px);    
                border-radius: 24px;
            }

            h1{
                color: #1c8a4e;
                font-size: 28px;
                margin-bottom: 8px;
                text-align:center;
            }

            p.subtitulo{
                color: #555;
                margin-bottom: 30px;
                text-align:center;
                font-weight:bold;
            }

            fieldset{
                border:1px solid #d0d7d3;
                border-radius: 6px;
                padding: 20px;
                margin-bottom: 25px;
                background-color:white;
            }

            .botones{
                display: flex;
                justify-content: center;
                gap: 30px;
                margin-bottom:15px;
                
            }

            legend{
                font-weight: bold;
                color: #1c8a4e;
                font-size:17px;
                
            }

            .contenedorDatos{
                display:flex;
                flex-direction: column;
                gap: 40px;
            }
        
          
            .grupos{
                margin-bottom: 15px;
                padding:10px;
            }
            
            .tipoUrgencia{
                color:#d90429;
                background-color: #ffe3e6;
                padding:2px 6px;
                border-radius:4px;
            }

            .sliderPersonalizado{
                width:100%;
                cursor: pointer;
                accent-color:green;
            }

            label {
                
                margin-bottom: 6px;
                font-weight: bold;
            
            }
        
            input[type="text"], input[type="email"], input[type="date"], input[type="time"], select, textarea {
                width: 100%;
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 4px;
                
            }

            input[type="range"]{
                width: 100%;
                
            }

            textarea {
                height: 50px;
            }

            .grupo-checkbox  label {
                font-weight: normal;
                display: flex;
                align-items: center;
                gap: 8px;
            
            }

            .boton{
                display: inline-block;
                background-color: #1c8a4e;
                color: white;
                padding: 12px 24px;
                border: none;
                border-radius: 6px;
                font-weight: bold;
                cursor: pointer;
                text-decoration: none;
                font-size: 14px;
                transition: background-color 0.3s ease;
            }

            input[type="reset"].boton {
                background-color: #6c757d;
            }

            .resultados {
                padding: 20px;
                background-color: #e9f5ed;
                border-left: 4px solid #1c8a4e;
                border-radius: 4px;
                color:red;
            }

        </style>
    </head>
    <body>
        <header>
            <div id="logo">
            <h2><img src="multimedia/icono.ico" class="logo"><span>Eco</span>Contenedores</h2>
            </div> 

            <nav>
                <ul class="menu">
                    <li><a href="index.html">Inicio</a></li>
                    <li><a href="contenedores.html">Contenedores</a></li>
                    <li><a href="ODS.html">ODS</a></li>   
                    <li><a href="formulalario.html">formulario</a></li>
                </ul>
            </nav>

    
        </header>

        <div class="contenedor">
            <section class="intro">
                <h1>Contacto</h1>
                <p class="subtitulo">¿Tienes dudas, una sugerencia o quieres colaborar con nosotros? Escribenos y te responderemos lo antes posible</p>
            </section>

            <form method="post" action="contacto.php">
                <div class = "orden-form" >

                    <fieldset>
                        <legend>Tus datos</legend>
                        <div class="contenedorDatos">
                                <div class="DatosHijos">
                                    <label for="nombre">Nombre completo</label>
                                    <input type="text" name="nombre" id="nombre" placehoder="Nombre y apellidos">
                                </div>

                                <div class="DatosHijos">   
                                    <label for="email">Email</label>
                                    <input type="text" name="email" id="email" placeholder="nombre@ejemplo.com">
                                </div>
                           
                                <div class="DatosHijos">
                                    <label for="telefono">Telefono</label>
                                    <input type="text" name="telefono" id="nombre" placehoder="000 000 000">
                                </div>

                                <div class="DatosHijos">   
                                    <label for="email">Edad</label>
                                    <input type="text" name="edad" id="edad">
                                </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <legend>Tu consulta</legend>
                        <div class="grupos">
                            <label for="asunto">Asunto</label>
                            <select name="asunto" id="asunto">
                                <option value="elige">-----Elige-----</option>
                                <option value="sugerencia">Sugerencia</option>
                                <option value="incidencia">Incidencia</option>
                                <option value="colaboracion">Colaboracion</option>
                            </select>   
                        </div>
                        

                        <div class="grupos">
                            <label>¿Cómo prefieres que te contactemos?</label>
                            <div class="grupo-radio">
                                <input type="radio" name="medio_contacto" id="email">Email<br>
                                <input type="radio" name="medio_contacto" id="telefono">Teléfono<br>
                            </div>
                        </div>


                        <div class="contenedorDatos">
                            <div class="fecha">
                                <label for="fecha">Fecha preferida</label>
                                <input type="text" name="fecha" id="fecha" placeholder="mm/mm/mmmm">
                            </div>
                            <div class="hora">
                                <label for="Hora">Hora preferida</label>
                                <input type="time" name="hora" id="hora">
                            </div>
                        </div>


                        <div class="grupos">
                            <label>Temas que te interesan</label>
                            <div class="grupo-checkbox">
                                <label><input type="checkbox" name="intereses[]" value="ODS 11">ODS 11 . Ciudades sostenibles</label>
                                <label><input type="checkbox" name="intereses[]" value="ODS 12">ODS 12 . Produccion y consumo responsables</label>
                                <label><input type="checkbox" name="intereses[]" value="ODS 13">ODS 13 . Accion por el clima</label>
                            </div>
                        </div>


                        <div class="grupos">
                            <label for="urgencia">Urgencia:<strong id="resultadoUrgencia" class="tipoUrgencia">Media</strong></label><br>
                            <input type="range" name="urgencia" id="urgencia" min="1" max="3" value="2" class="sliderPersonalizado">
                        </div>
                        <script>
                            const slider = document.getElementById('urgencia');
                        const textoUrgencia = document.getElementById('resultadoUrgencia');

                        const niveles = {
                                '1': 'Baja',
                                '2': 'Media',
                                '3': 'Alta'
                            };

                            slider.addEventListener('input',(e)=>{
                                textoUrgencia.textContent=niveles[e.target.value]
                            });
                        </script>


                        <div class="grupos">
                            <textarea name="mensaje" id="mensaje" placeholder="Cuentanos en que podemos ayudarte"></textarea>
                        </div>


                        <div class="grupos">
                            <label><input type="checkbox" name="privacidad" >Acepto el tratamiento de mis datos</label>
                        </div>

                    </fieldset>
                </div>


                <div class = "botones" >
                    <input type="submit" name="enviar" value="Enviar mensaje" class="boton">
                    <input type="reset" name="borrar" value="borrar"  class="boton">
                </div>
            </form>

            <div class="resultados">
                <?php
                    if (isset($_POST["enviar"])){
                
                                $nombre = isset($_POST["nombre"]) ? trim(strip_tags($_POST["nombre"])) : "";
                                $email = isset($_POST["email"]) ? trim(strip_tags($_POST["email"])) : "";
                                $edad = isset($_POST["edad"]) ? trim(strip_tags($_POST["edad"])) : "";
                                $telefono = isset($_POST["telefono"]) ? trim(strip_tags($_POST["telefono"])) : "";
                                $asunto = isset($_POST["asunto"]) ? $_POST["asunto"] : "";
                                $medio_contacto = isset($_POST["medio_contacto"]) ? $_POST["medio_contacto"] : "";
                                $privacidad = isset($_POST["privacidad"]) ? $_POST["privacidad"] : "";
                                $fecha = isset($_POST["fecha"]) ? trim($_POST["fecha"]) : "";
                                $hora = isset($_POST["hora"]) ? trim($_POST["hora"]) : "";
                                $intereses=isset($_POST["intereses"]) ? $_POST["intereses"] : [];
                                $mensaje=isset($_POST["mensaje"])? trim($_POST["mensaje"]):"";
                                
                                $correcto = true;
                                $patron_email = "/^[a-zA-Z0-9_]+@[a-z]+\.[a-z]+$/";
                                $patron_fecha = "/^\d{4}-\d{2}-\d{2}$/";

                        

                        
                                if($nombre == ""){
                                    echo "Error, el nombre completo no puede estar vacío<br>";
                                    $correcto = false;
                                }else if(ctype_digit($nombre)){
                                    echo "Error, el nombre no debe contener solo números<br>";
                                    $correcto = false;
                                }else if(strlen($nombre) > 60){
                                    echo "Error, cadena muy larga<br>";
                                    $correcto = false;
                                }

                            
                                if($email == ""){
                                    echo "Error, el email no puede estar vacío<br>";
                                    $correcto = false;
                                }else if(!preg_match($patron_email, $email)){
                                    echo "Error, introduce un correo correcto<br>";
                                    $correcto = false;
                                }

                            
                                if ($edad == ""){
                                    echo "Error, la edad no puede estar vacía<br>";
                                    $correcto = false;
                                }else if(!ctype_digit($edad)){
                                    echo "Error, la edad debe ser un número<br>";
                                    $correcto = false;
                                }else if(strlen($edad) > 2){
                                    echo "Error, la edad debe tener un máximo de dos dígitos<br>";
                                    $correcto = false;
                                }

                            
                                if($telefono == ""){
                                    echo "Error, el teléfono no puede estar vacío<br>";
                                    $correcto = false;
                                }else if(!ctype_digit($telefono)){
                                    echo "Error, el teléfono debe contener solo números<br>";
                                    $correcto = false;
                                }else if(strlen($telefono) !== 9){
                                    echo "Error, el teléfono debe contener nueve dígitos<br>";
                                    $correcto = false;
                                }

                            
                                if($asunto == "" || $asunto == "elige"){
                                    echo "Error, debes seleccionar un asunto para tu consulta<br>";
                                    $correcto = false;
                                }

                        
                                if($medio_contacto == ""){
                                    echo "Error, debes seleccionar un medio de contacto preferido.<br>";
                                    $correcto = false;
                                }

                    
                                if($fecha == ""){
                                    echo "Error, debes seleccionar una fecha preferida<br>";
                                    $correcto = false;
                                }else if(!preg_match($patron_fecha, $fecha)){
                                    echo "Error, el formato de la fecha no es válido<br>";
                                    $correcto = false;
                                }else{
                                    $ano = (int) strtok($fecha, "-");
                                    $mes = (int) strtok("-");
                                    $dia = (int) strtok("-");

                                    if($mes < 1 || $mes > 12){
                                        echo "Error, el mes de la fecha no es válido<br>";
                                        $correcto = false;
                                    }else {
                                        switch($mes){
                                            case 4:
                                            case 6:
                                            case 9:
                                            case 11:
                                                $dias_maximos = 30;
                                                break;
                                                
                                            case 2:
                                                $es_bisiesto = ($ano % 4 == 0 && $ano % 100 != 0) || ($ano % 400 == 0);
                                                $dias_maximos = $es_bisiesto ? 29 : 28;
                                                break;

                                            default:
                                                $dias_maximos = 31;
                                                break;
                                        }
                                        
                                        if ($dia < 1 || $dia > $dias_maximos) {
                                            echo "Error, el día introducido no es válido para ese mes o año bisiesto<br>";
                                            $correcto = false;
                                        }
                                    }
                                }


                                if($hora == ""){
                                    echo "Error, debes seleccionar una hora preferida<br>";
                                    $correcto = false;
                                }

                                if(empty($intereses)){
                                    echo"Error,debes seleccionar al menos un tema que te interése<br>";
                                    $correcto=false;
                                }

                                if($privacidad == ""){
                                    echo "Error, debes aceptar el tratamiento de datos personales<br>";
                                    $correcto = false;
                                }

                                if($mensaje == ""){
                                        echo"Error,el campo de mensaje no puede estar vacio<br>";
                                        $correcto=false;
                                }else if(strlen($mensaje)<10){
                                        echo "el mensaje es demasiado corto(minimo 10 caracteres)<br>";
                                        $correcto=false;
                                }else{
                                    $mensajeSeguro=htmlspecialchars($mensaje,ENT_QUOTES,'UTF-8');
                                }

                            

                                if($correcto){
                                    echo "¡Formulario validado con éxito!<br>";
                                    echo "<strong>Nombre:</strong> " . strtolower($nombre) . "<br>";
                                    echo "<strong>Email:</strong> " . $email . "<br>";
                                    echo "<strong>Teléfono:</strong> " . $telefono . "<br>";
                                    echo "<strong>Edad:</strong> " . $edad . "<br>";
                                    echo "<strong>Asunto:</strong> " . $asunto . "<br>";
                                    echo "<strong>Medio de contacto:</strong> " . $medio_contacto . "<br>";
                                    echo "<strong>Fecha preferida:</strong> " . $fecha . "<br>";
                                    echo "<strong>Hora preferida:</strong> " . $hora . "<br>";
                                }
                            }

                ?>

            </div>
        </div>
        
        <footer id="contacto" class="footer">
            <p>EcoContenedores - Reto Digitalizamos los ODS</p>
            <p>Contacto: contacto@ecocontenedores.com</p>
         </footer>
    </body>
    </html>