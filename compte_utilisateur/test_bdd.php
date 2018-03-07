<?php
    require "../general/connexionPostgreSQL.class.php";

//Puis la ligne suivante pour établir une connexion avec la BDD du projet :

	$connex = new connexionPostgreSQL();

//Pour faire une requête sur la BDD du projet, écrire ENSUITE la ligne suivante :

	$result = $connex->requete("SELECT * FROM type_utilisateur");

//Pour parcourir les lignes de votre $result, utiliser :

	while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
        echo $row[0]."  ".$row[1]."<br/>";
    }



//Pour connaître le nom d'un champs du $result :

	pg_field_name($result, $i); //où $i est le champs numéro i
?>