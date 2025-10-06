<?php
    $premio = $_POST['premio'];

    $json_data;

    if(file_exists("../json/premios.json")){
        $json = file_get_contents("../json/premios.json", "premios.json");
        $json_data = json_decode($json, true);

        foreach($json_data['premios'] as $index => $p){
            if($p['premio']===$premio){
                array_splice($json_data['premios'], $index, 1);
                break;
            }
        }
    }else{
        echo "No hay premios guardados.";
    }

    if(isset($json_data)){
        $myJSON = json_encode($json_data, true);
    
        file_put_contents("../json/premios.json", $myJSON);
        echo "Eliminado con exito";
    } else{
        echo "Ocurrio un error";
    }
?>