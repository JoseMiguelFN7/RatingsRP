<?php
    date_default_timezone_set('America/Caracas');
    $fecha = date("d/m/Y");
    $hora = date("h:i a");
    $resultado = array(
        "fecha"=>$fecha,
        "hora"=>$hora
    );
    echo json_encode($resultado);
?>