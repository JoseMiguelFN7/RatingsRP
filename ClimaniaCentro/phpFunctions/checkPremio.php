<?php
    require "../controladorJson/leerJsonPremios.php";

    function hayPremio($premios) {
        // Validar si el array de premios está vacío
        if (empty($premios['premios'])) {
            return false;
        }

        // chequear si hay al menos 1 premio con cantidad y probabilidad mayor que cero
        foreach ($premios['premios'] as $premio) {
            if ($premio['cantidad'] > 0 && $premio['probabilidad'] > 0) {
                return true;
            }
        }
    
        // Si no hay premios válidos, devolver falso
        return false;
    }

    echo hayPremio($premios);
?>