<?php
    $json_data = "";
    date_default_timezone_set('America/Caracas');
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $date = date("d/m/Y");
        $time = date("h:i a");
        if(isset($_POST["submitMala_x"])){
            $rating = $_POST["mala"];
        }
    
        if(isset($_POST["submitRegular_x"])){
            $rating = $_POST["regular"];
        }
    
        if(isset($_POST["submitBuena_x"])){
            $rating = $_POST["buena"];
        }

        if(file_exists("../json/ratings.json") && isset($rating))
        {
            $json = file_get_contents("../json/ratings.json", "ratings.json");
            $json_data = json_decode($json, true);
    
            $newElement = array(
                "date" => $date,
                "time" => $time,
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
                        "rating" => $rating
                    )
                )
            );
    
            $myJSON = json_encode($ratings);
    
            file_put_contents("../json/ratings.json", $myJSON);
        }

        $mensaje = "¡Muchas gracias por tu opinión!";
        $imagen = "../../images/check.gif";
    } else{
        $mensaje = "Ocurrio un error inesperado.";
        $imagen = "../../images/x-icon.png";
    }

?>