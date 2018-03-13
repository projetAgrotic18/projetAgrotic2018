<?php 

require "../general/connexionPostgreSQL.class.php";
$connex = new connexionPostgreSQL();

		$id_dpt_diagnostic=1;

	// On a bien l'id département du diagnostic 
	//RECUPERATION DES ID COMPTE GDS DU MEME DEPARTEMENT 
	$result= $connex->requete("SELECT co.id_compte 
					FROM  commune c
					JOIN compte_utilisateur co ON c.id_commune=co.id_commune 
					WHERE co.id_type_utilisateur =4 AND c.id_dpt=".$id_dpt_diagnostic);
		
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

?>


