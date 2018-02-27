<html>
	<head>
		<META charset="UTF-8"/>
	</head>
	<body>
		
		<?php
		
		/* récupération des données transmises par le formulaire */
		//$result_liste = $_GET["choixListe"];
		
		require "../general/connexionPostgreSQL.class.php";
        // Connexion, sélection de la base de données du projet

        $connex = new connexionPostgreSQL();
	
        // Exécution de la requête SQL

        $result_compte =  $connex->requete("SELECT libelle_type_utilisateur AS Type, nom AS Nom, 
            						portable AS Telephone, mail AS Email FROM compte_utilisateur cu 
        							JOIN type_utilisateur tu ON cu.id_type_utilisateur=tu.id_type_utilisateur
        							WHERE cu.id_type_utilisateur = 1");
		
		$nbr_col = pg_num_fields($result_compte);
		
		echo "<TABLE border=1>";
		echo "<THEAD>";
		echo "<TR>";
		for($i = 0; $i < $nbr_col; $o++) {
			$nom_champ = pg_field_name($result_compte, $i);
			echo ("<TH>" . $nom_champ. "</TH>");
		}
		echo "</TR>";
		echo "</THEAD>";
		echo "<TBODY>";
		while ($row = pg_fetch_array($result_compte)){
			echo "<TR>";
			for ($j=0; $j < $nbr_col; $j++) {
				echo "<td>".$row[$j]."</td>";
			}
			echo "</TR>";
		}
		echo "</TBODY>";
		echo "</TABLE>";
		
		?>
		
	</body>
		
	
</html>