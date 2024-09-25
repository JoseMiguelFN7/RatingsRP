<?php
    if(file_exists("../json/ratings.json")){
        $json = file_get_contents("../json/ratings.json", "ratings.json");
        $ratings = json_decode($json, true);
    }
?>