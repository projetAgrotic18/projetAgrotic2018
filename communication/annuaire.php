<html>
    <head>
        <title>Annuaire</title>
		<META charset="UTF-8"/>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
         		
		<!--- Style Sonnaille -->
        <link href="../general/front/style.css" rel="stylesheet">
        
		<!--Deux lignes de code pour le tableau-->
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css"/>
		<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
		
         <!-- Section Javascript : définition de la fonction gérant l'affichage de l'annuaire -->
		<script type="text/javascript">
			function annuaire(str){
				$.ajax({
					type: 'get',
					url: 'majListeAnnuaire.php',
					dataType: "html",
					data: { 
						choixListe: str
					},
					success: function (response){
						document.getElementById("listeAnnuaire").innerHTML=response;
						$(document).ready(function() {
						$('#example').DataTable();
						});
					}
				});
			}
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
    					//Appel du fichier contenant la fonction de connexion
						require ("../general/connexionPostgreSQL.class.php");
            		
            			// Connexion, sélection de la base de données du projet
        				$connex = new connexionPostgreSQL();
	
            			// Exécution de la requête SQL permettant l'affichage des types de compte (sauf admin)
            			$result_type=$connex->requete("SELECT id_type_utilisateur, libelle_type_utilisateur
            									FROM type_utilisateur
            									WHERE id_type_utilisateur!=6");
            		
            			//Compte le nombre de résultats
            			$nbre_col = pg_num_fields($result_type);
						echo "</br></br>";
					
						//Liste déroulante des types de compte
						echo "<FORM>";
						echo "<SELECT NAME='nomListe' onchange='annuaire(this.value)'>";
							echo "<OPTION VALUE='all' SELECTED='selected'>Tous les comptes</OPTION>";
							while ($row = pg_fetch_array($result_type)){
								echo "<OPTION VALUE=".$row[0].">";
								echo $row[1];
								echo "</OPTION>";
							}
						echo "</SELECT>";
						echo "</FORM>";
		
					?>
        	
			<p>Annuaire :</p>
			
			<span id="listeAnnuaire">
				<?php
				$result_all_compte =  $connex->requete("SELECT libelle_type_utilisateur AS Type, nom AS Nom, 
									portable AS Telephone, mail AS Email FROM compte_utilisateur cu 
									JOIN type_utilisateur tu ON cu.id_type_utilisateur=tu.id_type_utilisateur");

				$nbr_col = pg_num_fields($result_all_compte);
				?>
				<TABLE border=1 id="example">
					<THEAD>
						<TR>
							<?php
							for($i = 0; $i < $nbr_col; $i++) {
								$nom_champ = pg_field_name($result_all_compte, $i);
								echo ("<TH>" . $nom_champ. "</TH>");
							}
							?>
						</TR>
					</THEAD>
					<TBODY>
						<?php
						while ($row = pg_fetch_array($result_all_compte)){
							echo "<TR>";
							for ($j=0; $j < $nbr_col; $j++) {
								echo "<td>".$row[$j]."</td>";
							}
							echo "</TR>";
						}
						?>
					</TBODY>
				</TABLE>
			</span>
			<BR/>
			
		</div>
		
		 <!-- Pied de page -->		
        <?php include("../general/front/footer.html"); ?>	
		
	</body>
</html>