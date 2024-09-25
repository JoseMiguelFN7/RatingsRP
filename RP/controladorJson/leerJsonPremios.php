<?php
    if(file_exists("../json/premios.json")){
        $json = file_get_contents("../json/premios.json", "premios.json");
        $premios = json_decode($json, true);
    }
?>