<?php session_start();
	$sym=$_GET["porygon"];
	$liste=$_SESSION["choix_symptome"];
	$present=FALSE;
	
	require "../general/connexionPostgreSQL.class.php";
	$connex = new connexionPostgreSQL();
	
	for ($i=0; $i<count($liste); $i++){
		if ($sym==$liste[$i]){
			$present=TRUE;
			unset($liste[$i]);
			$liste=array_values($liste);
		}
	}	
		if ($present==FALSE){
			array_push($liste,$sym);
	}
	
	$_SESSION["choix_symptome"]=$liste;
	
	if (count($liste)==0){
			//Maladies :
		echo "Maladies : <br/>";
		$result = $connex->requete("SELECT maladie.id_maladie, libelle_maladie FROM maladie");
		while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
			echo "<input type=checkbox name='maladie[]' value=".$row[0].">".$row[1]."<br/>";
		}
	}
	
	else {
		$where_maladie;
		for ($i=0 ; $i < count($liste) ; $i++) {
			$where_maladie = $where_maladie." s.id_sympt = ".$liste[$i]." ";
			if ($i + 1 < count($liste)) {
				$where_maladie = $where_maladie." OR ";
			}
		}
		
		$query_mala = "SELECT m.id_maladie, m.libelle_maladie FROM symptmala s JOIN maladie m ON s.id_maladie = m.id_maladie WHERE ".$where_maladie." GROUP BY m.id_maladie, m.libelle_maladie ORDER BY m.libelle_maladie";
		
		echo "Maladies : <br/>";
		$result_mala = $connex->requete($query_mala);
		while ($row = pg_fetch_array($result_mala, null, PGSQL_NUM)) {
			echo "<input type=checkbox name='maladie[]' value=".$row[0].">".$row[1]."<br/>";
		}
	}
?>