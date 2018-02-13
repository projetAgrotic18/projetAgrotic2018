<?php

require "../general/connexionPostgreSQL.class.php";
$connex = new connexionPostgreSQL();
$result = $connex->requete("SELECT * FROM transhumances");

    echo "<tr>";
    for($i=0; $i<pg_num_fields($result); $i++){
		echo pg_field_name($result, $i)."</br>";  
	}	
    echo "</tr>";

echo "</BR>";

$result2 = $connex->requete("SELECT * FROM comptes_utilisateurs");

    echo "<tr>";
    for($i=0; $i<pg_num_fields($result2); $i++){
		echo pg_field_name($result2, $i)."</br>";  
	}	
    echo "</tr>";

