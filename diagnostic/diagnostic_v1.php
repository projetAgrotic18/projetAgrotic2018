<html>
	<head>
	<META charset="UTF-8">
	<script src="https://code.jquery.com/jquery-3.3.1.min.js">
	</script>

	<!-- Section Javascript: définition de la fonction gérant la récupération des données -->
	<script type="text/javascript">

		function afficheSymptome(str){
			$.ajax({
				type: 'get',
				url: 'diagnostic_v1_ajax.php',
				data: {
					debut:str
					},
				success: function (response) {
					document.getElementById("txtSymptome").innerHTML=response; 
				}
			});
		}
		 function init(){
			 $.ajax({
				type: 'get',
				url: 'diagnostic_v1_ajax.php',
				data: {
					debut:""
					},
				success: function (response) {
					document.getElementById("txtSymptome").innerHTML=response; 
				}
			});
		}
		
	</script>
	</head>
	<body onload="init()">
	
	<?php
	?>
	
	<h1>Diagnostic vétérinaire</h1>
	(*) : champs obligatoires <br/>	
	<form method="GET" action="diagnostic_2_v1.php">
	
	
	<h2>Caractéristiques généraux :</h2>
	* Nom de l'exploitant : <br/>
	<input type="text" name="nom_exploitant" size="20" value=" "><br/>
	* Nom de l'exploitation : <br/>
	<input type="text" name="nom_exploitation" size="20"><br/>
	* Commune : <br/>
	<input type="text" name="commune" size="20"><br/>
	* Date : <br/>
	<input type="date" name="date" size="10"><br/><br/>
	
	<h2>Caractéristiques du diagnostic :</h2>
	* Espèce : <br/>	
	<select name="espece">
		<option value="01">Bovin</option>
		<option value="02">Ovin</option>
		<option value="03">Caprin</option>
	</select><br/><br/>
	* Numéro d'identification : <br/>	
	<input type="text" name="numero" size="20"><br/>
	* Sexe : <br/>	
	<select name="sexe">
		<option value="01">Femelle</option>
		<option value="02">Mâle</option>
	</select><br/><br/>


	<form>
		Symptomes : <input type="text" size="20" onkeyup="afficheSymptome(this.value)">
	</form>
	
	<p>Suggestions de symptomes : <br/><span id="txtSymptome"></span></p>
 

	<input type="submit" name="bouton1" value="Annuler">
	<input type="submit" name="bouton1" value="Ajouter mon diagnostic"><br/><br/>
	</form>
	</body>
</html>
