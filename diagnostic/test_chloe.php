<?php 

require "../general/connexionPostgreSQL.class.php";
$connex = new connexionPostgreSQL();


	// On a bien l'id département du diagnostic 
	//RECUPERATION DES ID COMPTE GDS DU MEME DEPARTEMENT 
	
	$id_espece=array();
	$result= $connex->requete("SELECT * FROM notification");

	// while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
		// echo "<tr>";
		// for ($j=0 ; $j < pg_num_fields($result) ; $j++){
			// echo "<td>";
			// $id_espece[]=$row[$j];
			// echo "</td>";
		// }
		// echo "</tr>";
	// }
		
	// echo $id_espece[0];
	// echo "Deux". $id_espece[1];
	// echo $id_espece[2];
	
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


