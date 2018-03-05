<?php session_start() ?>
<html>
	<head>
	<META charset="UTF-8">
	</head>
	
	<body>
	<form method="GET" action="modif_diagnostic_validation.php" name="formsaisie">
	<h1>Modification d'un diagnostic </h1>
	<?php
	require "../general/connexionPostgreSQL.class.php";
	$connex = new connexionPostgreSQL();
	
	//A partir de l'id_diagnostic de la liste des diagnostics, on peut réussir à visualiser la totalité du diagnostic
	$id_diagnostic=38;
	
	//SEULE PARTIE MODIFIABLE : 
	//Récupération des maladies à partir de l'id_diagnostic : 
	echo "<U>Maladies possibles</U> :<br/>";
	$result= $connex->requete("SELECT m.libelle_maladie FROM maladie m JOIN maladie_diag md ON m.id_maladie=md.id_maladie WHERE md.id_diagnostic='".$id_diagnostic."'");
	echo "Vous aviez sélectionné cette (ces) maladie(s) : <br/>";
	while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
		echo $row[0]."<br/>";
	}
	
	//A sélectionner de nouveau :
	echo "<br/>Vous pouvez confirmer la maladie associée au diagnostic, ainsi réitérer votre sélection, ou la modifier : <br/>";
	echo "<br/>(Ce choix sera considéré comme définitifs)<br/>";
	$result = $connex->requete("SELECT id_maladie, libelle_maladie FROM maladie ORDER BY libelle_maladie");
	while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
		echo "<input type=checkbox name='maladie[]' value=".$row[0].">".$row[1]."<br/>";
	}
	echo "<br/>";
	
	?>
	
	<input type="submit" value="Modifier">
	</form>
	
	<a href = "consultation_diagnostic.php">
	<button type="button">Annuler la modification</button>
	</a>
	
	</body>
</html>
