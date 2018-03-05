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
	</head>
    <body>
    	<!-- Entête -->
    
    	<!-- DIV Navigation (Menus) -->
        <?php include("../general/front/navigation.html"); ?>
    
    	<!-- Appelle de la page regroupant les fonctions -->
        <?php require_once('../general/procedures.php'); ?>
		
		<div class="padding">
			
			<?php
			$b="";
			foreach($_POST['check'] as $a){
				$b.=$a."; ";
			}
			?>
			<FORM action='mail_envoye.php' method='post'>
				<?php
				echo "<label for='mail'>Mail :</label>";
				echo "<br/>";
				echo "<input id='mail' type='text' value='".$b."' size='50'/>"; ?>
				<br/><br/>
				<label for='objet'>Objet :</label>
				<br/>
				<input id='objet' type='text' size='50'/>
				<br/><br/>
				<label for='expediteur'>Votre mail :</label>
				<br/>
				<input id='expediteur' type='email' size='50'/>
				<br/><br/>
				<label for='message'>Message :</label>
				<br/>
				<textarea id='message' type='text' cols='50' rows="4"></textarea>
				<br/><br/>
				<input type="submit" value="Envoyer">
				
			</FORM>
			
			<input type="button" value="Retour à l'annuaire" onclick="self.history.back()">
		</div>
		
		<!-- Pied de page -->		
        <?php include("../general/front/footer.html"); ?>
	</body>
</html>