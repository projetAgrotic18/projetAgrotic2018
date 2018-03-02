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
		$id_compte_utilisateur = $_SESSION["id_compte"];
		$id_type_utilisateur = $_SESSION["id_type_utilisateur"];
		
		//Requête pour afficher la liste des transhumances pour les éleveurs
		$transhumance_eleveur = $connex->requete("SELECT id_compte, date_arrivee, date_depart, nom_responsable, id_lot_mvt FROM lot_mvt WHERE id_compte = '$id_compte_utilisateur'");
			
		//Requête pour afficher la liste des transhumances pour le GDS
		$transhumance_gds = $connex->requete("SELECT lm.id_compte, lm.date_depart, lm.date_arrivee, lm.nom_responsable, cu.nom, lm.id_lot_mvt FROM lot_mvt lm JOIN compte_utilisateur cu ON lm.id_compte=cu.id_compte ORDER BY date_arrivee");
		
		if($id_type_utilisateur == 3){   // pour les GDS
			echo "<table border=1 bordorcolor=black><tr><th>Nom de l'éleveur</th><th>date de départ</th><th>date d'arrivée</th><th>Nom du responsable</th></tr>";
			while ($row=pg_fetch_array($transhumance_gds,null,PGSQL_NUM)) {
				$id = $row[0];
				$date_depart = $row[1];
				$date_arrivee = $row[2];
				$nom_responsable = $row[3];
				$nom_eleveur = $row[4];
				$id_lot_mvt = $row[5];
				echo "<tr>";
				echo "<td>".$nom_eleveur."</td><td>".$date_depart."</td><td>".$date_arrivee."</td><td>".$nom_responsable."</td>";
				echo "<td><form action='consultation_transhumance.php'> <input type='submit' name='bt_submit' value='Voir les détails'/></form></td>";   // envoie vers la fiche récapitulative de la transhumance
				echo "</tr>";
			}
			echo "</table>";
		}
		
		elseif($id_type_utilisateur == 2){    // pour les éleveurs
			echo "<table border=1 bordorcolor=black><tr><th>date de départ</th><th>date d'arrivée</th><th>Nom du responsable</th></tr>";
			while ($row=pg_fetch_array($transhumance_eleveur,null,PGSQL_NUM)) {
				$id = $row[0];
				$date_depart = $row[1];
				$date_arrivee = $row[2];
				$nom_responsable = $row[3];
				$id_lot_mvt = $row[4];
				echo "<tr>";
				echo "<td>".$date_depart."</td><td>".$date_arrivee."</td><td>".$nom_responsable."</td>";
				echo "<td><a href='modif_transhumance.php?id_lot_mvt=".$id_lot_mvt."'>Modifier</a></td>";
				echo "<td><form action='consultation_transhumance.php'> <input type='submit' name='bt_submit' value='Voir les détails'/></form></td>";   // envoie vers la fiche récapitulative de la transhumance
				echo "</tr>";
			}
		echo "</table>";
		}
		$connex->fermer();
		?>
	</body>
</html>
