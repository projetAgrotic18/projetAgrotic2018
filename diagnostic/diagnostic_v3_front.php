<?php session_start() ?>
<html>
	<head>
	<META charset="UTF-8">
	<script src="https://code.jquery.com/jquery-3.3.1.min.js">
	</script>
      
    <title> Déclaration de Diagnostic </title>
    <link rel="icon" href="sonnaille.ico">
        
    <!-- Load CSS--->
    <!--- Style Sonnaille-->
    <LINK rel="stylesheet" type="text/css" href="style.css">
    <!--- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        
	<!-- Section Javascript: définition de la fonction gérant la récupération des données -->
	<script type="text/javascript">
		
	var ok =1;
	var msg = "Veuillez saisir les informations suivantes :";
	function valider(){
		if (document.formsaisie.nom_exploitant.value == "") 	
		{
			ok = 0;
			msg = msg + "\n[Nom de l'exploitant] \n";
		}	
		if (document.formsaisie.date.value == "")
		{
			ok = 0;
			msg = msg + "[Date]";
		}
		if (document.formsaisie.commune.value == "")
		{
			ok = 0;
			msg = msg + "[Lieu du diagnostic]";
		}
		if (document.formsaisie.espece.value == "")
		{
			ok = 0;
			msg = msg + "[Espèce]";
		}
		if (ok !=1)
		{
			alert(msg);
			return false;
		}
	}
	
	function actu_maladie(liste){
		$.ajax({
			type: 'get', 
			url: 'diagnostic_v3b.php',
			data: {
				porygon:liste
			},
			success: function (response){
					document.getElementById("actuFormulaire").innerHTML=response;
			}
		});
	}
	
	</script>

	</head>
        
	<body>
    <?php include ("../general/Front/navigation_veto.html"); ?>
        
	<form method="GET" action="diagnostic_v3_2.php" onsubmit="return valider()" name="formsaisie">
	
	<h1 class="sonnaille_titre">Diagnostic vétérinaire</h1>
	<div class="padding">(*) : champs obligatoires <br/></div>	
	
	<!--Caractéristiques-->
        
    <div class="fond_gris">
        <div class="padding">
           <h2>Caractéristiques générales :</h2>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputNom">(*) Nom de l'exploitant</label>
                        <input type='text' name='nom_exploitant' class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputNom">(*) Nom de l'exploitation</label>
                        <input type='text' name='nom_exploitation' class="form-control">
                    </div>
                </div>
            <!--

            <!-- A mettre en autocomplétion en fonction du nom de l'exploitant -->
            <!-- Si homonymes, une liste de suggestion des noms d'exploitation des homonymes sera fournie -->
            <div class="form-group col-md-6">
                <div class="form-row">
                    <label for="inputcommune">(*) Commune</label>
                    <input type="text" name="commune" class="form-control"><br/>
                </div>
            </div>

            <!-- Champ autocomplété quand les 2 champs "nom exploitant" et "nom exploitation" sont remplis -->
            <div class="form-group col-md-6">
                <div class="form-row">
                    <label for="inputDate">(*) Date du diagnostic</label>
                    <input type="date" name="date" class="form-control">
                </div>
            </div>

        <!-- La date du jour est récupérée sur l'ordi -->
        </div>
        </div>
        
	<div class="padding">
        
        <h2>Caractéristiques du diagnostic :</h2>
        * Espèce : <br/>
        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" id="customRadioInline1" name="espece" class="custom-control-input" value="1">
          <label class="custom-control-label" for="customRadioInline1">Bovin</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" id="customRadioInline2" name="espece" class="custom-control-input" value="2">
          <label class="custom-control-label" for="customRadioInline2">Ovin</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" id="customRadioInline3" name="espece" class="custom-control-input" value="3">
          <label class="custom-control-label" for="customRadioInline3">Caprin</label>
        </div>
        <br>

        <?php
        require "../general/connexionPostgreSQL.class.php";
        $connex = new connexionPostgreSQL();	

        // Récupération de l'id du compte_utilisateur vétérinaire connecté à l'outil
        $_SESSION["id_veto"]=7;
        
        $_SESSION["choix_symptome"]=array();
        
        //Symptomes : 
        echo "<br/>Symptomes : <br/>";
        echo "<select class='custom-select' multiple>  <option selected>Sélectionnez les symptomes</option>";
        $result = $connex->requete("SELECT symp.id_sympt, symp.libelle_symptome FROM symp");
        while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
            echo "<option value=".$row[0].">".$row[1]."</option>";
        }
        echo "</select>";
        echo "<br/>";
        
        
        //Maladies :
        echo "<br/>Maladies : <br/>";
        echo "<select class='custom-select' multiple>  <option selected>Sélectionnez les maladies</option>";
        $result = $connex->requete("SELECT maladie.id_maladie, libelle_maladie FROM maladie");
        while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
            echo "<option value=".$row[0].">".$row[1]."</option></br>";
        }
        echo "</select>";
        echo "</span>";
        echo "<br>";
        
        //Prélèvements :
        echo "<br/>Prélèvements : <br/>";
        echo "<select class='custom-select' multiple>  <option selected>Sélectionnez les prélèvements</option>";
        $result = $connex->requete("SELECT id_prele, libelle_prelevement FROM prelev");
        while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
            echo "<option value=".$row[0].">".$row[1]."</option></br>";
        }
        echo "</select>";
        echo "<br/>";

        //Analyses :
        echo "<br/>Analyses : <br/>";
        echo "<select class='custom-select' multiple>  <option selected>Sélectionnez les analyses</option>";
        $result2 = $connex->requete('SELECT id_analyse, libelle_analyse FROM "ANALYSE"');
        while ($row = pg_fetch_array($result2, null, PGSQL_NUM)) {
            echo "<option value=".$row[0].">".$row[1]."</option><br/>";
        }
        echo "</select>";
        echo "<br/>";
        ?>
        <br>
        <div class="form-group">
          <label for="preconisation">Préconisations :</label>
          <textarea class="form-control" rows="5" id="preconisations"></textarea>
        </div>

        <div class="center">
            <input type="submit" class="btn bouton-sonnaille bouton-m" value="Ajouter ce diagnostic">
        </div>
    </div>
	</form>
	</body>
    <?php include ("../general/Front/footer.html"); ?>
</html>
