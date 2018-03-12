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
        <center><h1 class='sonnaille_titre'>Suppression de compte Utilisateur</h1></center><br><br>
        
        <?php
            require "../general/connexionPostgreSQL.class.php";

            $connex = new connexionPostgreSQL();

            //Récupération de toutes les info
            $compte=$_GET["id_compte"];

            //Requête
            $result = $connex->requete("DELETE FROM compte_utilisateur WHERE id_compte='$compte'");
            echo "La suppression a bien été prise en en compte. <br/><br/>";

               // Ferme la connexion

            $connex->fermer();                 
        ?>
        <form action='liste_comptes.php' method='GET' name='form_retour_liste'>
            <input type='submit' name='bt_retour' value='Retour'>
        </form> 
</body>
</html>