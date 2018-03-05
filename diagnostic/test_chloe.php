<?php 

require "../general/connexionPostgreSQL.class.php";
$connex = new connexionPostgreSQL();

$result=$connex->requete("SELECT libelle_symptome FROM symp");
$symptomes=array();
while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
	for ($i=0; $i<5; $i++){
		$symptomes[i]=$row[0];
	}
}
echo $symptomes;
?>


