<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RP</title>
    <?php
        require "../controladorJson/actualizarJsonRatings.php";
        if($mensaje==="¡Gracias por participar!"){
            require "../phpFunctions/selectPremio.php";
        }
    ?>

    <link rel="stylesheet" href="../../styles/success.css">
    <link rel="icon" type="image/x-icon" href="../../assets/tiendas/RPLogo.ico">
</head>
<body>
    <div class="container">
        <p class="mensaje"><?php echo $mensaje ?></p>
        <figure><img class="gif" src="<?php echo $imagen ?>"></figure>
        <p class="premio">
            <?php
                if($mensaje==="¡Gracias por participar!"){
                    echo $msg;
                }
            ?>
        </p>
    </div>
    <script>
        function openIndex(){
            window.location.href="../";
        }
        const myTimeout = setTimeout(openIndex, 4000);
    </script>
</body>
</html>