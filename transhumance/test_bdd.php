<?php
    require "../general/connexionPostgreSQL.class.php";

//Puis la ligne suivante pour établir une connexion avec la BDD du projet :

	$connex = new connexionPostgreSQL();

//Pour faire une requête sur la BDD du projet, écrire ENSUITE la ligne suivante :

	//$result = $connex->requete($query2 = "SELECT * FROM lot_mvt lm JOIN commune c ON lm.id_commune=c.id_commune");

//Pour parcourir les lignes de votre $result, utiliser :

	//while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
   //     echo $row[0]."  ".$row[1]."  ".$row[2]."  ".$row[3]."  ".$row[4]."  ".$row[5]."  ".$row[6]."  ".$row[7]."  ".$row[8]."  ".$row[9]."  ".$row[10]."  ".$row[11]."  ".$row[12]."  ".$row[13]."  ".$row[14]."  ".$row[15]."  ".$row[16]." ".$row[17]."  ".$row[18]."<br/>";
    //}

	//echo "<input type='textarea' name='test' rows=10 cols=40 />";
	
	$result = $connex->requete("SELECT description_marque FROM lot_mvt");

//Pour connaître le nom d'un champs du $result :

	pg_field_name($result, $i); //où $i est le champs numéro i
?>