<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="CSS/style.css" rel="stylesheet" type="text/css">
    <style>
        .contenedor{
            max-width:650px;
            margin:20px auto;
            background:white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            border: 1px solid #dcdcdc;
           
        }

       
       
        h1{
            color: #1c8a4e;
            font-size: 26px;
            margin-bottom: 8px;
        }

        p.subtitulo{
            color: #555;
            margin-bottom: 30px;
        }

        fieldset{
            border:1px solid #d0d7d3;
            border-radius: 6px;
            padding: 20px;
            margin-bottom: 25px;
            background-color: #fafbfc;
        }

        legend{
            font-weight: bold;
            color: #1c8a4e;
            padding: 0 10px;
            
        }

        .contenedorDatos{
            display: flex;
            gap:20px;
            margin-bottom: 15px;
        }
      

        .grupos{
            margin-bottom: 15px;
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


        .resultados {
            margin-top: 30px;
            padding: 20px;
            background-color: #e9f5ed;
            border-left: 4px solid #1c8a4e;
            border-radius: 4px;
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
        <form>
            <fieldset>
                <legend>Tus datos</legend>
                <div class="contenedorDatos">
                    <div>
                        <div class="DatosHijos">
                            <label for="nombre">Nombre completo</label>
                            <input type="text" name="nombre" id="nombre" placehoder="Nombre y apellidos">
                        </div>
                        <div class="DatosHijos">   
                            <label for="email">Email</label>
                            <input type="text" name="email" id="email" placeholder="nombre@ejemplo.com">
                        </div>
                    </div>

                    <div>
                        <div class="DatosHijos">
                            <label for="telefono">Telefono</label>
                            <input type="text" name="telefono" id="nombre" placehoder="000 000 000">
                        </div>
                        <div class="DatosHijos">   
                            <label for="email">Edad</label>
                            <input type="text" name="edad" id="edad">
                        </div>
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
                       <input type="radio" name="email" id="email">Email<br>
                        <input type="radio" name="telefono" id="telefono">Teléfono<br>
                    </div>
                </div>


                <div class="contenedorDatos">
                    <div class="fecha">
                        <label for="fecha">Fecha preferida</label>
                        <input type="date" name="fecha" id="fecha">
                    </div>
                    <div class="hora">
                        <label for="Hora">Hora preferida</label>
                        <input type="time" name="hora" id="hora">
                    </div>
                </div>


                <div class="grupos">
                    <label>Temas que te interesan</label>
                    <div class="grupo-checkbox">
                        <label><input type="checkbox" name="ods11" value="ODS 11">ODS 11 . Ciudades sostenibles</label>
                        <label><input type="checkbox" name="ods12" value="ODS 12">ODS 12 . Produccion y consumo responsables</label>
                        <label><input type="checkbox" name="ods13" value="ODS 13">ODS 13 . Accion por el clima</label>
                    </div>
                </div>


                <div class="grupos">
                    <label for="urgencia">Urgencia:</label><br>
                    <input type="range" name="urgencia" id="urgencia" min="1" max="5" value="3">
                </div>


                <div class="grupos">
                    <textarea name="mensaje" id="mensaje" placeholder="Cuentanos en que podemos ayudarte"></textarea>
                </div>


                <div class="grupos">
                    <label><input type="checkbox" name="privacidad" >Acepto el tratamiento de mis datos</label>
                </div>

            </fieldset>

            <div >
                <input type="submit" name="enviar" value="Enviar mensaje" class="boton">
                <input type="reset" name="borrar" value="borrar"  class="boton">
            </div>
        </form>

        <div class="resultados">
                <?php
                        if(isset($_POST["nombre"])){
                            if(isset($_POST["email"])){
                                if(isset($post["telefono"])){
                                    if(isset($post["edad"])){
                                    $nombre=trim(strip_tags($post["nombre"]));
                                    $email=trim(strip_tags($post["email"]));
                                    $telefono=trim(strip_tags($post["edad"]));


                                    }
                                }
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