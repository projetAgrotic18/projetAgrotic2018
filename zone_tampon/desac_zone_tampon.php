<?php session_start(); ?>
<html>
<head>
    <title>Confirmation de supression d'une zone tampon</title>
    <meta charset="UTF-8"/>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
</head>
<body>
    <!-- Barre de navigation en fonction de l'utilisateur -->
    <?php include("../general/front/navigation.php"); ?>
    
    <h1 class="sonnaille_titre">Confirmation de suppression d'une zone tampon</h1><br/>
    <div class="padding">
        <?php
            $idzt=$_GET["id_zone_tampon"];
            echo $idzt;
            $connex = new connexionPostgreSQL();
            $result= $connex->requete("UPDATE zonetampon SET active='FALSE' WHERE id_zone_tampon=".$idzt); 
            //$query7 = $connex->requete("DELETE public.zonetampon where geom=tampon(".$idzt.")");
        ?>
        La zone tampon a bien été désactivée !
       <form method="post" action="liste_zone_tampon.php" >
           <input type="submit" name="retour" Value="Retour à la liste des zones tampons">
       </form>
    </div>
    <?php include('../general/front/footer.html');?>
</body>
</html>
