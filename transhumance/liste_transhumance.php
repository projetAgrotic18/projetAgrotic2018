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
		$id_compte_utilisateur = $_SESSION[id_compte_utilisateur];
		$id_type_utilisateur = $_SESSION[id_type_utilisateur];
		
		//Requête pour afficher la liste des transhumances pour les éleveurs
		$transhumance_eleveur = $connex->requete("SELECT * FROM lot_mvt WHERE id_compte_utilisateur = $id_compte_utilisateur");
			
		//Requête pour afficher la liste des transhumances pour le GDS
		$transhumance_gds = $connex->requete("SELECT * FROM lot_mvt ORDER BY date_arrivee");
		
		if($id_type_utilisateur == 3){
			echo "<table border=1 bordorcolor=black>";
			while ($row=pg_fetch_array($transhumance_gds,null,PGSQL_NUM)) {
				echo "<tr>";
				for($i=0; $i<pg_num_fields($transhumance_gds); $i++){
					echo "<td>".$row[$i]."</td>";
			}
			echo "</tr>";
			}
		echo "</table>";
		} elseif($id_type_utilisateur == 2){
			echo "<table border=1 bordorcolor=black>";
			while ($row=pg_fetch_array($transhumance_eleveur,null,PGSQL_NUM)) {
				echo "<tr>";
				for($i=0; $i<pg_num_fields($transhumance_eleveur); $i++){
					echo "<td>".$row[$i]."</td>";
			}
			echo "</tr>";
			}
		echo "</table>";
		}
		
		
		?>
	</body>
</html>
