<?php session_start();?>
<html>
<head>
    <META charset="UTF-8">
    <title>Connexion</title>
    <script type="text/javascript" src="javascript.js" language="javascript"></script>
</head>
<body>    
    <?php 
        //Récupération des infos page précédente
        $nom=$_GET["nom"];
        $mdp=$_GET["mdp"];
        
        //Vérification de l'existance du compte
        require "../general/connexionPostgreSQL.class.php";
        $connex = new connexionPostgreSQL();
        $result = $connex->requete("SELECT * FROM comptes_utilisateurs where login='".$nom."' and mot_de_passe='".$mdp."'");
    

        // tableau de vérification de la requête
        echo "<table border=1 bordorcolor=black>";
        while ($row=pg_fetch_array($result,null,PGSQL_NUM)) {
            echo "<th>";
            for($i=1; $i<pg_num_fields($result); $i++){
                echo "<td>";
                echo pg_field_name($result, $i)."</td>";  
            }
            echo "</th>";
            echo "<tr>";
            for($i=0; $i<pg_num_fields($result); $i++){
                echo "<td>".$row[$i]."</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    
        
        
        //Si compte existe pas --> message d'erreur
        if (pg_num_rows($result)==0){
            echo "<center><h1>Nom du site</h1></center><br><br><br>";
            echo "<h2>Erreur</h2>";
            echo "<p>Votre login ou votre mot de passe est incorrect</p><br/>";
            
        }
    
        //Si compte existe  --> page d'accueil + ouverture d'une session 
        else {
            echo "<center><h1>Bienvenue sur le site</h1></center><br><br><br>";
            echo "<h2>Page d'acceuil</h2>";
            $_SESSION['id_compte']=$id;
        }
            
    

        
    ?>
    

    
    <button onclick="self.location.href='Connexion.php'">Retour</button>
</body>
</html>