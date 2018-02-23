<html>
	<head>
		<META charset="UTF-8">
	</head>
	<body>
    <?php
    // Connexion, sélection de la base de données
        
        require "../general/connexionPostgreSQL.class.php";

        $connex = new connexionPostgreSQL();

    // Exécution de la requête SQL
        
        $result = $connex->requete("SELECT cu.id_compte, cu.identifiant, tu.libelle_type_utilisateur FROM type_utilisateur tu JOIN compte_utilisateur cu ON tu.id_type_utilisateur=cu.id_type_utilisateur");
        
    // Affichage des résultats en HTML

        echo "<table><tr><th>Utilisateur</th><th>Type d'utilisateur</th><th>  </th></tr>";
        while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
            $id = $row[0];
            $identifiant = $row[1];
            $type = $row[2];
            echo "<td>".$identifiant."</td><td>".$type."</td><td><a href='valid_suppr.php?id_compte=".$id."'><img src='suppr.png' alt='supprimer'/></a></td></tr>";
        }
        echo "</tr></table>";

    // Libère le résultat

        pg_free_result($result);

    // Ferme la connexion

        pg_close($connex);
    ?>

    </body>
</html>