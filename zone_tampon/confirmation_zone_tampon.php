<?php session_start(); ?>
<html>
<head>
    <title>Confirmation de saisie d'une zone tampon</title>
    <META charset="UTF-8"/>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
</head>
<body>
    <!-- Barre de navigation en fonction de l'utilisateur -->
    <?php include("../general/switchbar.php"); ?>
    
    <div class="padding">
        <h1>Confirmation de saisie d'une zone tampon</h1><br/>

        <?php

            // Connexion, sélection de la base de données du projet
            require "../general/connexionPostgreSQL.class.php";
            $connex = new connexionPostgreSQL();

            $exploit=$_POST['exploi'];
            $query4 = $connex->requete("SELECT tr.id_compte, gid FROM compte_utilisateur cu JOIN troupeaux2 tr on cu.id_compte=tr.id_compte WHERE nom_exploitation='".$exploit."'");
            while ($row = pg_fetch_array($query4)) 
                {
                    $id_compte = $row[0];
                    $gid=$row[1];
                }
            $maladie=$_POST['liste_maladie'];
            $idzt=$_POST['id_zt'];
            $date_fin=$_POST['datefin'];
            $active="TRUE";

            $rayonztprot=$_POST['zt_rayon']*1000;
            $rayonztsurv=$_POST['zt_rayon2'];
            $commune=pg_escape_string($_POST['commune']);

            $query5 = $connex->requete("SELECT id_dpt FROM commune WHERE nom_commune='".$commune."'");
            while ($row = pg_fetch_array($query5)) 
                {
                    $id_dpt = $row[0];
                }

            $query3 = $connex->requete("INSERT INTO zonetampon(id_maladie,id_compte,id_zone_tampon,rayon_prot,rayon_surv,date_fin,active,id_dpt) VALUES('".$maladie."','".$id_compte."','". $idzt ."','" .$rayonztprot. "','" .$rayonztsurv. "','" . $date_fin . "','".$active."','".$id_dpt."')");
            $query6 = $connex->requete("UPDATE troupeaux2 SET id_compte=$id_compte WHERE gid=$gid");
            $query7 = $connex->requete("UPDATE public.zonetampon SET geom=tampon(id_zone_tampon)");
            echo "<h6>La zone tampon à bien été crée.</h6><BR/>";
        ?>

        <INPUT TYPE = "BUTTON" VALUE = "Retour à la liste des zones tampons" ONCLICK = "self.location.href='liste_zone_tampon.php'"/><BR/><BR/>
        <INPUT TYPE = "BUTTON" VALUE = "Consulter la carte" ONCLICK = "self.location.href='../carte/cartepaca.php'"/><BR/><BR/><BR/>
    </div>
    <?php include('../general/front/footer.html');?>
</body>
</html>