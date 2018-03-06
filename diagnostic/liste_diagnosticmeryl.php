<html>
	<head>
        <title>Liste Diagnostic</title>
		<META charset="UTF-8"/>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
         		
		<!--- Style Sonnaille -->
        <link href="../general/front/style.css" rel="stylesheet">
		
		<!--Deux lignes de code pour le tableau-->
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css"/>
		<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

		<!-- Section Javascript: définition de la fonction gérant la récupération des données -->
		<script type="text/javascript">
			function afficheDiagnoEl(str){
				$.ajax({
					type: 'get',
					url: 'majEleveurmeryl.php',
					data: {
						eleveur:str
					},
					success: function (response) {
						document.getElementById("liste_diagno").innerHTML=response;
						$(document).ready(function() {
							$('#example').DataTable();
						});
					}
				});
			};
			function afficheDiagnoVet(str){
				$.ajax({
					type: 'get',
					url: 'majEleveurmeryl.php',
					data: {
						veterinaire:str
					},
					success: function (response) {
						document.getElementById("liste_diagno").innerHTML=response;
						$(document).ready(function() {
							$('#example').DataTable();
						});
					}
				});
			}
		</script>
	</head>
		
	<body>
		<b> Tableau des diagnostics : </b><br/>
		
		<?php
		
			require "../general/connexionPostgreSQL.class.php";
			$connex = new connexionPostgreSQL();
			
			//liste des noms de tous les vétérinaires
			$result_vet = $connex->requete("SELECT id_compte, nom FROM compte_utilisateur WHERE id_type_utilisateur='1' ORDER BY nom");
			
			//Compte le nombre de résultats
			$nbre_col = pg_num_fields($result_vet);
			echo "</br></br>";

			//Liste déroulante des vétérinaire
			echo "<FORM>";
			echo "<SELECT NAME='listeVet' onchange='afficheDiagnoVet(this.value)'>";
				echo "<OPTION VALUE='all' SELECTED='selected'>Vétérinaire</OPTION>";
				while ($row = pg_fetch_array($result_vet)){
					echo "<OPTION VALUE=".$row[0].">";
					echo $row[1];
					echo "</OPTION>";
				}
			echo "</SELECT>";
			echo "</FORM>";
			
			//liste des noms de tous les éleveurs
			$result_elev = $connex->requete("SELECT id_compte, nom FROM compte_utilisateur WHERE id_type_utilisateur='2' ORDER BY nom");
			
		
			//Compte le nombre de résultats
			$nbre_col = pg_num_fields($result_elev);
			echo "</br></br>";
					
			//Liste déroulante des éleveurs
			echo "<FORM>";
			echo "<SELECT NAME='listeEleveur' onchange='afficheDiagnoEl(this.value)'>";
				echo "<OPTION VALUE='all' SELECTED='selected'>Éleveur</OPTION>";
				while ($row = pg_fetch_array($result_elev)){
					echo "<OPTION VALUE=".$row[0].">";
					echo $row[1];
					echo "</OPTION>";
				}
			echo "</SELECT>";
			echo "</FORM>";
			
			?>
			<p>Liste des diagnostics: </p>
			<span id='liste_diagno'></span>
		
		</body>
</html>