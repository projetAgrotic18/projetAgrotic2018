<html>
	<head>
        <title>Liste Diagnostic</title>
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
		
		<h1> Liste des diagnostics </h1><br/>
		
		<?php
		
			require "../general/connexionPostgreSQL.class.php";
			$connex = new connexionPostgreSQL();
	
			//Zones de textes des dates de diagnostic
			
			echo "Pour une période allant du : <input type='date' name='zt_date_debut'>";
			echo "Au : <input type='date' name='zt_date_fin'>";
		
			
				$result_all_compte =  $connex->requete("SELECT ld.id_diagnostic, nom_veterinaire, nom_eleveur, nom_commune, libelle_espece, libelle_maladie, date_diagnostic FROM liste_diag ld join maladie_diag md on ld.id_diagnostic=md.id_diagnostic 
                join maladie m on md.id_maladie=m.id_maladie");

				$nbr_col = pg_num_fields($result_all_compte);
				?>
				
                <TABLE border=1 id="example">
                    <THEAD>
                        <TR>
                            <?php
                            for($i = 1; $i < $nbr_col; $i++) {
                                $nom_champ = pg_field_name($result_all_compte, $i);
                                echo ("<TH>" . $nom_champ. "</TH>");
                            }
                            ?>
                            <td></td>
                        </TR>
                    </THEAD>
                    <TBODY>
                        <?php
                        while ($row = pg_fetch_array($result_all_compte)){
                            echo "<TR>";
                                for($i = 1; $i < $nbr_col; $i++) {
                                    echo "<td>".$row[$i]."</td>";
                                }
                                $id_diagnostic=$row[0];
                                echo "<td><a href = 'consultation_diagnostic.php?id_diagnostic=$row[0]'><button type='button'>Détails</button></a></td>";
                                echo "</TR>";
                        }
                        ?>
                    </TBODY>
                </TABLE>
			

		
			<!-- Pied de page -->		
			<?php include("../general/front/footer.html"); ?>
		
		</body>
</html>