<?php session_start(); ?>
<html>
<head>
    <title>Confirmation de saisie d'une zone tampon</title>
    <META charset="UTF-8"/>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
</head>
<body>
    <!-- Barre de navigation en fonction de l'utilisateur -->
    <?php include("../general/front/navigation.php"); ?>
    
    <h1 class="sonnaille_titre">Confirmation de saisie d'une zone tampon</h1><br/>
    <div class="padding">
        <?php
            // Connexion, sélection de la base de données du projet
            $connex = new connexionPostgreSQL();
            
            // Récupération de l'id du compte de l'exploitant
            $id_compte=$_POST['exploi'];
        
            //Récupération des infos de l'exploitation
                $query4 = $connex->requete("SELECT tr.id_compte, gid, nom_exploitation FROM compte_utilisateur cu JOIN troupeaux2 tr on cu.id_compte=tr.id_compte WHERE tr.id_compte='".$id_compte."'");

                while ($row = pg_fetch_array($query4)) 
                    {
                        $id_compte = $row[0];
                        $gid=$row[1];
                    }
        
            //Récupération des infos du formulaire
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

            //Enregistrement des modifications
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