<html>
    <head>
        <title>Annuaire</title>
		<META charset="UTF-8"/>
		<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/themes/smoothness/jquery-ui.css" />
        
         <script type="text/javascript" src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
         
         <!-- Section Javascript : définition de la fonction gérant l'affichage des données clients'-->
		<script type="text/javascript">
			function liste_annuaire(str){
				$.ajax({
					type: 'get',
					url: 'majListeAnnuaire.php',
					data: {
						choixListe: str
					},
					success: function (response){
						document.getElementById("ficheCompte").innerHTML=response;
					}
				});
			}
		</script>
		
		<!--- Style Sonnaille -->
        <link href="../general/front/style.css" rel="stylesheet">
       
    </head>
    <body>
    	
    	 <!-- Entête -->
    
    	<!-- DIV Navigation (Menus) -->
        <?php include("../general/front/navigation.html"); ?>
    
    	<!-- Appelle de la page regroupant les fonctions -->
        <?php require_once('../general/procedures.php'); ?>
    
    	<div class="container">
        	<?php
				require ("../general/connexionPostgreSQL.class.php");
            	// Connexion, sélection de la base de données du projet

        		$connex = new connexionPostgreSQL();
	
            	// Exécution de la requête SQL

            	$result_type=$connex->requete("SELECT id_type_utilisateur, libelle_type_utilisateur
            									FROM type_utilisateur");
            
            	$nbre_col = pg_num_fields($result_type);
				echo "</br></br>";
		
				echo "<FORM>";
				echo "<SELECT NAME='nomListe' onchange='liste_annuaire(this.value)'>";
					echo "<OPTION selected='selected'>Type de compte</OPTION>";
					while ($row = pg_fetch_array($result_type)){
						echo "<OPTION VALUE=".$row[0].">";
						for ($i=1; $i < $nbr_col; $i++) {
							echo $row[$i];
						}
						echo "</OPTION>";
					}
				echo "</SELECT>";
				echo "</FORM>";
		
			?>
		
			<p>Annuaire :</p>
		
			<span id="ficheCompte"></span>
			</div>
		
		 <!-- Pied de page -->		
        <?php include("../general/front/footer.html"); ?>	
		
	</body>
</html>