<?php
session_start(); 
?>
<html>
    <head>
        <title>Liste des transhumances</title>
		<META charset="UTF-8"/>
    </head>
    <body>
        <?php
		
		// Connexion, sélection de la base de données
		require "../general/connexionPostgreSQL.class.php";
		$connex = new connexionPostgreSQL();
		
		//Récupération de l'id lors de la connexion (page d'accueil)
		//$id_compte_utilisateur = $_SESSION[];
		//Requête qui récupère le type de compte en fonction de l'id_compte_utilisateur
		$type_compte = $connex->requete("SELECT type FROM comptes_utilisateurs WHERE id_compte_utilisateur = '1'");
		
		echo pg_fetch_array($type_compte,null,PGSQL_NUM);
		
		
		//Requête pour afficher la liste des transhumances
		$transhumances = $connex->requete("SELECT * FROM transhumances ORDER BY date_arrivee");
		
		echo "<table border=1 bordorcolor=black>";
		while ($row=pg_fetch_array($transhumances,null,PGSQL_NUM)) {
			echo "<tr>";
			for($i=0; $i<pg_num_fields($transhumances); $i++){
				echo "<td>".$row[$i]."</td>";
			}
			echo "</tr>";
		}
		echo "</table>";
		
		?>
	</body>
</html>
