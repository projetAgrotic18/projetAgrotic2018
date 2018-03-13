<?php session_start() ?>
<html>
<head>
	<title>Confirmation de saisie d'un diagnostic</title>
    <META charset="UTF-8"/>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

    <!--- Style Sonnaille -->
    <link href="../general/front/style.css" rel="stylesheet">
</head>
<body>
	<!-- Barre de navigation en fonction de l'utilisateur -->
    <?php include('../general/switchbar.php'); ?>
    
    <div class="padding">   
        <h1>Consultation d'un diagnostic</h1><br>
        <?php
        require "../general/connexionPostgreSQL.class.php";
        $connex = new connexionPostgreSQL();

            $id_compte_utilisateur=$_SESSION['id_type_utilisateur'];
        //A partir de l'id_diagnostic de la liste des diagnostics, on peut réussir à visualiser la totalité du diagnostic
        $id_diagnostic=$_GET["id_diagnostic"];
        
        echo "<h2>Caractéristiques générales :</h2>";

        echo "<U>Nom de l'exploitant</U> :<br/>";	
        //Récupération du nom de l'exploitant à partir de l'id_diagnostic :
        // id de l'éleveur : id_compte de diagnostic
        $result= $connex->requete("SELECT c.nom FROM compte_utilisateur c JOIN diagnostic d ON c.id_compte=d.id_compte WHERE d.id_diagnostic='".$id_diagnostic."'");
        while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
            echo $row[0]."<br/>";
        }
        echo "<br/>";

        echo "<U>Nom de l'exploitation</U> :<br/>";	
        //Récupération du nom de l'exploitation à partir de l'id_diagnostic :
        $result= $connex->requete("SELECT c.nom_exploitation FROM compte_utilisateur c JOIN diagnostic d ON c.id_compte=d.id_compte WHERE d.id_diagnostic='".$id_diagnostic."'");
        while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
            echo $row[0]."<br/>";
        }
        echo "<br/>";

        echo "<U>Nom du vétérinaire</U> :<br/>";	
        //Récupération du nom du vétérinaire à partir de l'id_diagnostic :
        // id du véto : com_id_compte de diagnostic
        $result= $connex->requete("SELECT c.nom FROM compte_utilisateur c JOIN diagnostic d ON c.id_compte=d.com_id_compte WHERE d.id_diagnostic='".$id_diagnostic."'");
        while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
            echo $row[0]."<br/>";
        }
        echo "<br/>";

        //Récupération de la commune à partir de l'id_diagnostic : 
        echo "<U>Commune du diagnostic</U> :<br/>";	
        $result= $connex->requete("SELECT c.nom_commune FROM commune c JOIN diagnostic d ON c.id_commune=d.id_commune WHERE d.id_diagnostic='".$id_diagnostic."'");
        while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
            echo $row[0]."<br/>";
        }
        echo "<br/>";

        //Récupération de la date à partir de l'id_diagnostic : 
        echo  "<U>Date du diagnostic</U> :<br/>";	
        $result= $connex->requete("SELECT date_diagnostic FROM diagnostic WHERE id_diagnostic='".$id_diagnostic."'");
        while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
            echo $row[0]."<br/>";
        }
        echo "<br/>";

        //Récupération de l'espèce à partir de l'id_diagnostic : 
        echo "<h2>Caractéristiques du diagnostic :</h2>";
        echo  "<U>Espèce</U> :<br/>";	
        $result= $connex->requete("SELECT e.libelle_espece FROM espece e JOIN diagnostic d ON e.id_espece=d.id_espece WHERE d.id_diagnostic='".$id_diagnostic."'");
        while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
            echo $row[0]."<br/>";
        }
        echo "<br/>";

        //Récupération des symptomes à partir de l'id_diagnostic : 
        echo "<U>Symptomes</U> :<br/>";		
        $result= $connex->requete("SELECT s.libelle_symptome FROM symp s JOIN symptdiag sd ON s.id_sympt=sd.id_sympt WHERE sd.id_diagnostic='".$id_diagnostic."'");
        while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
            echo $row[0]."<br/>";
        }
        echo "<br/>";

        //Récupération des maladies à partir de l'id_diagnostic : 

        ?>

        <?php 
            if($id_compte_utilisateur==1){
                echo "<U>Maladies possibles</U> :<br/>";
        $result= $connex->requete("SELECT m.libelle_maladie, md.confirme FROM maladie m JOIN maladie_diag md ON m.id_maladie=md.id_maladie WHERE md.id_diagnostic='".$id_diagnostic."'");
        while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
            echo $row[0];
            if ($row[1]=='t'){
                echo "    (état : vous l'avez confirmée)";
            }else{
                echo "    (état : vous ne l'avez pas confirmée)";
            }
            echo "</br>";
        }
        echo "</br>";
            echo "<a href ='modif_diagnostic.php?id_diagnostic=$id_diagnostic'><button type='button'>Confirmer une maladie</button></a></br></br>";
            }else if($id_compte_utilisateur==5){
                 echo "<form action='modif_diagnostic_labo.php' method='POST'>";
                echo "<br/>Laisser une remarque sur les echantillons:<br/><textarea rows='5' id='remarq_labo' name='comm_labo'></textarea><br/><br/>";
                 echo "<a><input type='Submit' value='Valider' \></a></br></br>";
                 echo "<input type='hidden' value='$id_diagnostic' name='id_diagnostic'>";
                echo "</form>";
            }
                    ?>
        <?php

        //Récupération des prélèvements à partir de l'id_diagnostic : 
        echo "<U>Prélèvements</U> :<br/>";	
        $result= $connex->requete("SELECT p.libelle_prelevement FROM prelev p JOIN prelevement_diag pd ON p.id_prele=pd.id_prele WHERE pd.id_diagnostic='".$id_diagnostic."'");
        while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
            echo $row[0]."<br/>";
        }
        echo "<br/>";

        //Récupération des analyses à partir de l'id_diagnostic : 
        echo "<U>Analyses</U> :<br/>";	
        $result= $connex->requete('SELECT a.libelle_analyse FROM "ANALYSE" a JOIN analyses_diag ad ON a.id_analyse=ad.id_analyse WHERE ad.id_diagnostic='.$id_diagnostic.'');
        while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
            echo $row[0]."<br/>";
        }
        echo "<br/>";

        //Récupération des préconisations à partir de l'id_diagnostic : 
        echo "<U>Préconisations</U> :<br/>";	
        $result= $connex->requete('SELECT preconisation FROM diagnostic WHERE id_diagnostic='.$id_diagnostic.'');
        while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
            echo $row[0]."<br/>";
        }
        echo "<br/>";	
        ?>

        <a href = "liste_diagnostic.php">
                <?php
                if($id_compte_utilisateur==1){
                echo "<button type='button'>Retourner à la liste de mes diagnostics</button>";
                } else if($id_compte_utilisateur==5){
                    echo "<button type='button'>Retourner à la liste des diagnostics</button>";
                }
                    ?>
        </a>
    </div>
    <?php include('../general/front/footer.html');?>
</body>
</html>
