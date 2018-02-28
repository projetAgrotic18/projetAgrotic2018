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
	$id_diagnostic=19;
	
	echo "<h2>Caractéristiques générales :</h2>";
	
	echo "Nom de l'exploitant : <br/>";
	//Récupération du nom de l'exploitant à partir de l'id_diagnostic :
	// id de l'éleveur : id_compte de diagnostic
		$result= $connex->requete("SELECT c.nom FROM compte_utilisateur c JOIN diagnostic d ON c.id_compte=d.id_compte WHERE d.id_diagnostic='".$id_diagnostic."'");
		while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
			echo $row[0]."<br/><br/>";
		}
	echo "Nom du vétérinaire : <br/>";
	//Récupération du nom du vétérinaire à partir de l'id_diagnostic :
	// id du véto : com_id_compte de diagnostic
		$result= $connex->requete("SELECT c.nom FROM compte_utilisateur c JOIN diagnostic d ON c.id_compte=d.com_id_compte WHERE d.id_diagnostic='".$id_diagnostic."'");
		while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
			echo $row[0]."<br/><br/>";
		}	
	echo "Commune du diagnostic : <br/>";
		$result= $connex->requete("SELECT c.nom_commune FROM commune c JOIN diagnostic d ON c.id_commune=d.id_commune WHERE d.id_diagnostic='".$id_diagnostic."'");
		while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
			echo $row[0]."<br/><br/>";
		}
	echo  "Date du diagnostic : <br/>";
		$result= $connex->requete("SELECT date_diagnostic FROM diagnostic WHERE id_diagnostic='".$id_diagnostic."'");
		while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
			echo $row[0]."<br/><br/>";
		}
	echo "<h2>Caractéristiques du diagnostic :</h2>";
	echo  "Espèce : <br/>";
		$result= $connex->requete("SELECT e.libelle_espece FROM espece e JOIN diagnostic d ON e.id_espece=d.id_espece WHERE d.id_diagnostic='".$id_diagnostic."'");
		while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
			echo $row[0]."<br/><br/>";
		}
	echo "Symptomes : <br/>";	
		$result= $connex->requete("SELECT s.libelle_symptome FROM symp s JOIN symptdiag sd ON s.id_sympt=sd.id_sympt WHERE sd.id_diagnostic='".$id_diagnostic."'");
		while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
			echo $row[0]."<br/><br/>";
		}
	echo "Maladies soupçonnées : <br/>";	
		$result= $connex->requete("SELECT m.libelle_maladie FROM maladie m JOIN maladie_diag md ON m.id_maladie=md.id_maladie WHERE md.id_diagnostic='".$id_diagnostic."'");
		while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
			echo $row[0]."<br/><br/>";
		}
	echo "Prélèvements : <br/>";	
		$result= $connex->requete("SELECT p.libelle_prelevement FROM prelev p JOIN prelevement_diag pd ON p.id_prele=pd.id_prele WHERE pd.id_diagnostic='".$id_diagnostic."'");
		while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
			echo $row[0]."<br/><br/>";
		}
	echo "Analyses : <br/>";	
		$result= $connex->requete('SELECT a.libelle_analyse FROM "ANALYSE" a JOIN analyses_diag ad ON a.id_analyse=ad.id_analyse WHERE ad.id_diagnostic='.$id_diagnostic.'');
		while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
			echo $row[0]."<br/><br/>";
		}
	echo "Préconisations : <br/>";	
		$result= $connex->requete('SELECT preconisation FROM diagnostic WHERE id_diagnostic='.$id_diagnostic.'');
		while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
			echo $row[0]."<br/><br/>";
		}	
	?>
	</body>
</html>
