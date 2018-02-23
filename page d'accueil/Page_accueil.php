<?php session_start();?>
<html>
<head>
    <META charset="UTF-8">
    <title>Connexion</title>
    <script type="text/javascript" src="javascript.js" language="javascript"></script>
    <style>
        .box {
            float: left;
            width: 200px;
            height: 100px;
            margin: 1em; 
            background-color: aquamarine;
        }
    </style>
</head>
<body>    
    <?php 
        //Vérification de l'existance du compte
        $nom = $_POST["identifiant"];
        $mdp = $_POST["mdp"];
        require "../general/connexionPostgreSQL.class.php";
        $connex = new connexionPostgreSQL();
        $result = $connex->requete("SELECT * FROM compte_utilisateur where identifiant='".$nom."' and mdp='".$mdp."'");
        

        // tableau de vérification de la requête
       /* echo "<table border=1 bordorcolor=black>";
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
        echo "</table>";*/
    
        
        
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
            while ($row=pg_fetch_array($result,null,PGSQL_NUM)){
                $_SESSION["id_compte"]=$row[0];
                $_SESSION["id_type_utilisateur"]=$row[1];
            }
            ?>
    
    <div class='box'>
        <p>image</p>
        <a href='../carte/test1.php'>Voir la carte des zones tampons</a>
    </div>
    <div class='box'>
        <p>image</p>
        <a href='../diagnostic/diagnostic_v1.php'>saisir un diagnostic</a>
    </div>
    <div class='box'>
        <p>image</p>
        <a>Documents</a>
    </div>
    <div class='box'>
        <p>image</p>
        <a href='../prophylaxie/README.md'>Voir la carte des zones tampons</a>
    </div>
    <div class='box'>
        <p>image</p>
        <a href='../transhumance/transhumance.php'>Déclarer une transhumance</a>
    </div>
    <div class='box'>
        <p>image</p>
        <a href='../transhumance/liste_transhumance.php'>Liste transhumances</a>
    </div>
    <div class='box'>
        <p>image</p>
        <a href='../zone_tampon/README.md'>Liste des zones tampons</a>
    </div>
    
            
            
            
     <?php   }
    ?>
    

    
    <button onclick="self.location.href='Connexion.php'">Retour</button>
</body>
</html>