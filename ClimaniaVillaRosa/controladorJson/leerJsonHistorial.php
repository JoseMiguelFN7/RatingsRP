<?php
    if(file_exists("../json/historial.json")){
        $json = file_get_contents("../json/historial.json", "historial.json");
        $historial = json_decode($json, true);
    }
?>