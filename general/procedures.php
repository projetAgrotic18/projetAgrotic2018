<!-- Créer une liste -->
<?php
// $val = nom du champ du recordset qui servira pour la valeur de la liste
// $libelle = nom du champ du recordset à afficher dans la liste

	function Creer_Liste ($resultset, $nom_liste) {
		$nbr_col = pg_num_fields($resultset);
		echo "<SELECT NAME =" .  $nom_liste . " >";
		while ($row = pg_fetch_array($resultset)){
			echo "<OPTION VALUE=".$row[0].">";
				for ($i=1; $i < $nbr_col; $i++) {
					echo $row[$i]." ";
				}
				echo "</OPTION>";
			}
		
		echo "</SELECT>";
	}
?>



<!-- Créer un tableau : -->
<?php

function Creer_Tab ($resultset) {
$nbr_col = pg_num_fields($resultset);

echo "<TABLE BORDER = 1>";
	echo "<THEAD>";		// crée l'en-tête du tableau avec les noms des champs de la requête
		echo "<TR>";
		for ($i=0; $i < $nbr_col; $i++)  // Parcours des colonnes du tableau 
			{
				$nom_champ = pg_field_name($resultset, $i);	// on place le nom de la colonne dans $champ
				echo ("<TH>" . $nom_champ . "</TH>");		// on affiche $champ
				}
			echo "</TR>";
		echo "</THEAD>";

		echo "<TBODY>";
			while ($row = pg_fetch_array($resultset)){
			echo "<TR>";
			for ($j=0; $j < $nbr_col; $j++) {
				echo "<td>".$row[$j]."</td>";
			}
			echo "</TR>";
			}
		echo "</TBODY>";
	echo "</TABLE></CENTER>";
}

?>