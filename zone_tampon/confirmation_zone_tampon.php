<?php session_start(); ?>
<html>
<head>
    <title>Confirmation de saisie d'une zone tampon</title>
    <META charset="UTF-8"/>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

    <!--- Style Sonnaille -->
    <link href="../general/front/style.css" rel="stylesheet">
</head>
<body>
    <!-- Barre de navigation en fonction de l'utilisateur -->
    <?php include("../general/switchbar.php"); ?>
        
    <h1>Confirmation de saisie d'une zone tampon</h1><br/>
    
    <?php

        // Connexion, sélection de la base de données du projet
        require "../general/connexionPostgreSQL.class.php";
        $connex = new connexionPostgreSQL();

        $exploit=$_POST['exploi'];
        //echo $exploit;
        $query4 = $connex->requete("SELECT id_compte FROM compte_utilisateur WHERE nom='".$exploit."'");
        while ($row = pg_fetch_array($query4)) 
            {
                $id_compte = $row[0];
            }
        $maladie=$_POST['liste_maladie'];
        $idzt=$_POST['id_zt'];
        $date_fin=$_POST['datefin'];
        $active="TRUE";

        $rayonztprot=$_POST['zt_rayon'];
        $rayonztsurv=$_POST['zt_rayon2'];
        $commune=$_POST['commune'];

        $query5 = $connex->requete("SELECT id_dpt FROM commune WHERE nom_commune='".$commune."'");
        while ($row = pg_fetch_array($query5)) 
            {
                $id_dpt = $row[0];
            }
    
        $query3 = $connex->requete("INSERT INTO zone_tampon(id_maladie,id_compte,id_zone_tampon,rayon_prot,rayon_surv,date_fin,active,id_dpt) VALUES('".$maladie."','".$id_compte."','". $idzt ."','" .$rayonztprot. "','" .$rayonztsurv. "','" . $date_fin . "','".$active."','".$id_dpt."')");
        echo "La zone tampon à bien été crée";
    ?>
    
    <form type="POST" action="liste_zone_tampon.php" >
    <INPUT TYPE = "SUBMIT" VALUE = "Consulter la liste des zones tampon"/>
    </form><BR/>
    <INPUT TYPE = "BUTTON" VALUE = "Consulter la carte" ONCLICK = "self.location.href='../carte/cartepaca.php'"/>
    <?php include('../general/front/footer.html');?>
</body>
</html>