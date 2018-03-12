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
			$result_all_compte =  $connex->requete("SELECT libelle_type_utilisateur, nom, 
									portable, mail FROM compte_utilisateur cu 
									JOIN type_utilisateur tu ON cu.id_type_utilisateur=tu.id_type_utilisateur");

			$nbr_col = pg_num_fields($result_all_compte);
			?>
			<FORM action='ecriture_mail.php' method='post'>
				<TABLE border=1 id="example">
					<THEAD>
						<TR>
							<TH>Type d'utilisateur</TH>
							<TH>Nom</TH>
							<TH>Téléphone</TH>
							<TH>Mail</TH>
							<TH>Sélectionner</TH>
						</TR>
					</THEAD>
					<TBODY>
						<?php
						while ($row = pg_fetch_array($result_compte)){
							echo "<TR>";
								echo "<td>".$row[0]."</td>";
								echo "<td>".$row[1]."</td>";
								echo "<td>".$row[2]."</td>";
								echo "<td>".$row[4]."</td>";
								echo "<td> <input type='checkbox' id='check[]' name='check[]' value='".$row[0]."'></td>";
							echo "</TR>";
						}
						?>
					</TBODY>
				</TABLE>
				<INPUT type='submit' value="Envoyer un mail aux destinataires sélectionnés"/>
			</FORM>
		<?php
		} 
		else {
			// Exécution de la requête SQL

			$result_compte =  $connex->requete("SELECT libelle_type_utilisateur, nom, 
									portable, mail FROM compte_utilisateur cu 
									JOIN type_utilisateur tu ON cu.id_type_utilisateur=tu.id_type_utilisateur
									WHERE cu.id_type_utilisateur=$result_liste");

			$nbr_col = pg_num_fields($result_compte);

			?>
			<FORM action='ecriture_mail.php' method='post'>
				<TABLE border=1 id="example">
					<THEAD>
						<TR>
							<TH>Type d'utilisateur</TH>
							<TH>Nom</TH>
							<TH>Téléphone</TH>
							<TH>Mail</TH>
							<TH>Sélectionner</TH>
						</TR>
					</THEAD>
					<TBODY>
						<?php
						while ($row = pg_fetch_array($result_compte)){
							echo "<TR>";
								echo "<td>".$row[0]."</td>";
								echo "<td>".$row[1]."</td>";
								echo "<td>".$row[2]."</td>";
								echo "<td>".$row[4]."</td>";
								echo "<td> <input type='checkbox' id='check[]' name='check[]' value='".$row[0]."'></td>";
							echo "</TR>";
						}
						?>
					</TBODY>
				</TABLE>
				<INPUT type='submit' value="Envoyer un mail aux destinataires sélectionnés"/>
			</FORM>
		<?php
		}
       ?>
	</body>
</html>