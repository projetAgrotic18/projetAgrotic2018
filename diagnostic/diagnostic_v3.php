<html>
	<head>
	<META charset="UTF-8">
	<script src="https://code.jquery.com/jquery-3.3.1.min.js">
	</script>

	<!-- Section Javascript: définition de la fonction gérant la récupération des données -->
	<script type="text/javascript">
		function espece_animal(str){
			$.ajax({
				type: 'get',
				url: 'diagnostic_v3_2.php',
				data: {
					porygon:str
				},
				success: function(response){
					document.getElementById("symptome").innerHTML=response;
				}
			});
		}
	</script>

	</head>
	<body>
	<form method="GET" action="diagnostic_v3_2.php">
	
	<h1>Diagnostic vétérinaire</h1>
	(*) : champs obligatoires <br/>	
	
	<!--Caractéristiques-->
	<h2>Caractéristiques généraux :</h2>
	* Nom de l'exploitant : <br/>
	<input type="text" name="nom_exploitant" size="20" value=" "><br/>
	* Nom de l'exploitation : <br/>
	<input type="text" name="nom_exploitation" size="20"><br/>
	* Numéro de l'exploitation : <br/>
	<input type="text" name="numero_exploitation" size="20"><br/>
	* Commune : <br/>
	<input type="text" name="commune" size="20"><br/>
	* Date : <br/>
	<input type="date" name="date" size="10"><br/><br/>
	
	<h2>Caractéristiques du diagnostic :</h2>
	* Numéro d'identification : <br/>	
	<input type="text" name="numero" size="20"><br/><br/>	
	* Sexe : <br/>	
	<input type=radio name="sexe" value="femelle" onclick=>Femelle
	<input type=radio name="sexe" value="male" onclick=>Mâle
	<br/><br/>
	* Espèce : <br/>	
	<input type=radio name="espece" value="bovin" onclick=espece_animal(this.value)>Bovin
	<input type=radio name="espece" value="caprin" onclick=espece_animal(this.value)>Caprin
	<input type=radio name="espece" value="ovin" onclick=espece_animal(this.value)>Ovin
	<br/><br/>
	<!--<span id="symptome"></id>-->

	<?php
	require "../general/connexionPostgreSQL.class.php";
	$connex = new connexionPostgreSQL();	
	
	//Symptomes : 
	echo "Symptomes : <br/>";	
	$result = $connex->requete("SELECT symp.libelle_symptome FROM symp");
	while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
		echo "<input type=checkbox name='symptome' value=".$row[0].">".$row[0]."<br/>";
	}
	echo "<br/>";
	//autre symptome
	// echo "Autre symptome : <br/>";
	// echo "<input type='text' name='autre_symptome' size='60' value=''><br/>";
	// $result= $connex->requete("INSERT INTO symp(id_sympt, id_obl, libelle_symptome) VALUES('', '', '$autre_symptome')";
	
	//Maladies :
	echo "Maladies : <br/>";
	$result = $connex->requete("SELECT libelle_maladie FROM maladie");
	while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
		echo "<input type=checkbox name='maladie' value=".$row[0].">".$row[0]."<br/>";
	}
	echo "<br/>";
	//autre maladie
	// echo "Autre maladie : <br/>";
	// echo "<input type='text' name='autre_maladie' size='60' value=''><br/>";
	// $result= $connex->requete("INSERT INTO maladie(id_maladie, id_espece, libelle_maladie, cat_maladie, precautions) VALUES('', '', '$autre_maladie', '', '')";
	
	//Prélèvements :
	echo "Prélèvements : <br/>";
	$result = $connex->requete("SELECT libelle_prelevement FROM prelev");
	while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
		echo "<input type=checkbox name='prelevement' value=".$row[0].">".$row[0]."<br/>";
	}
	echo "<br/>";
	
	//Analyses :
	echo "Analyses : <br/>";
	$result2 = $connex->requete('SELECT libelle_analyse FROM "ANALYSE"');
	while ($row = pg_fetch_array($result2, null, PGSQL_NUM)) {
		echo "<input type=checkbox name='analyse' value=".$row[0].">".$row[0]."<br/>";
	}
	echo "<br/>";
	?>
	<INPUT type = "submit" value="Ajouter ce diagnostic">
	</form>
	</body>
</html>
