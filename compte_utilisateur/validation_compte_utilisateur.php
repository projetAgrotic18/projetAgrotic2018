<html>
	<head>
	</head>
	<body>
		<?php
        
        require "../general/connexionPostgreSQL.class.php";
        
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
        
        $result = $connex->requete("INSERT INTO compte_utilisateur (id_type_utilisateur, id_commune, identifiant, mdp, nom, portable, mail, adresse, adresse2) VALUES ( (SELECT id_type_utilisateur FROM type_utilisateur WHERE libelle_type_utilisateur='$type'), (SELECT id_commune FROM commune WHERE nom_commune='$commune'),'$login', '$mdp', '$nom', '$tel', '$mail', '$adresse','$adresse2')");


		    echo "Votre compte a bien été créé";

			pg_free_result($result);

		// Ferme la connexion

			$connex->fermer();
		?>
		
		<form action='compte_utilisateur.php' method='GET' name='form_retour_liste'>
			<input type='submit' name='bt_retour' value='Retour'>
		</form> 
	</body>
</html>