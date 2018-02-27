<?php session_start();

	$mala=$_GET["mala_check"];
	$liste=$_SESSION["choix_maladies"];
	$present=FALSE;
	
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
	
	$_SESSION["choix_maladies"]=$liste;
	
	require "../general/connexionPostgreSQL.class.php";
	$connex = new connexionPostgreSQL();
	
	
	//La fonction qui fait la requete de base qui sert pour un seul symptome
	//Si plus de 1 symptome, cette requete de base sera construite en premier, puis imbriquée par la fonction query_maladie_n
	function query_prelevement_1($liste) {
		$query_prelev = "SELECT m.id_maladie, m.libelle_maladie
					   FROM symptmala s JOIN maladie m ON s.id_maladie = m.id_maladie WHERE s.id_sympt = ".$liste[0];
		return $query_prelev;
	}
	
	//La fonction appellée si plus de 1 symptome. Elle imbrique la première requete autant de fois qu'il y a de symptomes choisis (au-dela de 1)
	function query_prelevement_n($liste, $query_prelev) {
		for ($i= 1; $i < count($liste) ; $i++) {
			$query_prelev = "SELECT selec".$i.".id_maladie, selec".$i.".libelle_maladie FROM (".$query_prelev.") AS selec".$i." 
			JOIN symptmala sy".$i." ON selec".$i.".id_maladie = sy".$i.".id_maladie 
			WHERE sy".$i.".id_sympt = ".$liste[$i];
		}
		return $query_prelev;
	}
	
	//Vérifie s'il y a 0 symptomes
	//Appelle aucune fonction, lance une requête qui appelle toutes les maladies
	if (count($liste)==0){
			//Maladies :
		echo "Prelevement : <br/>";
		$result = $connex->requete("SELECT maladie.id_maladie, libelle_maladie FROM maladie");
		while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
			echo "<input type=checkbox name='prelevement[]' value=".$row[0].">".$row[1]."<br/>";
		}
	}
	
	//Vérifie s'il y a 1 ou plusieurs symptomes
	//Appelle seulement la fonction de base pour 1 symptome
	elseif (count($liste) == 1) {
		$query_prelev = query_prelevement_1($liste);
		echo "Prelevement : <br/>";
		$result_prelev = $connex->requete($query_prelev);
		while ($row = pg_fetch_array($result_prelev, null, PGSQL_NUM)) {
			echo "<input type=checkbox name='prelevement[]' value=".$row[0].">".$row[1]."<br/>";
		}
	}
	
	//Vérifie s'il y a plusieurs symptomes
	//Appelle la fonction pour 1 symptome, puis imbrique cette requete en appellant la fonction query_maladie_n
	elseif (count($liste) > 1) {
		$query_prelev = query_prelevement_1($liste);
		$query_prelev = query_prelevement_n($liste, $query_prelev);
		echo "Prelevement : <br/>";
		$result_prelev = $connex->requete($query_prelev);
		while ($row = pg_fetch_array($result_prelev, null, PGSQL_NUM)) {
			echo "<input type=checkbox name='prelevement[]' value=".$row[0].">".$row[1]."<br/>";
		}
	}

?>