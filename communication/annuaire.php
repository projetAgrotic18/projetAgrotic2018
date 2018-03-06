<?php /*session_start();
if (isset($_SESSION["id_compte"])==false){
    header("Location: http://194.199.251.139/projetAgrotic2018/page d'accueil/Connexion.php");
    exit;
}*/?>
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
		
		<div class="padding">
			<h2>Annuaire</h2>
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
			
			<span id="listeAnnuaire">
				<?php
				$result_all_compte =  $connex->requete("SELECT libelle_type_utilisateur AS Type, nom AS Nom, 
									portable AS Telephone, mail AS Email FROM compte_utilisateur cu 
									JOIN type_utilisateur tu ON cu.id_type_utilisateur=tu.id_type_utilisateur");

				$nbr_col = pg_num_fields($result_all_compte);
				?>
				<FORM action='ecriture_mail.php' method='post'>
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
							$count=0;
							while ($row = pg_fetch_array($result_all_compte)){
								echo "<TR>";
									echo "<td>".$row[0]."</td>";
									echo "<td>".$row[1]."</td>";
									echo "<td>".$row[2]."</td>";
									echo "<td> <input type='checkbox' id='check[]' name='check[]' value='".$row[3]."'><label for='check[]'> ".$row[3]."</label></td>";
								echo "</TR>";
								$count=$count+1;
							}
							?>
						</TBODY>
					</TABLE>
					<INPUT type='submit' value="Envoyer un mail aux destinataires sélectionnés"/>
				</FORM>
			</span>
			<BR/>		
		</div>
    
		 <!-- Pied de page -->		
        <?php include("../general/front/footer.html"); ?>	
		
	</body>
</html>