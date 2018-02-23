<?php session_start();
	$sym=$_GET["porygon"];
	$liste=$_SESSION["choix_symptome"];
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
	
	$_SESSION["choix_symptome"]=$liste;
	
	for ($i=0; $i<count($liste); $i++){
		echo $liste[$i];
	}
	
	if (count($liste)==0){
			//Maladies :
		echo "Maladies : <br/>";
		$result = $connex->requete("SELECT maladie.id_maladie, libelle_maladie FROM maladie");
		while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
			echo "<input type=checkbox name='maladie[]' value=".$row[0].">".$row[1]."<br/>";
		}
	}
	else{
		//requete $liste 
		echo "Maladies : <br/>";
		$result = $connex->requete("SELECT maladie.id_maladie, libelle_maladie FROM maladie");
		while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
			echo "<input type=checkbox name='maladie[]' value=".$row[0].">".$row[1]."<br/>";
		}
	}
?>