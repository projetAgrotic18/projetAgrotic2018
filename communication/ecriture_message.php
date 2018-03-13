<?php session_start();?>
<html>
    <head>
        <title>Ecriture mail</title>
		<META charset="UTF-8"/>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
         		
		<!--- Style Sonnaille -->
        <link href="../general/front/style.css" rel="stylesheet">
	</head>
    <body>
    	<!-- Entête -->
    
    	<!-- DIV Navigation (Menus) -->
        <?php include("../general/Front/navigation.php");
    
    	// Appelle de la page regroupant les fonctions
        require_once('../general/procedures.php'); 
		
		//Appel du fichier contenant la fonction de connexion
		require ("../general/connexionPostgreSQL.class.php");
	
		// Connexion, sélection de la base de données du projet
		$connex = new connexionPostgreSQL(); ?>
		
		<div class="padding">
			
			<?php
			$b="";
			foreach($_POST['check'] as $a){
				$id_selectionne .=$a.", ";
			}
			$id_selectionne = substr($id_selectionne,0,strlen($id_selectionne)-2);  // on elimine la dernière virgule
			$id_selectionne = "(".$id_selectionne.")";
			
			?>
			
			<FORM action="message_envoye.php" method="POST">
				<?php echo "<input type='hidden' id='id_dest' name='id_dest' value='".$id_selectionne."'>" ?>
				<label for='objet'>Objet :</label>
				<br/>
				<input id='objet' name="objet" type='text' size='50'/>
				<br/><br/>
				<label for='message'>Message :</label>
				<br/>
				<textarea id='message' name="message" type='text' cols='50' rows="4"></textarea>
				<br/><br/>
				<label for='envoie_mail'>Envoyer par mail </label>
				<input type='checkbox' id='envoi_mail' name='envoi_mail' value='1'>
				<br/>
				<label for='envoie_sms'>Envoyer par sms </label>
				<input type='checkbox' id='envoi_sms' name='envoi_sms' value='2'>
				<br/>
				<label for='envoie_notif'>Envoyer une notification </label>
				<input type='checkbox' id='envoi_notif' name='envoi_notif' value='3'>
				<br/>
				<input type="submit" value="Envoyer">
			</FORM>
			
			<input type="button" value="Retour à l'annuaire" onclick="self.history.back()">
		</div>
		
		<!-- Pied de page -->		
        <?php include("../general/front/footer.html"); ?>
	</body>
</html>