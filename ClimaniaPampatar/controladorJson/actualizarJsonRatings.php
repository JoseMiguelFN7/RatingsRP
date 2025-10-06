<?php
    $json_data = "";
    date_default_timezone_set('America/Caracas');
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $date = date("d/m/Y");
        $time = date("h:i a");

        $rating = $_POST["rating"];

        $tel = $_POST["telefono"];

        if(file_exists("../json/ratings.json") && isset($rating))
        {
            $json = file_get_contents("../json/ratings.json", "ratings.json");
            $json_data = json_decode($json, true);
    
            $newElement = array(
                "date" => $date,
                "time" => $time,
                "tel" => $tel,
                "rating" => $rating
            );
            
            array_unshift($json_data["ratings"], $newElement);
            $newJson = json_encode($json_data);
            file_put_contents("../json/ratings.json", $newJson);
        } else{
            $ratings = array(
                "ratings" => array(
                    "0" => array(
                        "date" => $date,
                        "time" => $time,
                        "tel" => $tel,
                        "rating" => $rating
                    )
                )
            );
    
            $myJSON = json_encode($ratings);
    
            file_put_contents("../json/ratings.json", $myJSON);
        }

        $mensaje = "¡Muchas gracias por tu opinión!";
        $imagen = "../../assets/icons/check.gif";

        $archivoTelefs = '../json/telefonos.json';
        $telefs = [];
        if(file_exists($archivoTelefs)){
            $jsonTelefs = file_get_contents($archivoTelefs);
            $telefs = json_decode($jsonTelefs, true);
        }

        if(!in_array($tel, $telefs)){
            array_unshift($telefs, $tel);
        }

        file_put_contents($archivoTelefs, json_encode($telefs, true));
    } else{
        $mensaje = "Ocurrio un error inesperado.";
        $imagen = "../../assets/icons/x-icon.png";
    }

?>