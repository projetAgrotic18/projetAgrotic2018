<html>
	<head>
		<META charset="UTF-8"/>
		
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
         		
		<!--- Style Sonnaille -->
        <link href="../general/front/style.css" rel="stylesheet">

	</head>
	<body>

		<?php
			
			
			require "../general/connexionPostgreSQL.class.php";
			$connex = new connexionPostgreSQL();
			
			if(isset($_GET["eleveur"])){
				$id_eleveur = $_GET["eleveur"];
				$result = $connex->requete("SELECT d.id_diagnostic, cu.nom, d.date_diagnostic, d.preconisation, d.confirme, c.nom_commune 
										FROM (compte_utilisateur cu JOIN diagnostic d ON cu.id_compte=d.id_compte) JOIN commune c ON d.id_commune=c.id_commune WHERE cu.id_compte=$id_eleveur");
				$nbr_col = pg_num_fields($result);
				?>
				<TABLE border=1 id="example">
					<THEAD>
						<TR>
							<?php
							for($i = 1; $i < $nbr_col; $i++) {
								$nom_champ = pg_field_name($result, $i);
								echo ("<TH>" . $nom_champ. "</TH>");
							}
							?>
						</TR>
					</THEAD>
					<TBODY>
						<?php
						while ($row = pg_fetch_array($result)){
							echo "<TR>";
							for ($j=1; $j < $nbr_col; $j++) {
								echo "<TD>".$row[$j]."</TD>";
							}
							$id_diagnostic=$row[0];
							echo "<TD><a href = 'consultation_diagnostic.php?id_diagnostic=$row[0]'><button type='button'>Détails</button></a></TD>";
							echo "</TR>";
						}
						
						?>
					</TBODY>
				</TABLE>
			<?php
			} elseif (isset($_GET["veterinaire"])){
				$id_veterinaire = $_GET["veterinaire"];
				$result = $connex->requete("SELECT cu.nom, d.date_diagnostic, d.preconisation, d.confirme, c.nom_commune 
										FROM (compte_utilisateur cu JOIN diagnostic d ON cu.id_compte=d.id_compte) JOIN commune c ON d.id_commune=c.id_commune WHERE cu.id_compte=$id_veterinaire");
				$nbr_col = pg_num_fields($result);
				?>
				<TABLE border=1 id="example">
					<THEAD>
						<TR>
							<?php
							for($i = 0; $i < $nbr_col; $i++) {
								$nom_champ = pg_field_name($result, $i);
								echo ("<TH>" . $nom_champ. "</TH>");
							}
							?>
						</TR>
					</THEAD>
					<TBODY>
						<?php
						while ($row = pg_fetch_array($result)){
							echo "<TR>";
							for ($j=0; $j < $nbr_col; $j++) {
								echo "<td>".$row[$j]."</td>";
							}
							echo "</TR>";
						}
						?>
					</TBODY>
				</TABLE>	
			<?php
			}

		$connex->fermer();
       	?>
	</body>
</html>