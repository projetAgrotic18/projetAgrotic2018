<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
    <h1>Calcul sur les variables</h1>
    </head>
    <body>
        <?php
        $tva= 0.2;
        $prix= 150;
        $nombre= 10;

        echo "Le montant HT est de ".($prix*$nombre)." et est de type ".gettype($nombre*$prix).".</br>";
        echo "Le montant TTC est de ".(($prix*$nombre)+($prix*$nombre*$tva))." et est de type ".gettype($prix*$nombre*$tva).".</br>";
        
        
        
        ?>
    </body>
</html>
