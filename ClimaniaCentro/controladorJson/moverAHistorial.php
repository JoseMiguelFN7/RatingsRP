<?php
    function determinarMes($m)
    {
        switch($m)
        {
            case "01":
                return "Enero";
            case "02":
                return "Febrero";
            case "03":
                return "Marzo";
            case "04":
                return "Abril";
            case "05":
                return "Mayo";
            case "06":
                return "Junio";
            case "07":
                return "Julio";
            case "08":
                return "Agosto";
            case "09":
                return "Septiembre";
            case "10":
                return "Octubre";
            case "11":
                return "Noviembre";
            case "12":
                return "Diciembre";
        }
    }

    if(file_exists("../json/ratings.json"))
    {
        $ratings = file_get_contents("../json/ratings.json", "ratings.json");
        $ratings_data = json_decode($ratings, true);

        date_default_timezone_set('America/Caracas');
        $currentDate = date("m/Y");

        if(file_exists("../json/historial.json"))
        {
            $historial = file_get_contents("../json/historial.json", "historial.json");
            $historial_data = json_decode($historial, true);
        }
        else
        {
            $historial_data =array(
                "ratings" => array()
            );
        }

        $numElements = count($ratings_data["ratings"]);
        for($i = 0; $i<$numElements; $i++)
        {
            if(!($currentDate===substr($ratings_data["ratings"][$i]["date"], 3)))
            {
                $encontrado = false;
                $fechaItem = determinarMes(substr($ratings_data["ratings"][$i]["date"], 3, 2))."/".substr($ratings_data["ratings"][$i]["date"], 6);
                if(count($historial_data["ratings"])==0)
                {
                    $newElement = array(
                        "date" => $fechaItem,
                        "Buena" => 0,
                        "Regular" => 0,
                        "Deficiente" => 0
                    );
        
                    switch($ratings_data["ratings"][$i]["rating"])
                    {
                        case "Buena":
                            $newElement["Buena"]++;
                            break;
                        case "Regular":
                            $newElement["Regular"]++;
                            break;
                        case "Deficiente":
                            $newElement["Deficiente"]++;
                            break;
                    }

                    array_push($historial_data["ratings"], $newElement);
                    unset($ratings_data["ratings"][$i]);
                    $newElement = "";
                }
                else
                {
                    for($j = 0; $j<count($historial_data["ratings"]); $j++)
                    {
                        if($fechaItem===$historial_data["ratings"][$j]["date"])
                        {
                            switch($ratings_data["ratings"][$i]["rating"])
                            {
                                case "Buena":
                                    $historial_data["ratings"][$j]["Buena"]++;
                                    break;
                                case "Regular":
                                    $historial_data["ratings"][$j]["Regular"]++;
                                    break;
                                case "Deficiente":
                                    $historial_data["ratings"][$j]["Deficiente"]++;
                                    break;
                            }
                            $encontrado = true;
                            break;
                        }
                    }
    
                    if(!$encontrado)
                    {
                        $newElement = array(
                            "date" => $fechaItem,
                            "Buena" => 0,
                            "Regular" => 0,
                            "Deficiente" => 0
                        );
    
                        switch($ratings_data["ratings"][$i]["rating"])
                        {
                            case "Buena":
                                $newElement["Buena"]++;
                                break;
                            case "Regular":
                                $newElement["Regular"]++;
                                break;
                            case "Deficiente":
                                $newElement["Deficiente"]++;
                                break;
                        }
    
                        array_push($historial_data["ratings"], $newElement);
                        $newElement = "";
                    }
                    unset($ratings_data["ratings"][$i]);
                }
            }
        }
        $newRatings = json_encode($ratings_data);
        file_put_contents("../json/ratings.json", $newRatings);
        if(count($historial_data["ratings"])>0)
        {
            $newHistorial = json_encode($historial_data);
            file_put_contents("../json/historial.json", $newHistorial);
        }
    }
?>