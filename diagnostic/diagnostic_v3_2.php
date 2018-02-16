<html>
	<head>
	<META charset="UTF-8">
	</head>
	
	<body>
	<h1>Validation</h1>
	Votre diagnostic a bien été ajouté. <br>
	
	<?php	
	$espece=$_GET["porygon"];
	
	require "../general/connexionPostgreSQL.class.php";
	$connex = new connexionPostgreSQL();	
	
	$result=$connex->requete("SELECT*FROM sympt");
	
	// $result = $connex->requete("SELECT sympt.libelle_symptome FROM sympt 
				// JOIN symptdiag ON symptdiag.id_sympt=sympt.id_sympt 
				// JOIN diagnostic ON symptdiag.id_diagnostic=diagnostic.id_diagnostic 
				// JOIN espece ON diagnostic.id_espece=espece.id_espece 
				// WHERE espece.libelle_espece=".$_espece);
	while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
		echo $row[2];
	}		
	
	// if ($espece == 'bovin'){
		// echo "<input type=checkbox name='symptome' value='avortement'>avortement <br/>";
		// echo "<input type=checkbox name='symptome' value='avortement'>chute production laitière <br/>";
		// echo "<input type=checkbox name='symptome' value='avortement'>conjonctivite <br/>";
	?>
	
	
	<FORM action="diagnostic_v3.php">
		<INPUT type = "submit" value="Consulter ce diagnostic">
	</FORM>
	<FORM action="diagnostic_v3.php">
		<INPUT type = "submit" value="Ajouter un autre diagnostic">
	</FORM>
	</body>
</html>
