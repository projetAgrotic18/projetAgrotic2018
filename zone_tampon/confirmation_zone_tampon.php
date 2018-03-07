<html
    <head>
        <META charset='UTF-8'>
    </head>
    <body>
        <?php
       
      // Connexion, sÃ©lection de la base de donnÃ©es du projet
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
     //   echo $dept;
    //    echo $zonetamponray;

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
        <INPUT TYPE = "SUBMIT" VALUE = "Consulter la liste des zones tampon">
        </form><BR/>
        <INPUT TYPE = "SUBMIT" ACTION = "carte_Paca.php" VALUE = "Consulter la carte">
    </body>
</html>