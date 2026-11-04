<?php
    require "api.php";
    define("API_URL", "http://localhost:3000/api/contenedores");

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
                                echo "Error: El id del contenedor solo debe contener números enteros. <br>";
                                $correcto = false; 
                            }

                            if(intval($id) < 0){
                                echo "Error: El id del contenedor no puede ser menor a 0. <br>";
                                $correcto = false;
                            }
                        }

                        if($ubicacion !== ""){
                            if(!preg_match($patron, $ubicacion)){
                                echo "Error: La ubicacion contiene caracteres no permitidos. <br>";
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

?>