<html>
	<head>
		<META charset="UTF-8"/>
        <link rel="stylesheet" href='../general/front/style.css'>    
	</head>
	<body>
	<script>
		function confirm_s(id){
			if(confirm("Voulez vous vraiment supprimer ce compte ?")){
				window.location='valid_suppr.php?id_compte='+id
			}
			else{
				alert("Le ompte utilisateur n'a pas été supprimé.")
				window.location='liste_comptes.php'
			}
}
	</script>
    
    <?php
        include('../general/front/navigation.html');
        echo "<center><h1>Comptes utilisateurs</h1></center><br><br>";
        echo "<h2>Liste des comptes</h2><br><br>";
        
    // Connexion, sélection de la base de données
        
        require "../general/connexionPostgreSQL.class.php";

        $connex = new connexionPostgreSQL();

    // Exécution de la requête SQL
        
        $result = $connex->requete("SELECT cu.id_compte, cu.identifiant, tu.libelle_type_utilisateur FROM type_utilisateur tu JOIN compte_utilisateur cu ON tu.id_type_utilisateur=cu.id_type_utilisateur GROUP BY tu.libelle_type_utilisateur, cu.id_compte ORDER BY tu.libelle_type_utilisateur, cu.identifiant");
        
    // Affichage des résultats en HTML

        echo "<table><tr><th>Utilisateur</th><th>Type d'utilisateur</th><th>  </th></tr>";
        while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
            $id = $row[0];
            $identifiant = $row[1];
            $type = $row[2];
            echo "<td>".$identifiant."</td><td>".$type."</td><td><img src='suppr.png' alt='supprimer' onclick='confirm_s($id)'/></a></td></tr>";
        }
        echo "</tr></table>";

    // Libère le résultat

        pg_free_result($result);

    // Ferme la connexion

        $connex->fermer();
		
		//<a href='valid_suppr.php?id_compte=".$id."'>
        echo "<br><br><br>";
        include('../general/front/footer.html');?>
    

    </body>
</html>