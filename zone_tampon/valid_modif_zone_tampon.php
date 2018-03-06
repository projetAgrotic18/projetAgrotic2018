<html>
    <head>
        <META charset='UTF-8'>
    </head>
    <body>
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
        $query3 = $connex->requete("UPDATE zone_tampon SET rayon_prot='".$rayonztprot."',rayon_surv='".$rayonztsurv."', date_fin='".$date_fin."', id_dpt='".$id_dpt."', id_compte='".$id_compte."' WHERE id_zone_tampon=".$idzt);
        echo "La zone tampon a bien été modifiée";
            
        ?>
        <form type="POST" action="liste_zone_tampon.php" >
        <INPUT TYPE = "SUBMIT" VALUE = "Consulter la liste des zones tampon">
        </form><BR/>
        <INPUT TYPE = "SUBMIT" ACTION = "carte_Paca.php" VALUE = "Consulter la carte">
    </body>
</html>