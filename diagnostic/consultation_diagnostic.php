<?php session_start() ?>
<html>
	<head>
	<META charset="UTF-8">
	</head>
	
	<body>
	<h1>Consultation d'un diagnostic </h1>
	<?php
	require "../general/connexionPostgreSQL.class.php";
	$connex = new connexionPostgreSQL();
	
	//A partir de l'id_diagnostic de la liste des diagnostics, on peut réussir à visualiser la totalité du diagnostic
	$id_diagnostic=38;
	
	echo "<h2>Caractéristiques générales :</h2>";
	
	echo "<U>Nom de l'exploitant</U> :<br/>";	
	//Récupération du nom de l'exploitant à partir de l'id_diagnostic :
	// id de l'éleveur : id_compte de diagnostic
	$result= $connex->requete("SELECT c.nom FROM compte_utilisateur c JOIN diagnostic d ON c.id_compte=d.id_compte WHERE d.id_diagnostic='".$id_diagnostic."'");
	while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
		echo $row[0]."<br/>";
	}
	echo "<br/>";
	
	echo "<U>Nom de l'exploitation</U> :<br/>";	
	//Récupération du nom de l'exploitation à partir de l'id_diagnostic :
	$result= $connex->requete("SELECT c.nom_exploitation FROM compte_utilisateur c JOIN diagnostic d ON c.id_compte=d.id_compte WHERE d.id_diagnostic='".$id_diagnostic."'");
	while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
		echo $row[0]."<br/>";
	}
	echo "<br/>";
	
	echo "<U>Nom du vétérinaire</U> :<br/>";	
	//Récupération du nom du vétérinaire à partir de l'id_diagnostic :
	// id du véto : com_id_compte de diagnostic
	$result= $connex->requete("SELECT c.nom FROM compte_utilisateur c JOIN diagnostic d ON c.id_compte=d.com_id_compte WHERE d.id_diagnostic='".$id_diagnostic."'");
	while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
		echo $row[0]."<br/>";
	}
	echo "<br/>";
	
	//Récupération de la commune à partir de l'id_diagnostic : 
	echo "<U>Commune du diagnostic</U> :<br/>";	
	$result= $connex->requete("SELECT c.nom_commune FROM commune c JOIN diagnostic d ON c.id_commune=d.id_commune WHERE d.id_diagnostic='".$id_diagnostic."'");
	while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
		echo $row[0]."<br/>";
	}
	echo "<br/>";
	
	//Récupération de la date à partir de l'id_diagnostic : 
	echo  "<U>Date du diagnostic</U> :<br/>";	
	$result= $connex->requete("SELECT date_diagnostic FROM diagnostic WHERE id_diagnostic='".$id_diagnostic."'");
	while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
		echo $row[0]."<br/>";
	}
	echo "<br/>";
	
	//Récupération de l'espèce à partir de l'id_diagnostic : 
	echo "<h2>Caractéristiques du diagnostic :</h2>";
	echo  "<U>Espèce</U> :<br/>";	
	$result= $connex->requete("SELECT e.libelle_espece FROM espece e JOIN diagnostic d ON e.id_espece=d.id_espece WHERE d.id_diagnostic='".$id_diagnostic."'");
	while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
		echo $row[0]."<br/>";
	}
	echo "<br/>";
	
	//Récupération des symptomes à partir de l'id_diagnostic : 
	echo "<U>Symptomes</U> :<br/>";		
	$result= $connex->requete("SELECT s.libelle_symptome FROM symp s JOIN symptdiag sd ON s.id_sympt=sd.id_sympt WHERE sd.id_diagnostic='".$id_diagnostic."'");
	while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
		echo $row[0]."<br/>";
	}
	echo "<br/>";
		
	//Récupération des maladies à partir de l'id_diagnostic : 
	echo "<U>Maladies possibles</U> :<br/>";
	$result= $connex->requete("SELECT m.libelle_maladie FROM maladie m JOIN maladie_diag md ON m.id_maladie=md.id_maladie WHERE md.id_diagnostic='".$id_diagnostic."'");
	while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
		echo $row[0]."<br/>";
	}
	echo "<br/>";
	?>
	<form method="GET" action="modif_diagnostic.php" name="formsaisie">
	<input type="submit" value="Modifier/Ajouter">
	</form>
	<?php
	
	//Récupération des prélèvements à partir de l'id_diagnostic : 
	echo "<U>Prélèvements</U> :<br/>";	
	$result= $connex->requete("SELECT p.libelle_prelevement FROM prelev p JOIN prelevement_diag pd ON p.id_prele=pd.id_prele WHERE pd.id_diagnostic='".$id_diagnostic."'");
	while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
		echo $row[0]."<br/>";
	}
	echo "<br/>";
	
	//Récupération des analyses à partir de l'id_diagnostic : 
	echo "<U>Analyses</U> :<br/>";	
	$result= $connex->requete('SELECT a.libelle_analyse FROM "ANALYSE" a JOIN analyses_diag ad ON a.id_analyse=ad.id_analyse WHERE ad.id_diagnostic='.$id_diagnostic.'');
	while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
		echo $row[0]."<br/>";
	}
	echo "<br/>";
	
	//Récupération des préconisations à partir de l'id_diagnostic : 
	echo "<U>Préconisations</U> :<br/>";	
	$result= $connex->requete('SELECT preconisation FROM diagnostic WHERE id_diagnostic='.$id_diagnostic.'');
	while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
		echo $row[0]."<br/>";
	}
	echo "<br/>";	
	?>
	</body>
</html>
