<?php session_start();?>
<?php
     
    $nom = $_POST["login"];
    $mdp = $_POST["mdp"];

    //Vérification de l'existance du compte
    require "../general/connexionPostgreSQL.class.php";
    $connex = new connexionPostgreSQL();
    $result = $connex->requete("SELECT * FROM compte_utilisateur where identifiant='".$nom."' and mdp='".$mdp."'");

    //Si compte existe pas --> message d'erreur
    if (pg_num_rows($result)==0){
        echo "Failed";
    }

    //Si compte existe  --> page d'accueil + ouverture d'une session 
    else {
        while ($row=pg_fetch_array($result,null,PGSQL_NUM)){
                $_SESSION["id_compte"]=$row[0];
                $_SESSION["id_type_utilisateur"]=$row[1];
            }
        echo "Success";
    }
?>