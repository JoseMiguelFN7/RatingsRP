<?php
    header('Content-Type: application/json');
    require "../controladorJson/leerJsonPremios.php";
    if(isset($premios)){
        echo json_encode($premios, true);
    } else{
        echo "No hay premios";
    }
?>