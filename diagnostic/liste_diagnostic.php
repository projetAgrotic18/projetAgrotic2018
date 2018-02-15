<html>
	<head>
		<META charset="UTF-8">
		<title> Liste Diagnostic USD3 </title>
	</head>
		
	<body>
		<b> Tableau des diagnostics : </b><br/>
		
		<?php
		require "../general/connexionPostgreSQL.class.php";
		$connex = new connexionPostgreSQL();
		$result = $connex->requete("SELECT c.nom, c.nom_exploitation, co.nom_commune, e.libelle_espece, m.libelle_maladie, d.date_diagnostic, d.id_diagnostic
				FROM commune co JOIN compte_utilisateur c ON co.id_commune = c.id_commune
					JOIN diagnostic d ON c.id_compte = d.id_compte
					JOIN espece e ON d.id_espece = e.id_espece
					JOIN maladie m ON e.id_espece = m.id_espece
				WHERE id_type_utilisateur = 1");

		$row=pg_fetch_array($result,null,PGSQL_NUM);
		
		echo "<table border=1>" ;
		
		$i=0 ;
		echo "<tr>" ;
		while ($i < mysqli_num_fields($result)){
			echo "<td>" . mysqli_fetch_field_direct($result,$i)->name . "</td>" ;
			$i++;
			}
		echo "</tr>" ;
		
		while ($row = mysqli_fetch_array($result)){
			$i = 0 ;
			echo "<tr>" ;
			while ($i < mysqli_num_fields($result)){
				echo "<td>" .$row[$i]." </td>" ;
				$i++;
			}
			echo "</tr>" ;
		}
		
		echo "</table>" ;
		
		mysqli_free_result($result);
		mysqli_close($link);		
		
		?>
				
		</body>
</html>