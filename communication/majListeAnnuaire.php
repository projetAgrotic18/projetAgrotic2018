<html>
	<head>
		<META charset="UTF-8"/>
		
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
         		
		<!--- Style Sonnaille -->
        <link href="../general/front/style.css" rel="stylesheet">

	</head>
	<body>
		
		<?php
			
		/* récupération des données transmises par la liste des types de compte */
		$result_liste = $_GET["choixListe"];

		require ("../general/connexionPostgreSQL.class.php");
        
        // Connexion, sélection de la base de données du projet
        $connex = new connexionPostgreSQL();

		if($result_liste=="all"){
			$result_all_compte =  $connex->requete("SELECT libelle_type_utilisateur AS Type, nom AS Nom, 
									portable AS Telephone, mail AS Email FROM compte_utilisateur cu 
									JOIN type_utilisateur tu ON cu.id_type_utilisateur=tu.id_type_utilisateur");

			$nbr_col = pg_num_fields($result_all_compte);
			?>
			<TABLE border=1 id="example">
				<THEAD>
					<TR>
						<?php
						for($i = 0; $i < $nbr_col; $i++) {
							$nom_champ = pg_field_name($result_all_compte, $i);
							echo ("<TH>" . $nom_champ. "</TH>");
						}
						echo "<TH> Sélectionner </TH>";
						?>
					</TR>
				</THEAD>
				<TBODY>
					<?php
					while ($row = pg_fetch_array($result_all_compte)){
						echo "<TR>";
						for ($j=0; $j < $nbr_col; $j++) {
							echo "<td>".$row[$j]."</td>";
						}
						echo "<td> <input type='checkbox'></td>";
						echo "</TR>";
					}
					?>
				</TBODY>
			</TABLE>
		<?php
		} 
		else {
			// Exécution de la requête SQL

			$result_compte =  $connex->requete("SELECT libelle_type_utilisateur AS Type, nom AS Nom, 
									portable AS Telephone, mail AS Email FROM compte_utilisateur cu 
									JOIN type_utilisateur tu ON cu.id_type_utilisateur=tu.id_type_utilisateur
									WHERE cu.id_type_utilisateur=$result_liste");

			$nbr_col = pg_num_fields($result_compte);

			?>
			<TABLE border=1 id="example">
				<THEAD>
					<TR>
						<?php
						for($i = 0; $i < $nbr_col; $i++) {
							$nom_champ = pg_field_name($result_compte, $i);
							echo ("<TH>" . $nom_champ. "</TH>");
						}
						echo "<TH> Sélectionner </TH>";
						?>
					</TR>
				</THEAD>
				<TBODY>
					<?php
					while ($row = pg_fetch_array($result_compte)){
						echo "<TR>";
						for ($j=0; $j < $nbr_col; $j++) {
							echo "<td>".$row[$j]."</td>";
						}
						echo "<td> <input type='checkbox'></td>";
						echo "</TR>";
					}
					?>
				</TBODY>
			</TABLE>
		<?php
		}
       ?>
	</body>
</html>