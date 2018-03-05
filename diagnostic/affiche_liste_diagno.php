<html>
	<head>
		<META charset="UTF-8"/>
         		
		<!--- Style Sonnaille -->
        <link href="../general/front/style.css" rel="stylesheet">

	</head>
	<body>

		<?php
		require "diag_where.php";
		require "../general/connexionPostgreSQL.class.php";
		$connex = new connexionPostgreSQL();
		
		$id_maladie = $_POST["listeMala"];
		$id_commune = $_POST["listeCommune"];
		$date_debut = $_POST["zt_date_debut"];
		$date_fin = $_POST["zt_date_fin"];
		$id_espece = $_POST["listeEspece"];
		
		//Détermination du nom de la maladie qui correspond à l'identifiant récupéré
		if($id_maladie != "all"){
			$libelle_maladie = $connex->requete("SELECT libelle_maladie FROM maladie WHERE id_maladie=$id_maladie");
		}
		
		//Détermination du nom de la commune qui correspond à l'identifiant récupéré
		if($id_commune != "all"){
			$nom_commune = $connex->requete("SELECT nom_commune FROM commune WHERE id_commune=$id_commune");
		}
		
		//Détermination du nom de l'espèce qui correspond à l'identifiant récupéré
		if($id_espece != "all"){
			$libelle_espece = $connex->requete("SELECT libelle_espece FROM espece WHERE id_espece=$id_espece");
		}
		
		//Mise en place du select général
		$query_select = "nom_veterinaire, nom_eleveur, nom_commune, id_diagnostic, libelle_espece, libelle_maladie";
		
		//Mise en place du FROM
		$query_from = "(liste_diag ld JOIN maladie_diag md ON ld.id_diagnostic = md.id_diagnostic) JOIN maladie m ON md.id_maladie=m.id_maladie";
		
		//Si une maladie a été sélectionnée, on ajoute à la requete de base la condition dans le where
		if($id_maladie != "all"){
			$query_where = query_1("m.id_maladie", $libelle_maladie);
		}
		
		if($id_commune != "all"){
			if(isset($query_where)){
				$query_where .= "AND" + query_1("id_commune", $nom_commune);
			}
			else{
				$query_where = query_1("id_commune", $nom_commune);
			}
		}
		if($date_debut != "all"){
			if(isset($query_where)){
				$query_where .= "AND" + query_2("date_diagnostic", $date_debut);
			}
			else{
				$query_where = query_2("date_diagnostic", $date_debut);
			}
		}
		if($date_fin != "all"){
			if(isset($query_where)){
				$query_where .= "AND" + query_3("date_diagnostic", $date_fin);
			}
			else{
				$query_were = query_3("date_diagnostic", $date_fin);
			}
		}
		if($id_espece != "all"){
			if(isset($query_where)){
				$query_where .= "AND" + query_1("id_espece", $libelle_espece);
			}
			else{
				$query_where = query_1("id_espece", $libelle_espece);
			}
		}
		
		$query = $connex->requete($query_select+$query_from+$query_where);
		echo "<table><thead><tr><th>Vétérinaire</th><th>Eleveur</th><th>Commune</th><th>Diagnostic n°</th><th>Espèce</th><th>Maladie</th></thead>";
		echo "<tbody><tr>";
		for ($i=0 ; $i < pg_num_fields($query) ; $i++){
			echo "<td>";
			echo pg_field_name($query, $i);
			echo "</td>";
		}
		echo "</tr></tbody></table>";
	
		$connex->fermer();
       	?>
	</body>
</html>