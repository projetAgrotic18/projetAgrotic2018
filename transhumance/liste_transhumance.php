<?php
session_start(); 
?>
<html>
    <head>
        <title>Liste des transhumances</title>
		<META charset="UTF-8"/>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        
        <!--- Style Sonnaille -->
        <link href="../general/front/style.css" rel="stylesheet">
        
        <!--Deux lignes de code pour le tableau-->
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css"/>
		<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

        <script type="text/javascript">
            //Code pour la mise en forme du tableau (voir datatable)
            $(document).ready(function() {
                 $('#example').DataTable();
            });
        </script>
    </head>
    <body>
        <!-- Entête -->
    
    	<!-- DIV Navigation (Menus) -->
        <?php include("../general/front/navigation.html"); ?>
        
        <!-- Appelle de la page regroupant les fonctions -->
        <?php require_once('../general/procedures.php'); ?>
		
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
		$transhumance_gds = $connex->requete("SELECT lm.id_compte, cu.nom, lm.date_depart, lm.date_arrivee, lm.nom_responsable, lm.id_lot_mvt FROM lot_mvt lm JOIN compte_utilisateur cu ON lm.id_compte=cu.id_compte ORDER BY date_arrivee");
		
		if($id_type_utilisateur == 3 OR $id_type_utilisateur == 6){   // pour les GDS
            echo "<h1> Liste des tranhumances </h1><br/>";
			echo "<table border=1 bordorcolor=black>";
                echo "<tr><th>Nom de l'éleveur</th><th>date de départ</th><th>date d'arrivée</th><th>Nom du responsable</th></tr>";
			while ($row=pg_fetch_array($transhumance_gds,null,PGSQL_NUM)) {
				$id = $row[0];
				$date_depart = $row[1];
				$date_arrivee = $row[2];
				$nom_responsable = $row[3];
				$nom_eleveur = $row[4];
				$id_lot_mvt = $row[5];
				echo "<tr>";
				echo "<td>".$nom_eleveur."</td><td>".$date_depart."</td><td>".$date_arrivee."</td><td>".$nom_responsable."</td>";
				echo "<td><form action='consultation_transhumance.php?id_lot_mvt=".$id_lot_mvt."&type_utilisateur=".$id_type_utilisateur."' method='post'> <input type='submit' name='bt_submit' value='Voir les détails'/></form></td>";   // envoie vers la fiche récapitulative de la transhumance
				echo "</tr>";
			}
			echo "</table>";
		
		
				?>
				<br/>
                <TABLE border=1 id="example">
                    <THEAD>
                        <TR>
                            <TH>Nom de l'éleveur</TH>
                            <TH>Date de départ</TH>
                            <TH>Date d'arrivée</TH>
                            <TH>Nom du responsable</TH>
                            <TH></TH>
                        </TR>
                    </THEAD>
                    <TBODY>
                        <?php
                        while ($row=pg_fetch_array($transhumance_gds,null,PGSQL_NUM)){
                            echo "<TR>";
                                // affichage pour chaque diagnostic de ses informations principales
                                for($i = 1; $i < 5; $i++) {
                                    echo "<TD>".$row[$i]."</TD>";
                                }
                                //Affichage du bouton détail
                                echo "<TD>
                                        <form action='consultation_transhumance.php?id_lot_mvt=".$row[5]."&type_utilisateur=".$id_type_utilisateur."' method='post'>
                                            <input type='submit' name='bt_submit' value='Voir les détails'/>
                                        </form>
                                     </TD>";   // envoie vers la fiche récapitulative de la transhumance
                            echo "</TR>";
                                
                        }
                        ?>
                    </TBODY>
                </TABLE>
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
      <?php  
        }
        
		elseif($id_type_utilisateur == 2){    // pour les éleveurs
            echo "<h1> Liste de vos tranhumances </h1><br/>";
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
				echo "<td><form action='consultation_transhumance.php?id_lot_mvt=".$id_lot_mvt."&type_utilisateur=".$id_type_utilisateur."' method='post'> <input type='submit' name='bt_submit' value='Voir les détails'/></form></td>";   // envoie vers la fiche récapitulative de la transhumance
				echo "</tr>";
			}
		echo "</table>";
		}
		$connex->fermer();
		?>
	</body>
</html>
