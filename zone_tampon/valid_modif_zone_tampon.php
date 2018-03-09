<?php session_start(); ?>
<html>
<head>
    <title>Validation de modification d'une zone tampon</title>
    <META charset="UTF-8"/>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

    <!--- Style Sonnaille -->
    <link href="../general/front/style.css" rel="stylesheet">
</head>
<body>
    <!-- Barre de navigation en fonction de l'utilisateur -->
    <?php include('../general/switchbar.php'); ?>
        
    <h1>Validation de modification d'une zone tampon</h1><br/>
    
    <?php
        // Connexion, sélection de la base de données du projet
        require "../general/connexionPostgreSQL.class.php";
        $connex = new connexionPostgreSQL();

        $exploit=$_POST['exploi'];

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
     
        $query3 = $connex->requete("UPDATE zone_tampon SET id_maladie='".$maladie."',rayon_prot='".$rayonztprot."',rayon_surv='".$rayonztsurv."', date_fin='".$date_fin."', id_compte='".$id_compte."' WHERE id_zone_tampon=".$idzt);
        echo "La zone tampon a bien été modifiée";        
    ?>
    <form type="POST" action="liste_zone_tampon.php" >
    <INPUT TYPE = "SUBMIT" VALUE = "Consulter la liste des zones tampon"/>
    </form><BR/>
    <INPUT TYPE = "SUBMIT" ACTION = "carte_Paca.php" VALUE = "Consulter la carte"/>
    <?php include('../general/front/footer.html');?>
</body>
</html>