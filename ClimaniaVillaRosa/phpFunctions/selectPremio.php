<?php
    require "../controladorJson/leerJsonPremios.php";
<<<<<<< HEAD
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
=======

    function seleccionarPremio(&$premios) {
        // Validar si el array de premios está vacío
        if (empty($premios['premios'])) {
            return '';
        }
    
        $probabilidades_ajustadas = [];
    
        // Ajustar probabilidades y eliminar premios con 0 cantidad
        foreach ($premios['premios'] as $key => $premio) {
            if ($premio['cantidad'] > 0 && $premio['probabilidad'] > 0) {
                $probabilidades_ajustadas[] = [
                    'key' => $key,
                    'premio' => $premio['premio'],
                    'cantidad' => $premio['cantidad'],
                    'probabilidad' => $premio['probabilidad']
                ];
            }
        }
    
        // Si no hay premios válidos, devolver nada
        if (empty($probabilidades_ajustadas)) {
            return '';
        }
    
        // Generar un número aleatorio entre 1 y 100
        $numero_aleatorio = rand(1, 100);
    
        // Determinar el premio según el número aleatorio
        $limite = 0;
        foreach ($probabilidades_ajustadas as $item) {
            $limite += $item['probabilidad'];
            if ($numero_aleatorio <= $limite) {
                // Premio seleccionado, reducir cantidad
                $premios['premios'][$item['key']]['cantidad'] -= 1;
                return "Felicidades! Ganaste el siguiente obsequio: $item[premio]";
            }
        }
    
        // Si no se seleccionó ningún premio:
        return "Lo sentimos! Mejor suerte para la próxima!";
    }

    $msg = seleccionarPremio($premios);

    $json_data = json_encode($premios, true);
    file_put_contents("../json/premios.json", $json_data);
>>>>>>> temp-local
?>