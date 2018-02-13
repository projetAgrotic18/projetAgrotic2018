<html>
    <head>
        <title>Liste des transhumances</title>
		<META charset="UTF-8"/>
    </head>
    <body>
        <?php
		// Connexion, sélection de la base de données
		require "../general/connexionPostgreSQL.class.php";
		$connex = new connexionPostgreSQL();
		
		//Requête pour afficher la liste des transhumances
		$transhumances = $connex->requete("SELECT * FROM transhumances ORDER BY date_arrivee");

		echo pg_num_rows($result)."</br>";
		echo pg_num_fields($result);
		
		echo "<table border=1 bordorcolor=black>";
		while ($row=pg_fetch_array($transhumances,null,PGSQL_NUM)) {
			echo "<tr>";
			for($i=0; $i<pg_num_fields($transhumance); $i++){
				echo "<td>".$row[$i]."</td>";
			}
			echo "</tr>";
		}
		echo "</table>";
		
		?>
	</body>
</html>
