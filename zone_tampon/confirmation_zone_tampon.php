<html>
    <head>
        <META charset='UTF-8'>
    </head>
    <body>
        <?php

        $maladie=$_POST['liste_maladie'];
        $commune=$_POST['zt_commune'];
        $zonetamponray = $_POST['zt_type'];
        $dept=$_POST['departement'];
        foreach ($dept as $value) {
            echo $value;
}

 echo $maladie;
if ($zonetamponray==1){
    $zonetamponray='TRUE';
    $rayonzt=$_POST['zt_rayon'];
}

       $date_debut=$_POST['Date_debut'];
       $date_fin=$_POST['Date_fin'];
      
       
      // Connexion, sélection de la base de données du projet
        require "../general/connexionPostgreSQL.class.php";
       $connex = new connexionPostgreSQL();

        ?>
        
        <INPUT TYPE = "SUBMIT" ACTION = "liste_zone_tampon.php" VALUE = "Consulter la liste des zones tampon"><BR/><BR/>
        <INPUT TYPE = "SUBMIT" ACTION = "carte_Paca.php" VALUE = "Consulter la carte">
    </body>
</html>