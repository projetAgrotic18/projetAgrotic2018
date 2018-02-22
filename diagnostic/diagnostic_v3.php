<?php session_start() ?>
<html>
	<head>
	<META charset="UTF-8">
	<script src="https://code.jquery.com/jquery-3.3.1.min.js">
	</script>

	<!-- Section Javascript: définition de la fonction gérant la récupération des données -->
	<script type="text/javascript">
		
	var ok =1;
	var msg = "Veuillez saisir les informations suivantes :";
	function valider(){
		if (document.formsaisie.nom_exploitant.value == "") 	
		{
			ok = 0;
			msg = msg + "\n[Nom de l'exploitant] \n";
		}	
		if (document.formsaisie.date.value == "")
		{
			ok = 0;
			msg = msg + "[Date]";
		}
		if (document.formsaisie.commune.value == "")
		{
			ok = 0;
			msg = msg + "[Lieu du diagnostic]";
		}
		if (document.formsaisie.espece.value == "")
		{
			ok = 0;
			msg = msg + "[Espèce]";
		}
		if (ok !=1)
		{
			alert(msg);
			return false;
		}
	}	
	</script>

	</head>
	<body>
	<form method="GET" action="diagnostic_v3_2.php" onsubmit="return valider()" name="formsaisie">
	
	<h1>Diagnostic vétérinaire</h1>
	(*) : champs obligatoires <br/>	
	
	<!--Caractéristiques-->
	<h2>Caractéristiques généraux :</h2>
	* Nom de l'exploitant : <br/>
	<input type="text" name="nom_exploitant" size="20"><br/>
	  Nom de l'exploitation : <br/>
	<input type="text" name="nom_exploitation" size="20"><br/>
	<!-- A mettre en autocomplétion en fonction du nom de l'exploitant -->
	<!-- Si homonymes, une liste de suggestion des noms d'exploitation des homonymes sera fournie -->
	* Commune du diagnostic : <br/>
	<input type="text" name="commune" size="20"><br/>
	<!-- Champ autocomplété quand les 2 champs "nom exploitant" et "nom exploitation" sont remplis -->
	* Date du diagnostic : <br/>
	<input type="date" name="date" size="10"><br/><br/>
	<!-- La date du jour est récupérée sur l'ordi -->
	
	<h2>Caractéristiques du diagnostic :</h2>
	* Espèce : <br/>	
	<input type=radio name="espece" value="1">Bovin
	<input type=radio name="espece" value="2">Ovin
	<input type=radio name="espece" value="3">Caprin
	<br/><br/>
	<!--<span id="symptome"></id>-->

	<?php
	require "../general/connexionPostgreSQL.class.php";
	$connex = new connexionPostgreSQL();	
	
	// Récupération de l'id du compte_utilisateur vétérinaire connecté à l'outil
	$_SESSION["id_veto"]=7;
	
	//Symptomes : 
	echo "Symptomes : <br/>";	
	$result = $connex->requete("SELECT symp.id_sympt, symp.libelle_symptome FROM symp");
	while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
		echo "<input type=checkbox name='symptome' value=".$row[0].">".$row[1]."<br/>";
	}
	//Autre symptome - Les vétérinaires ne peuvent pas ajouter de nouveaux symptomes à la BDD
	// echo "Autre symptome : <br/>";
	// echo "<input type='text' name='autre_symptome' size='60' value=''><br/><br/>";
	
	//Maladies :
	echo "Maladies : <br/>";
	$result = $connex->requete("SELECT maladie.id_maladie, libelle_maladie FROM maladie");
	while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
		echo "<input type=checkbox name='maladie' value=".$row[0].">".$row[1]."<br/>";
	}
	//Autre maladie - Les vétérinaires ne peuvent pas ajouter de nouvelles maladies à la BDD
	// echo "Autre maladie : <br/>";
	// echo "<input type='text' name='autre_maladie' size='60' value=''><br/><br/>";
	
	//Prélèvements :
	echo "Prélèvements : <br/>";
	$result = $connex->requete("SELECT id_prele, libelle_prelevement FROM prelev");
	while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
		echo "<input type=checkbox name='prelevement' value=".$row[0].">".$row[1]."<br/>";
	}
	echo "<br/>";
	
	//Analyses :
	echo "Analyses : <br/>";
	$result2 = $connex->requete('SELECT id_analyse, libelle_analyse FROM "ANALYSE"');
	while ($row = pg_fetch_array($result2, null, PGSQL_NUM)) {
		echo "<input type=checkbox name='analyse' value=".$row[0].">".$row[1]."<br/>";
	}
	echo "<br/>";
	?>
	
	Préconisations : <br/>
	<input type="text" name="preconisation" size="150"><br/><br/>
	
	<input type="submit" value="Ajouter ce diagnostic">
	</form>
	</body>
</html>
