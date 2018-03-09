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
        <h1>Modification et validation de maladie(s)</h1><br>
    
        <form method="GET" action="modif_diagnostic_validation.php" name="formsaisie">
        <?php
        require "../general/connexionPostgreSQL.class.php";
        $connex = new connexionPostgreSQL();

        //A partir de l'id_diagnostic de la liste des diagnostics, on peut réussir à visualiser la totalité du diagnostic
        $id_diagnostic=$_GET["id_diagnostic"];

        //SEULE PARTIE MODIFIABLE : 
        //Récupération des maladies à partir de l'id_diagnostic : 
        //echo "<h5>Maladies possibles :</h5>";
        $result= $connex->requete("SELECT m.libelle_maladie FROM maladie m JOIN maladie_diag md ON m.id_maladie=md.id_maladie WHERE md.id_diagnostic='".$id_diagnostic."'");
        echo "<h5>Vous aviez sélectionné cette (ces) maladie(s) :</h5>";
        while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
            echo $row[0]."<br/>";
        }

        //A sélectionner de nouveau :
        echo "<br/><br/><h5>Vous pouvez confirmer ou modifier la ou les maladie(s) associée(s) au diagnostic : </h5>";
        echo "Attention : ces choix seront considérés comme définitifs.<br/><br/>";
        $result = $connex->requete("SELECT id_maladie, libelle_maladie FROM maladie ORDER BY libelle_maladie");
        while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
            echo "<input type=checkbox name='maladies[]' value=".$row[0].">".$row[1]."<br/>";
        }
        echo "<br/>";
        echo "<input type='hidden' name='id_diagnostic' value='$id_diagnostic'/>";
        ?>

        <input type="submit" value="Confirmer">
        </form>

        <a href = "consultation_diagnostic.php">
        <button type="button">Annuler la modification</button>
        </a>
	</div>
    <?php include('../general/front/footer.html');?>
</body>
</html>
