<html>
	<head>
	</head>
	<body>
		<?php
        
        $login = $_POST["identifiant"];
        $mdp = $_POST["mot_de_passe"];
        $nom = $_POST["nom"];
        $type = $_POST["rb"];
        $adresse = $_POST["adresse"];
        $commune = $_POST["commune"];
        $cp = $_POST["code_postal"];
        $departement = $_POST["departement"];
        $tel = $_POST["telephone"];
        $mail = $_POST["mail"];
        // Connexion, sélection de la base de données

            $dbconn = pg_connect("host=194.199.251.139 port=5433 dbname=testprojet user=postgres password=postgres")
				or die('Connexion impossible : ' . pg_last_error());

		// Exécution de la requête SQL

			$query = 'INSERT INTO comptes_utilisateurs(login, mot_de_passe, nom, tel, adresse) VALUES('$login', '$mdp', '$nom', '$type','$tel','$adresse')';
            $query2 = 'INSERT INTO type_utilisateur(libelle_type_utilisateur) VALUES('$type')'
            $query3 = 'INSERT INTO departements(libelle_dep) VALUES('$departement')';
            $query4 = 'INSERT INTO communes(nom_commune, code_postal) VALUES('$commune','$cp')';
			$result = pg_query($query) or die('Échec de la requête : ' . pg_last_error());

		    echo "Votre compte a bien été créé";

			pg_free_result($result);

		// Ferme la connexion

			pg_close($dbconn);
		?>
	</body>
</html>