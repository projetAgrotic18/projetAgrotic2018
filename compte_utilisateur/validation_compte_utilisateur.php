<?php session_start() ?>
<html>
	<head>
    <title> Validation de compte </title>
    <script type="text/javascript" src="http://code.jquery.com/jquery-3.3.1.min.js"></script> 
</head>
<body>
    <!-- Barre de navigation en fonction de l'utilisateur -->
    <?php include('../general/front/navigation.php'); ?>
    
    <div class="padding">
        <center><h1 class='sonnaille_titre'>Création de compte Utilisateur</h1></center><br><br>
        
    <!-- Load CSS--->
    <!--- Style Sonnaille-->
    <LINK rel="stylesheet" type="text/css" href="style.css">
    <!--- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        
	</head>
	<body>
		<?php

        
        $login = $_POST["login"];
        $mdp = $_POST["mot_de_passe"];
        $nom = $_POST["nom"];
        $type = $_POST["rb"];
        $adresse = $_POST["adresse"];
        $adresse2 = $_POST["adresse2"];
        $commune = $_POST["commune"];
        $cp = $_POST["code_postal"];
        //$departement = $_POST["departement"];
        $tel = $_POST["telephone"];
        $mail = $_POST["mail"];
        // Connexion, sélection de la base de données

        $connex = new connexionPostgreSQL();

		// Exécution de la requête SQL
		
        if($type == eleveur){
			$result = $connex->requete("INSERT INTO compte_utilisateur (id_type_utilisateur, id_commune, identifiant, mdp, nom, portable, mail, adresse, adresse2, nom_exploitation) VALUES ( (SELECT id_type_utilisateur FROM type_utilisateur WHERE libelle_type_utilisateur='$type'), (SELECT id_commune FROM commune WHERE nom_commune='$commune'),'$login', '$mdp', '$nom', '$tel', '$mail', '$adresse','$adresse2', '$exploit')");
		}
		else{
			$result = $connex->requete("INSERT INTO compte_utilisateur (id_type_utilisateur, id_commune, identifiant, mdp, nom, portable, mail, adresse, adresse2) VALUES ( (SELECT id_type_utilisateur FROM type_utilisateur WHERE libelle_type_utilisateur='$type'), (SELECT id_commune FROM commune WHERE nom_commune='$commune'),'$login', '$mdp', '$nom', '$tel', '$mail', '$adresse','$adresse2')");
		}
		
		echo "<br><br><div align='center'><h5>Votre compte a bien été créé.</h5></div><br>";


		    echo "<br><br><div align='center'><h1>Votre compte a bien été créé</div><br>";

			pg_free_result($result);

		// Ferme la connexion

			$connex->fermer();
		?>
		<div class="center">
<<<<<<< Updated upstream
		<form action='compte_utilisateur.php' method='GET' name='form_retour_liste'>
=======
		<form action='compte_utilisateur_front.php' method='GET' name='form_retour_liste'>
>>>>>>> Stashed changes
			<input type='submit' name='bt_retour' value='Retour' class="btn bouton-sonnaille bouton-m">
		</form> 
        </div>
	</body>
</html>