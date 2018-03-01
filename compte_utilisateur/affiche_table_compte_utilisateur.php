<?php

	require "../general/connexionPostgreSQL.class.php";
	$connex = new connexionPostgreSQL();
	$result = $connex->requete("SELECT * FROM compte_utilisateur");
	
	echo "<table border = 1 bordercolor = black>";
	echo "<tr>";
	for ($i=0 ; $i < pg_num_fields($result) ; $i++){
		echo "<td>";
		echo pg_field_name($result, $i);
		echo "</td>";
	}
	echo "</tr>";
	
	while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
		echo "<tr>";
		for ($j=0 ; $j < pg_num_fields($result) ; $j++){
			echo "<td>";
			echo $row[$j];
			echo "</td>";
		}
		echo "</tr>";
	}