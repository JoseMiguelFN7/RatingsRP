<?php
    header('Content-Type: application/json');
    require "../controladorJson/leerJsonRatings.php";
    if(isset($ratings)){
        echo json_encode($ratings, true);
    } else{
        echo "No hay ratings";
    }
?>