<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP</title>
</head>
<body>
    <h1>Ma première page PHP</h1>
    
    
    <?php
        $date = "29 janvier 2024";
        $total = 50;
        $rate = 0.2;
        $vat = $total*$rate;
        echo $vat;
        echo $date;
        echo "<br>";
        echo "Le montant de la cmd est de".$total."€";
        // ceci est un comm
        /* 
        ok
        */
        $delivery = true;
        echo $delivery;
        // var_dump() est une fonction de debuggage
        var_dump($total);
        $info = "resultat" .$total."+".$vat." €";
        echo "<pre>";
        echo $info;
        "</pre>";
        class Voiture{
            public $color = "red";
            public $energy = "gas";
            public function start () {
                echo "vrouù vroum ...";
            }
        }
        $twingo = new Voiture();
        $tesla = new Voiture();
        $twingo->start();

        var_dump($twingo);
        $tesla->energy = "electric";
        var_dump($tesla);
    ?>

    <?php
        echo $total*25.3/100;
    ?>

    <?php
        phpinfo();
    ?>

</body>
</html>