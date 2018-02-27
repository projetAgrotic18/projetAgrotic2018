<?php session_start();

	$prele=$_GET["prele_check"];
	$liste=$_SESSION["choix_prele"];
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
	
	
	//La fonction qui fait la requete de base qui sert pour un seul symptome
	//Si plus de 1 maladie, cette requete de base sera construite en premier, puis imbriquée par la fonction query_maladie_n
	function query_prelevement_1($liste) {
		$query_prelev = "SELECT p.id_prele, p.libelle_prelevement
					   FROM prelevmala pm JOIN prelev p ON pm.id_prele = p.id_prele WHERE pm.id_maladie = ".$liste[0];
		return $query_prelev;
	}
	
	//La fonction appellée si plus de 1 maladie. Elle imbrique la première requete autant de fois qu'il y a de maladies choisies (au-dela de 1)
	function query_prelevement_n($liste, $query_prelev) {
		for ($i= 1; $i < count($liste) ; $i++) {
			$query_prelev = "SELECT selec".$i.".id_prele, selec".$i.".libelle_prelevement FROM (".$query_prelev.") AS selec".$i." 
			JOIN prelevmala pm".$i." ON selec".$i.".id_prele = pm".$i.".id_prele 
			WHERE pm".$i.".id_maladie = ".$liste[$i];
		}
		return $query_prelev;
	}
	
	//Vérifie s'il y a 0 maladie
	//Appelle aucune fonction, lance une requête qui appelle tous les symptomes
	if (count($liste)==0){
			//Prélèvements :
		echo "Prelevement : <br/>";
		$result = $connex->requete("SELECT prelev.id_prele, libelle_prelevement FROM prelev");
		while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
			echo "<input type=checkbox name='prelevement[]' value=".$row[0].">".$row[1]."<br/>";
		}
	}
	
	//Vérifie s'il y a 1 ou plusieurs maladies
	//Appelle seulement la fonction de base pour 1 maladie
	elseif (count($liste) == 1) {
		$query_prelev = query_prelevement_1($liste);
		echo "Prelevement : <br/>";
		$result_prelev = $connex->requete($query_prelev);
		while ($row = pg_fetch_array($result_prelev, null, PGSQL_NUM)) {
			echo "<input type=checkbox name='prelevement[]' value=".$row[0].">".$row[1]."<br/>";
		}
	}
	
	//Vérifie s'il y a plusieurs maladies
	//Appelle la fonction pour 1 maladie, puis imbrique cette requete en appellant la fonction query_prelevement_n
	elseif (count($liste) > 1) {
		$query_prelev = query_prelevement_1($liste);
		$query_prelev = query_prelevement_n($liste, $query_prelev);
		echo "Prelevements : <br/>";
		$result_prelev = $connex->requete($query_prelev);
		while ($row = pg_fetch_array($result_prelev, null, PGSQL_NUM)) {
			echo "<input type=checkbox name='prelevement[]' value=".$row[0].">".$row[1]."<br/>";
		}
	}

?>