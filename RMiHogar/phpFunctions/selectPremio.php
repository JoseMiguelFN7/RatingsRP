<?php
    require "../controladorJson/leerJsonPremios.php";
    $ganado;
    $listo = false;
    if(count($premios["premios"])>0){
        do{
            $num=rand(1,100);
            echo "<script>console.log($num)</script>";
            $ceros = 0;
            foreach($premios["premios"] as $index => &$p){
                $premio = &$p["premio"];
                $cantidad = &$p["cantidad"];
                if($cantidad==0){
                    $ceros++;
                    if($ceros==count($premios["premios"])){
                        $listo = true;
                        break;
                    }
                };
                $prob = &$p["probabilidad"];
                if($num<=$prob){
                    if($cantidad!=0){
                        $ganado = $premio;
                        $cantidad--;
                        $listo = true;
                    }
                    break;
                } else{
                    $num -= $prob;
                }
            }
        } while(!$listo);
        
        unset($p);

        $json_data = json_encode($premios, true);
        file_put_contents("../json/premios.json", $json_data);

        if(isset($ganado)){
            $msg = "Felicidades! Ganaste el siguiente premio: $ganado";
        } else{
            $msg = "Lo sentimos! Mejor suerte para la proxima!";
        }
    } else{
        $msg = '';
    }
?>