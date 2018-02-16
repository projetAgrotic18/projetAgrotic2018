<html>
	<head>
	<META charset="UTF-8">
	</head>
	
	<body>
	<h1>Validation</h1>
	Votre diagnostic a bien été ajouté. <br>
	
	<?php	
	// $espece=$_GET["porygon"];
	
	// require "../general/connexionPostgreSQL.class.php";
	// $connex = new connexionPostgreSQL();	
		
	// $result = $connex->requete("SELECT symp.libelle_symptome FROM symp 
				// JOIN symptdiag ON symptdiag.id_sympt=symp.id_sympt
				// JOIN diagnostic ON symptdiag.id_diagnostic=diagnostic.id_diagnostic 
				// JOIN espece ON diagnostic.id_espece=espece.id_espece 
				// WHERE espece.libelle_espece='.$_espece.'");
	// while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
		// echo $row[0];
	// }	

	
	// if ($espece == 'bovin'){
		// echo "<input type=checkbox name='symptome' value='avortement'>avortement <br/>";
		// echo "<input type=checkbox name='symptome' value='avortement'>chute production laitière <br/>";
		// echo "<input type=checkbox name='symptome' value='avortement'>conjonctivite <br/>";
	// 
	if (isset($_GET["nom_exploitant"] & isset($_GET["nom_exploitation"]) & isset($_GET["numero_exploitation"]) & isset($_GET["commune"]) & isset($_GET["date"]) & isset($_GET["numero"]) & isset($_GET["espece"])){
		
	}
	
	?>
	
	
	</body>
</html>
