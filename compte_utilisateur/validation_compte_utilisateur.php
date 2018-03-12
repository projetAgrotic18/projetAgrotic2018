<html>
<head>
    <META charset="UTF-8"/>
    <title> Validation de compte </title>
    <script type="text/javascript" src="http://code.jquery.com/jquery-3.3.1.min.js"></script> 
</head>
<body>
    <!-- Barre de navigation en fonction de l'utilisateur -->
    <?php include('../general/switchbar.php'); ?>
    
    <div class="padding">
        <center><h1 class='sonnaille_titre'>Création de compte Utilisateur</h1></center><br><br>
        
		<?php
        require "../general/connexionPostgreSQL.class.php";
        
        $login = $_POST["login"];
        $mdp = $_POST["mot_de_passe"];
        $nom = $_POST["nom"];
        $type = $_POST["rb"];
        $adresse = $_POST["adresse"];
        $adresse2 = $_POST["adresse2"];
        $commune = pg_escape_string($_POST["commu"]);
        $cp = $_POST["code_postal"];
        //$departement = $_POST["departement"];
        $tel = $_POST["telephone"];
        $mail = $_POST["mail"];
		$exploit = pg_escape_string(strtoupper($_POST["nom_exploit"]));

        $connex = new connexionPostgreSQL();

		// Exécution de la requête SQL
		
        if($type == eleveur){
			$result = $connex->requete("INSERT INTO compte_utilisateur (id_type_utilisateur, id_commune, identifiant, mdp, nom, portable, mail, adresse, adresse2, nom_exploitation) VALUES ( (SELECT id_type_utilisateur FROM type_utilisateur WHERE libelle_type_utilisateur='$type'), (SELECT id_commune FROM commune WHERE nom_commune='$commune'),'$login', '$mdp', '$nom', '$tel', '$mail', '$adresse','$adresse2', '$exploit')");
		}
		else{
			$result = $connex->requete("INSERT INTO compte_utilisateur (id_type_utilisateur, id_commune, identifiant, mdp, nom, portable, mail, adresse, adresse2) VALUES ( (SELECT id_type_utilisateur FROM type_utilisateur WHERE libelle_type_utilisateur='$type'), (SELECT id_commune FROM commune WHERE nom_commune='$commune'),'$login', '$mdp', '$nom', '$tel', '$mail', '$adresse','$adresse2')");
		}
		
		echo "<br><br><div align='center'><h1>Votre compte a bien été créé</div><br>";

		pg_free_result($result);

		// Ferme la connexion

			$connex->fermer();
		?>
		<div class="center">
		<form action='compte_utilisateur_front.php' method='GET' name='form_retour_liste'>
			<input type='submit' name='bt_retour' value='Créer un autre compte' class="btn bouton-sonnaille bouton-m">
		</form> 
        </div>
    </div>
    <?php include('../general/front/footer.html');?>
</body>
</html>