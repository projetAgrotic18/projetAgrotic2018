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
        
				
		if($id_type_utilisateur == 3 OR $id_type_utilisateur == 6){   // pour les GDS
            
            //Requête pour afficher la liste des transhumances pour le GDS
            $transhumance_gds = $connex->requete("SELECT lm.id_compte, cu.nom, lm.date_depart, lm.date_arrivee, lm.nom_responsable, lm.id_lot_mvt FROM lot_mvt lm JOIN compte_utilisateur cu ON lm.id_compte=cu.id_compte ORDER BY date_arrivee");
            
            echo "<h1> Liste des tranhumances </h1><br/>";
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
            
            //Requête pour afficher la liste des transhumances pour les éleveurs
            $transhumance_eleveur = $connex->requete("SELECT id_compte, date_arrivee, date_depart, nom_responsable, id_lot_mvt FROM lot_mvt WHERE id_compte = '$id_compte_utilisateur'");
            
            echo "<h1> Liste de vos tranhumances </h1><br/>";
            ?>
            <br/>
            <TABLE border=1 id="example">
                <THEAD>
                    <TR>
                        <TH>Date de départ</TH>
                        <TH>Date d'arrivée</TH>
                        <TH>Nom du responsable</TH>
                        <TH></TH>
                        <TH></TH>
                    </TR>
                </THEAD>
                <TBODY>
                    <?php

                    while ($row=pg_fetch_array($transhumance_eleveur,null,PGSQL_NUM)){
                        echo "<TR>";
                            // Affichage pour chaque diagnostic de ses informations principales
                            for($i = 1; $i < 4; $i++) {
                                echo "<TD>".$row[$i]."</TD>";
                            }
                            // Affichage bouton modifier
                            echo "<TD><a href='modif_transhumance.php?id_lot_mvt=".$row[4]."'>Modifier</a></TD>";
                            //Affichage du bouton détail
                            echo "<TD>
                                    <form action='consultation_transhumance.php?id_lot_mvt=".$row[4]."&type_utilisateur=".$id_type_utilisateur."' method='post'>
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
        $connex->fermer();
    ?>
	</body>
</html>
