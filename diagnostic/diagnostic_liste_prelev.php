<?php session_start();

	$mala=$_GET["mala_check"];
	$liste=$_SESSION["choix_maladies"];
	$present=FALSE;
	
	for ($i=0; $i<count($liste); $i++){
		if ($mala==$liste[$i]){
			$present=TRUE;
			unset($liste[$i]);
			$liste=array_values($liste);
		}
	}	
		if ($present==FALSE){
			array_push($liste,$mala);
	}
	
	$_SESSION["choix_maladies"]=$liste;
	
	require "../general/connexionPostgreSQL.class.php";
	$connex = new connexionPostgreSQL();
	
	//Vérifie s'il y a 0 maladie
	//Appelle aucune fonction, lance une requête qui appelle tous les symptomes
	if (count($liste)==0){
			//Prélèvements :
		$result = $connex->requete("SELECT p.id_prele, p.libelle_prelevement 
									FROM prelev p
									ORDER BY p.libelle_prelevement");
									
		echo "<br/><strong>Prélèvements à réaliser : </strong><br/>";						
		while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
			echo "<input type=checkbox name='prelevement[]' onclick='actu_analyse(this.value)' value=".$row[0].">".$row[1]."<br/>";
		}
	}
	
	//Vérifie s'il y a 1 ou plusieurs maladies
	//Appelle seulement la fonction de base pour 1 maladie
	else {
		
		$where_prelevement;
		for ($i=0 ; $i < count($liste) ; $i++) {
			$where_prelevement = $where_prelevement." pm.id_maladie = ".$liste[$i]." ";
			if ($i + 1 < count($liste)) {
				$where_prelevement = $where_prelevement." OR ";
			}
		}
    
		$query_prelev = "SELECT p.id_prele, p.libelle_prelevement 
							FROM prelevmala pm JOIN prelev p ON p.id_prele = pm.id_prele 
							WHERE ".$where_prelevement." 
							GROUP BY p.id_prele, p.libelle_prelevement 
							ORDER BY p.libelle_prelevement";
		
		$result = $connex->requete($query_prelev);
		
		echo "<br/><strong>Prélèvements à réaliser : </strong><br/>";
		while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
			echo "<input type=checkbox name='prelevement[]' onclick='actu_analyse(this.value)' value=".$row[0].">".$row[1]."<br/>";
		}
	}
?>