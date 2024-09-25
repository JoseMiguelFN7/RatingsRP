<?php
    header('Content-Type: application/json');
    require "../controladorJson/moverAHistorial.php";
    require "../controladorJson/leerJsonRatings.php";
    require "../controladorJson/leerJsonHistorial.php";

    if(isset($historial)){
        echo json_encode($historial, true);
    } else{
        echo "No hay historial";
    }
?>