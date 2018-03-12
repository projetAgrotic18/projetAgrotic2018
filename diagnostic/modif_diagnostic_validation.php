<?php session_start() ?>
<html>
	<head>
	<META charset="UTF-8">
	</head>
	
	<body>
	
	<h1>Validation de maladie(s) associée à un diagnostic </h1>
	Votre validation de maladie(s) a bien été prise en compte
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
	// On a bien l'id du département du diagnostic. on va sélectionner les comptes GDS qui ont une commune dans le même département que le diagnostic.
	//RECUPERATION DES ID COMPTE GDS DU MEME DEPARTEMENT 
	$result= $connex->requete("SELECT co.id_compte 
					FROM  commune c
					JOIN compte_utilisateur co ON c.id_commune=co.id_commune 
					WHERE co.id_type_utilisateur = 4 AND c.id_dpt=".$id_dpt_diagnostic);
					
	while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
		$id_comptes_GDS=$row[0];
	}
	
	//ENVOI AU GDS CORRESPONDANT D'UNE NOTIF
	
	//ENVOI A LA FRGDS
	
	echo "</br></br>";
	echo "<a href = 'consultation_diagnostic.php?id_diagnostic=$id_diagnostic'><button type='button'>Visualiser le diagnostic à nouveau</button></a></br>";
	echo "<a href = 'liste_diagnostic.php'><button type='button'>Retourner à la liste de mes diagnostics</button></a>";
	?>
	
	
	
	</body>
</html>
