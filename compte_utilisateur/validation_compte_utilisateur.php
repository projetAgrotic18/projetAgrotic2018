<html>
	<head>
	</head>
	<body>
		<?php
        
        $login = $_POST["login"];
        $mdp = $_POST["mot_de_passe"];
        $nom = $_POST["nom"];
        $type = $_POST["rb"];
        $adresse = $_POST["adresse"];
        $adresse2 = $_POST["adresse2"]
        $commune = $_POST["commune"];
        $cp = $_POST["code_postal"];
        //$departement = $_POST["departement"];
        $tel = $_POST["telephone"];
        $mail = $_POST["mail"];
        // Connexion, sélection de la base de données

            $dbconn = pg_connect("host=194.199.251.139 port=5433 dbname=testprojet user=postgres password=postgres")
				or die('Connexion impossible : ' . pg_last_error());

		// Exécution de la requête SQL

			$query = 'INSERT INTO compte_utilisateurs(id_compte, (SELECT id_compte_utilisateur FROM compte_utilisateur WHERE libelle_type_utilisateur=$type), (SELECT id_commune FROM commune WHERE code_postal=$cp), identifiant, mdp, nom, portable, mail, adresse, adresse2) VALUES('', '', '','$login', '$mdp', '$nom', '$tel', '$mail', '$adresse','$adresse2')';
			$result = pg_query($query) or die('Échec de la requête : ' . pg_last_error());

		    echo "Votre compte a bien été créé";

			pg_free_result($result);

		// Ferme la connexion

			pg_close($dbconn);
		?>
	</body>
</html>