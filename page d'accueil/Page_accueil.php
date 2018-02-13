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
        $result = $connex->requete("SELECT * FROM comptes_utilisateurs where login='$nom' and mot_de_passe=$mdp");
    


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
            
        }
        //Si compte existe  --> page d'accueil + ouverture d'une session 
            $_SESSION['id_compte']=$id;
    

        
    ?>
    
    
<center><h1>Bienvenue sur le site</h1></center><br>
    <br><br>
    
    
    <button onclick="self.location.href='Exo.php'">Retour</button>
</body>
</html>