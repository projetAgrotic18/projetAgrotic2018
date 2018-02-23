<html>
    <body>   
    
    <?php
        require "../general/connexionPostgreSQL.class.php";
        
        $connex = new connexionPostgreSQL();
    
        //Récupération de toutes les info
        $compte=$_GET["id_compte"];
        
        //Requête
        $result = $connex->requete("DELETE FROM compte_utilisateur WHERE id_compte='$compte'");
        echo "La suppression a bien été prise en en compte. <br/><br/>";
  
           // Ferme la connexion

        pg_close($connex);                 
    ?>
    <form action='liste_comptes.php' method='GET' name='form_retour_liste'>
        <input type='submit' name='bt_retour' value='Retour'>
    </form> 
    </body>
</html>