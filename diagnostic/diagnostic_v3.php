<html>
	<head>
	<META charset="UTF-8">
	<script src="https://code.jquery.com/jquery-3.3.1.min.js">
	</script>

	<!-- Section Javascript: définition de la fonction gérant la récupération des données -->
	<script type="text/javascript">
	</script>

	</head>
	<body>
	<?php
	//require "../general/connexionPostgreSQL.class.php";
	//$connex = new connexionPostgreSQL();
	//$result = $connex->requete("Mettre votre requête ici");
	?>
	
	<h1>Diagnostic vétérinaire</h1>
	(*) : champs obligatoires <br/>	
	<form method="GET" action="diagnostic_v3_2.php">
	
	<!--Caractéristiques-->
	<h2>Caractéristiques généraux :</h2>
	* Nom de l'exploitant : <br/>
	<input type="text" name="nom_exploitant" size="20" value=" "><br/>
	* Nom de l'exploitation : <br/>
	<input type="text" name="nom_exploitation" size="20"><br/>
	* Numéro de l'exploitation : <br/>
	<input type="text" name="numero_exploitation" size="20"><br/>
	* Localisation : <br/>
	<input type="text" name="localisation" size="20"><br/>
	* Date : <br/>
	<input type="date" name="date" size="10"><br/><br/>
	
	<h2>Caractéristiques du diagnostic :</h2>
	* Espèce : <br/>	
	<input type=radio name="espece" value="bovin" onclick=>
	<input type=radio name="espece" value="caprin" onclick=>
	<input type=radio name="espece" value="ovin" onclick=>
	<br/>
	* Numéro d'identification : <br/>	
	<input type="text" name="numero" size="20"><br/><br/>	
	* Sexe : <br/>	
	<input type=radio name="sexe" value="femelle" onclick=>
	<input type=radio name="sexe" value="male" onclick=>
	<br/>

	</form>
	</body>
</html>
