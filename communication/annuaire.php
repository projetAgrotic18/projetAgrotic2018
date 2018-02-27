<?php
include("../general/procedures.php");
?>
<html>
    <head>
        <title>Annuaire</title>
		<META charset="UTF-8"/>
		<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/themes/smoothness/jquery-ui.css" />
        
         <script type="text/javascript" src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
       
    </head>
    <body>
        <?php
			require "../general/connexionPostgreSQL.class.php";
            // Connexion, sélection de la base de données du projet

            $connex = new connexionPostgreSQL();
	
            // Exécution de la requête SQL

            $result =  $connex->requete("SELECT libelle_type_utilisateur AS Type, nom AS Nom, portable AS Telephone,
            								mail AS Email FROM compte_utilisateur cu JOIN type_utilisateur tu 
            								ON cu.id_type_utilisateur=tu.id_type_utilisateur");
            
            $nbre_col = pg_num_fields($result);
            $id = 1;

           	Creer_Tab($result);
		
		?>
	</body>
</html>