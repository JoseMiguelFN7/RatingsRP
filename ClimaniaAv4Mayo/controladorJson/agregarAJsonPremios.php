<?php
    $nombre = $_POST['nombre'];
    $cantidad= $_POST['cantidad'];
    $probabilidad= $_POST['probabilidad'];

    $newPremio=array(
        "premio"=>$nombre,
        "cantidad"=>intval($cantidad),
        "probabilidad"=>floatval($probabilidad)
    );

    $json_data;

    if(file_exists("../json/premios.json")){
        $json = file_get_contents("../json/premios.json", "premios.json");
        $json_data = json_decode($json, true);

        array_push($json_data["premios"], $newPremio);
    }else{
        $json_data = array(
            "premios" => $newPremio
        );
    }

    if(isset($json_data)){
        $myJSON = json_encode($json_data, true);
    
        file_put_contents("../json/premios.json", $myJSON);
        echo "Agregado con exito";
    } else{
        echo "Ocurrio un error";
    }
?>