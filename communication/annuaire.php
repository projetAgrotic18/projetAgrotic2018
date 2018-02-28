<html>
    <head>
        <title>Annuaire</title>
		<META charset="UTF-8"/>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
         		
		<!--- Style Sonnaille -->
        <link href="../general/front/style.css" rel="stylesheet">
         
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
					}
				});
			}
		</script> 
    </head>
    <body>
    	<!-- Entête -->
    
    	<!-- DIV Navigation (Menus) -->
        <?php include("../general/front/navigation.html"); ?>
    
    	<!-- Appelle de la page regroupant les fonctions -->
        <?php require_once('../general/procedures.php'); ?>
    
    	<div class="container">
    		<div class="row">
    			<div class="col-sm-4">
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
    			</div>
    			<div class="col-sm-8">
					<BR/><BR/> 
    				<FORM>
    					<INPUT type="text" size="20" value="Recherche"></INPUT>
    				</FORM>
    			</div>
    		</div>
        	
			<p>Annuaire :</p>
			
			<span id="listeAnnuaire"></span>
			
		</div>
		
		 <!-- Pied de page -->		
        <?php include("../general/front/footer.html"); ?>	
		
	</body>
</html>