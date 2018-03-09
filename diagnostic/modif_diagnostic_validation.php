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
	
	echo "</br></br>";
	echo "<a href = 'consultation_diagnostic.php?id_diagnostic=$id_diagnostic'><button type='button'>Visualiser le diagnostic à nouveau</button></a></br>";
	echo "<a href = 'liste_diagnostic.php'><button type='button'>Retourner à la liste de mes diagnostics</button></a>";
	?>
	
	
	
	</body>
</html>
