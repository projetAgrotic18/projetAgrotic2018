<?php session_start() ?>
<html>
	<head>
	<META charset="UTF-8">
	</head>
	
	<body>
	
	<h1>Validation d'une modification de maladie(s) associée à un diagnostic </h1>
	Votre modification a bien été prise en compte
	<?php
	require "../general/connexionPostgreSQL.class.php";
	$connex = new connexionPostgreSQL();
	
	$id_diagnostic=38;

	//SUPPRESION MALADIES ANCIENNEMENT COCHEES :
	$result= $connex->requete("DELETE from maladie_diag WHERE id_diagnostic='".$id_diagnostic."'");
	
	
	//INSERTION NOUVELLE(S) MALADIE(S) :
	//maladies : $_GET["maladies"]
	//MISE A JOUR CHAMP BOULEEN confirme_maladie (passage de 0 à 1) :
	$maladies=$_GET["maladies"];
	$id_diagnostic=$_SESSION[
	for ($i=0; $i<count($maladies); $i++){
		$result= $connex->requete("INSERT INTO maladie_diag (id_maladie, id_diagnostic, confirme_maladie) VALUES ('".$maladies[$i]."','".$id_diagnostic."', '1')");
	}
	
	?>
	
	<a href = "consultation_diagnostic.php">
	<button type="button">Visualiser le diagnostic à nouveau</button>
	</a>
	
	</body>
</html>
