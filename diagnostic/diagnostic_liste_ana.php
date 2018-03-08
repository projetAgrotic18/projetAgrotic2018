<?php session_start();

	$prele=$_GET["prele_check"];
	$liste=$_SESSION["choix_prelevements"];
	$present=FALSE;
	
	for ($i=0; $i<count($liste); $i++){
		if ($prele==$liste[$i]){
			$present=TRUE;
			unset($liste[$i]);
			$liste=array_values($liste);
		}
	}	
		if ($present==FALSE){
			array_push($liste,$prele);
	}
	
	$_SESSION["choix_prelevements"]=$liste;
	
	require "../general/connexionPostgreSQL.class.php";
	$connex = new connexionPostgreSQL();
	
	//Vérifie s'il y a 0 prélèvements
	//Appelle aucune fonction, lance une requête qui appelle toutes les analyses
	if (count($liste)==0){
			//Analyses
		$result = $connex->requete('SELECT a.id_analyse, a.libelle_analyse
									FROM "ANALYSE" a
									ORDER BY a.libelle_analyse');
									
		echo "<br/>Analyses : <br/>";							
		while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
			echo "<input type=checkbox name='analyse[]' value=".$row[0].">".$row[1]."<br/>";
		}
	}
	
	//Vérifie s'il y a 1 ou plusieurs prélèvements
	//Appelle seulement la fonction de base pour 1 prélèvement
	else {
		$where_analyse;
		for ($i=0 ; $i < count($liste) ; $i++) {
			$where_analyse = $where_analyse." ap.id_prele = ".$liste[$i]." ";
			if ($i + 1 < count($liste)) {
				$where_analyse = $where_analyse." OR ";
			}
		}
    
		$query_ana = 'SELECT a.id_analyse, a.libelle_analyse
							FROM analyse_prelevement ap JOIN "ANALYSE" a ON ap.id_analyse = a.id_analyse
							WHERE '.$where_analyse.' 
							GROUP BY a.id_analyse, a.libelle_analyse 
							ORDER BY a.libelle_analyse';
		
		$result = $connex->requete($query_ana);
		
		echo "<br/>Analyses : <br/>";
		while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
			echo "<input type=checkbox name='analyse[]' value=".$row[0].">".$row[1]."<br/>";
		}
	}
?>