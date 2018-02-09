<html>
	<head> 
		<!--By les Pokemen-->
		<script src="https://code.jquery.com/jquery-3.3.1.min.js">
		</script>
		
		<!-- Changement du type de formulaire -->
		<script type="text/javascript">
		function type_form(str){
				$.ajax({
					type: 'get',
					url: 'compte_utilisateur2.php',
					data: {
						porygon:str
					},
					success: function (response) {
						document.getElementById("monFormulaire").innerHTML=response;
					}
				});
			}
		</script>
		
		<!-- Type d'animaux (pour les éleveurs)-->
		<script type="text/javascript">
		function nb_animaux(str){
			$.ajax({
				type: 'get',
				url: 'compte_utilisateur3.php',
				data: {
					porygon2:str
				},
				success: function (response) {
					document.getElementById("nb_animals").innerHTML=response;
				}
			});
		}
		</script>
		
	</head>
	<body>
		Bienvenue dans l'assistance de création de compte. <br/>
		Que puis-je pour vous?<br/>
		<h2>Type de compte:</h2>
		
		<!-- Radio-boutonpour sélectionner le type de formulaire à remplir-->
		<form method = 'GET' name = 'form_eleveur' action = 'creation_compte3.php'>
			<center>
				<INPUT type = radio name = rb value = 'ddpp' onclick = type_form(this.value)>DDPP 
				<INPUT type = radio name = rb value = 'gds' onclick = type_form(this.value)>GDS 
				<INPUT type = radio name = rb value = 'veto' onclick = type_form(this.value)>Vétérinaire / GTV 
				<INPUT type = radio name = rb value = 'labo' onclick = type_form(this.value)>Laboratoire 
				<INPUT type = radio name = rb value = 'eleveur' onclick = type_form(this.value)>Eleveur <br/>
			</center>
		
		<!-- Affichage formulaire adapté-->
		<span id="monFormulaire"></id>
		<?php
		// Connexion, sélection de la base de données

			$dbconn = pg_connect("host=194.199.251.139 port=5433 dbname=testprojet user=postgres password=postgres")
				or die('Connexion impossible : ' . pg_last_error());

		// Exécution de la requête SQL

			$query = 'SELECT * FROM comptes_utilisateurs';
			$result = pg_query($query) or die('Échec de la requête : ' . pg_last_error());

		// Affichage des résultats en HTML

			echo "<table>";
			while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
				echo "<tr>";
				foreach ($line as $col_value) {
					echo "<td>$col_value</td>";
				}
				echo "</tr>";
				}
			echo "</table>";

		// Libère le résultat

			pg_free_result($result);

		// Ferme la connexion

			pg_close($dbconn);
		?>
	</body>
</html>