<?php 

require "../general/connexionPostgreSQL.class.php";
$connex = new connexionPostgreSQL();


	// On a bien l'id département du diagnostic 
	//RECUPERATION DES ID COMPTE GDS DU MEME DEPARTEMENT 
	
	
	$id_espece=array();
	$result= $connex->requete("SELECT id_espece FROM espece");
	for ($i=0; $i<count($result); $i++){
		while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
			$id_espece[$i]=$row[0];
		}
	}
	for ($i=0; $i<count($id_espece); $i++){
		echo $id_espece[$i];
	}
			
	// echo "<table border = 1 bordercolor = black>";

	// echo "<tr>";
	// for ($i=0 ; $i < pg_num_fields($result) ; $i++){
		// echo "<td>";
		// echo pg_field_name($result, $i);
		// echo "</td>";
	// }
	// echo "</tr>";
	
	// while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
		// echo "<tr>";
		// for ($j=0 ; $j < pg_num_fields($result) ; $j++){
			// echo "<td>";
			// echo $row[$j];
			// echo "</td>";
		// }
		// echo "</tr>";
	// }

?>


