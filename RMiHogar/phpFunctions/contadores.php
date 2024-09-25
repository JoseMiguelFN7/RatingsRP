<?php
    require "../controladorJson/leerJsonRatings.php";
    date_default_timezone_set('America/Caracas');
    $fechaActual = date("d/m/Y");
    $diario = 0;
    $mensual = 0;
    if(isset($ratings)){
        for($i=0;$i<count($ratings["ratings"]);$i++){
            if($ratings["ratings"][$i]["date"]===$fechaActual){
                $diario++;
                $mensual++;
            } else{
                if(substr($ratings["ratings"][$i]["date"], 3)===substr($fechaActual, 3)){
                    $mensual++;
                }
            }
        }
    }

    $contadores = array(
        "Fecha Actual"=>$fechaActual,
        "Diario"=>$diario,
        "Mensual"=>$mensual
    );
    echo json_encode($contadores);
?>