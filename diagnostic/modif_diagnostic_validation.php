<?php session_start() ?>
<html>
<head>
	<title>Confirmation de saisie d'un diagnostic</title>
    <META charset="UTF-8"/>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

    <!--- Style Sonnaille -->
    <link href="../general/front/style.css" rel="stylesheet">
</head>
<body>
	<!-- Barre de navigation en fonction de l'utilisateur -->
    <?php include('../general/switchbar.php'); ?>
    
    <div class="padding">   
        <h1>Validation de maladie(s) associée(s) à un diagnostic </h1></br>
        <p>Votre validation de maladie(s) a bien été prise en compte.</p>
        <?php
        require "../general/connexionPostgreSQL.class.php";
        $connex = new connexionPostgreSQL();

        $id_diagnostic=$_GET["id_diagnostic"];
        $maladies=$_GET["maladies"];

        //SUPPRESSION

        $result= $connex->requete("DELETE FROM maladie_diag WHERE id_diagnostic = ".$id_diagnostic);

        //INSERTION NOUVELLE(S) MALADIE(S) avec booleen en mode TRUE :
        //maladies : $_GET["maladies"]
        $maladies=$_GET["maladies"];
        for ($i=0; $i<count($maladies); $i++){
            $result= $connex->requete("INSERT INTO maladie_diag (id_maladie, id_diagnostic, confirme) VALUES ('".$maladies[$i]."','".$id_diagnostic."', TRUE)");
        }
		
		//RECUPERATION DEPARTEMENT POUR ENVOI AU GDS 
	  $result= $connex->requete("SELECT id_commune FROM diagnostic WHERE id_diagnostic = ".$id_diagnostic);
	  while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
		$id_commune_diagnostic=$row[0];
	  }
  
	  $result= $connex->requete("SELECT id_dpt FROM commune WHERE id_commune = ".$id_commune_diagnostic);
	  while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
		$id_dpt_diagnostic=$row[0];
	  }
	  
	  //On a bien l'id du département du diagnostic. on va sélectionner les comptes GDS qui ont une commune dans le même département que le diagnostic.
	  //RECUPERATION DES ID COMPTE GDS DU MEME DEPARTEMENT 
	  $result= $connex->requete("SELECT co.id_compte 
          FROM  commune c
          JOIN compte_utilisateur co ON c.id_commune=co.id_commune 
          WHERE co.id_type_utilisateur = 3 AND c.id_dpt=".$id_dpt_diagnostic);
	
	
	// TABLEAU DES COMPTES UTILISATEURS DES GDS
	$id_comptes_GDS=array();
	while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
		for ($j=0 ; $j < pg_num_fields($result) ; $j++){
			$id_comptes_GDS[]=$row[$j];
		}
	}	
	  
	//RECUPERATION DE l'ID NOTIFICATION :
	$result = $connex->requete("SELECT max(id_notification) FROM notification");
	while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
		$id_notification = $row[0];
	}

	$id_notification = $id_notification +1;
	$date = date("Y-m-d");
	
	//RECUPERATION DU OU DES LIBELLES MALADIE :
	$maladies=$_GET["maladies"];
	$libelle_maladie=array();
	for ($i=0; $i<count($maladies); $i++){
		$result= $connex->requete("SELECT libelle_maladie FROM maladie WHERE id_maladie=".$maladies[$i]);
		while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
			$libelle_maladie[]=$row[0];
		}
	}
	//on a les maladies dans $libelle_maladie
	
	//ENVOI AUX MEMBRES DU GDS DU DEPARTEMENT CORRESPONDANT UNE NOTIF :
    for ($i=0; $i<count($id_comptes_GDS); $i++){
        $result= $connex->requete("INSERT INTO notification (id_notification, date_notification, titre_notification, message) 
				VALUES ('".$id_notification."', '".$date."', 'Confirmation de maladie(s) dans votre département', 
				'Un cas de ".$libelle_maladie[0].$libelle_maladie[1].$libelle_maladie[2]." dans votre département a été recensé et validé par un vétérinaire. 
				Vous pouvez le consulter en cliquant sur ce lien.')");
		$result= $connex->requete("INSERT INTO notification_compte (id_notification, id_compte, lu) 
				VALUES ('".$id_notification."', '".$id_comptes_GDS[$i]."', FALSE)");
		$id_notification = $id_notification +1;
    }	  
	  
	//ENVOI A LA FRGDS

        echo "</br>";
        echo "<a href = 'consultation_diagnostic.php?id_diagnostic=$id_diagnostic'><button type='button'>Visualiser le diagnostic à nouveau</button></a></br></br>";
        echo "<a href = 'liste_diagnostic.php'><button type='button'>Retourner à la liste de mes diagnostics</button></a>";
        ?>
    </div>
	<?php include('../general/front/footer.html');?>
	
</body>
</html>
