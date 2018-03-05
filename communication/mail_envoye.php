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
			$mailto=$_POST['mail'];
			$obj=$_POST['objet'];
			$from=$_POST['expediteur'];
			$message=$_POST['message'];
			
			echo "toto";
			echo $mailto;
			echo $obj;
			echo $from;
			echo $message;
			?>	
		</div>
		
		<!-- Pied de page -->		
        <?php include("../general/front/footer.html"); ?>
	</body>
</html>