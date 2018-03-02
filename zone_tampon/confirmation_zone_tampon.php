<html>
    <head>
        <META charset='UTF-8'>
    </head>
    <body>
        <?php

        $maladie=$_POST['liste_maladie'];
        $idcommune=$_POST['commune'];
        $zonetamponray = $_POST['zt_type'];
        $dept=$_POST['departement'];
        $date_fin=$_POST['date'];
echo $maladie; 
echo "<br>".$idcommune;
echo "<br>".$zonetamponray;
if ($zonetamponray==1){
    $rayonzt=$_POST['zt_rayon'];
    $query3 = $connex->requete("INSERT INTO zone_tampon(id_zone_tampon,id_maladie,rayon_prot,date_fin) VALUES ('".$maladie."','" . $idcommune . "','" .$rayonzt. "','" . $date_fin . "')");
echo "La zone tampon à bien été crée";
}

       
      
       
      // Connexion, sÃ©lection de la base de donnÃ©es du projet
        require "../general/connexionPostgreSQL.class.php";
       $connex = new connexionPostgreSQL();

        ?>
        
        <INPUT TYPE = "SUBMIT" ACTION = "lis    te_zone_tampon.php" VALUE = "Consulter la liste des zones tampon"><BR/><BR/>
        <INPUT TYPE = "SUBMIT" ACTION = "carte_Paca.php" VALUE = "Consulter la carte">
    </body>
</html>