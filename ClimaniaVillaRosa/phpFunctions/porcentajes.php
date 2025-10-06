<?php
    header("Content-Type: application/json");
    require "../controladorJson/leerJsonRatings.php";
    require "../controladorJson/leerJsonHistorial.php";
    $b = 0;
    $r = 0;
    $m = 0;
    $totales = 0;
    $result = "";
    if(isset($ratings)){
        $totales += count($ratings["ratings"]);
        for($i=0;$i<count($ratings["ratings"]);$i++){
            switch($ratings["ratings"][$i]["rating"]){
                case "Buena":
                    $b++;
                    break;
                case "Regular":
                    $r++;
                    break;
                case "Deficiente":
                    $m++;
                    break;
            }
        }

        if(isset($historial)){
            for($i=0;$i<count($historial["ratings"]);$i++){
                $b += $historial["ratings"][$i]["Buena"];
                $totales += $historial["ratings"][$i]["Buena"];
    
                $r += $historial["ratings"][$i]["Regular"];
                $totales += $historial["ratings"][$i]["Regular"];
    
                $m += $historial["ratings"][$i]["Deficiente"];
                $totales += $historial["ratings"][$i]["Deficiente"];
            }
        }
    }

    $result = array(
        "buenas"=>$b,
        "regulares"=>$r,
        "malas"=>$m,
        "totales"=>$totales
    );
    echo json_encode($result);
?>