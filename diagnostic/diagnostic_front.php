<?php session_start() ?>
<html>
	<head>
	<META charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/themes/smoothness/jquery-ui.css" />
	<script src="https://code.jquery.com/jquery-3.3.1.min.js">
	</script>
    
    <title> Déclaration de Diagnostic </title>
    <link rel="icon" href="sonnaille.ico">
        
    <!-- Load CSS--->
    <!--- Style Sonnaille-->
    <LINK rel="stylesheet" type="text/css" href="style.css">
    <!--- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        

	<!-- Section Javascript: vérification de l'entrée des champs obligatoires, définition des fonctions -->
	<script type="text/javascript">
	
	function actu_maladie(sympt_check){
		$.ajax({
			type: 'get', 
			url: 'diagnostic_liste_mala.php',
			data: {
				sympt_check:sympt_check
			},
			success: function (response){
					document.getElementById("actuFormulaire_maladie").innerHTML=response;
			}
		});
	}
	
	function actu_prelevement(mala_check){
		$.ajax({
			type: 'get', 
			url: 'diagnostic_liste_prelev.php',
			data: {
				mala_check:mala_check
			},
			success: function (response){
					document.getElementById("actuFormulaire_prelevement").innerHTML=response;
			}
		});
	}
	
	function actu_analyse(prele_check){
		$.ajax({
			type: 'get', 
			url: 'diagnostic_liste_ana.php',
			data: {
				prele_check:prele_check
			},
			success: function (response){
					document.getElementById("actuFormulaire_analyse").innerHTML=response;
			}
		});
	}
		
	</script>
  
	</head>
	<body> 
    <?php include ("../general/Front/navigation_veto.html"); ?>
	<form method="GET" action="diagnostic_2.php" onsubmit="return valider()" name="formsaisie">
	
	<h1 class="sonnaille_titre">Diagnostic vétérinaire</h1>
	<div class="padding">(*) : champs obligatoires <br/></div>
	
	<!--Caractéristiques-->
    <div class="fond_gris">
        <div class="padding">
           <h2>Caractéristiques générales :</h2>
                <div class="form-group col-md-6">
					<div class="form-row">
                        <label for="inputNom">(*) Nom de l'exploitant</label>
                        <input type='text' id='nom' name='nom' class="form-control">
						<input type='hidden' id='id_compte'>
                    </div>
                </div>
   
        
	<!-- Champ autocomplété quand les 2 champs "nom exploitant" et "nom exploitation" sont remplis -->
            <!-- Si homonymes, une liste de suggestion des noms d'exploitation des homonymes sera fournie -->
            <div class="form-group col-md-6">
                <div class="form-row">
                    <label for="inputcommune">(*) Commune</label>
                    <input type="text" id='commune' name="commune" class="form-control"><br/>
					<input type='hidden' id='commune_id'>
                </div>
            </div>

            <!-- Champ autocomplété quand les 2 champs "nom exploitant" et "nom exploitation" sont remplis -->
            <div class="form-group col-md-6">
                <div class="form-row">
                    <label for="inputDate">(*) Date du diagnostic</label>
                    <input type="date" id='date' name="date" class="form-control">
                </div>
            </div>

        <!-- La date du jour est récupérée sur l'ordi -->
        </div>
        </div>
	
	<div class="padding">
        
        <h2>Caractéristiques du diagnostic :</h2>
        (*) Espèce : <br/>
        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" id="customRadioInline1" id='espece' name="espece" class="custom-control-input" value="1">
          <label class="custom-control-label" for="customRadioInline1">Bovin</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" id="customRadioInline2" id='espece' name="espece" class="custom-control-input" value="2">
          <label class="custom-control-label" for="customRadioInline2">Ovin</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" id="customRadioInline3" id='espece' name="espece" class="custom-control-input" value="3">
          <label class="custom-control-label" for="customRadioInline3">Caprin</label>
        </div>
        <br>
	<!--<span id="symptome"></id>-->

	<?php
	require "../general/connexionPostgreSQL.class.php";
	$connex = new connexionPostgreSQL();
	
	// Récupération de l'id du compte_utilisateur vétérinaire connecté à l'outil
	$_SESSION["id_veto"]=7;
	
	$_SESSION["choix_symptomes"]=array();
	$_SESSION["choix_maladies"]=array();
	$_SESSION["choix_prelevements"]=array();
	
	//Symptomes : 
	echo "<br/>Symptomes : <br/>";	
	$result = $connex->requete("SELECT id_sympt, libelle_symptome FROM symp ORDER BY libelle_symptome");
	while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
		echo "<input type=checkbox name='symptome[]' onclick='actu_maladie(this.value)' value=".$row[0].">".$row[1]."<br/>";
	}
	echo "<span id='actuFormulaire_maladie'></id>";

	//Maladies :
	echo "<br/>Maladies possibles : <br/>";
	$result = $connex->requete("SELECT id_maladie, libelle_maladie FROM maladie ORDER BY libelle_maladie");
	while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
		echo "<input type=checkbox name='maladie[]' onclick='actu_prelevement(this.value)' value=".$row[0].">".$row[1]."<br/>";
	}
	echo "</span>";
	echo "<span id='actuFormulaire_prelevement'></id>";
	
	//Prélèvements :
	echo "<br/>Prélèvements : <br/>";
	$result = $connex->requete("SELECT id_prele, libelle_prelevement FROM prelev ORDER BY libelle_prelevement");
	while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
		echo "<input type=checkbox name='prelevement[]' onclick='actu_analyse(this.value)' value=".$row[0].">".$row[1]."<br/>";
	}
	echo "</span>";
	echo "<span id='actuFormulaire_analyse'></id>";
	
	//Analyses :
	echo "<br/>Analyses : <br/>";
	$result2 = $connex->requete('SELECT id_analyse, libelle_analyse FROM "ANALYSE" ORDER BY libelle_analyse');
	while ($row = pg_fetch_array($result2, null, PGSQL_NUM)) {
		echo "<input type=checkbox name='analyse[]' value=".$row[0].">".$row[1]."<br/>";
	}
	echo "<br/>";
	echo "</span>";
    
	//Commune (gestion de l'autocomplétion) : 
    $rqt="SELECT nom_commune,code_postal FROM commune";
    $result2 = $connex->requete($rqt);// requête SQL grâce au mot-clé
    $array = array(); // création du tableau

    while ($row = pg_fetch_array($result2)){   // boucle pour obtenir toutes les données
		array_push($array,array('value'=>$row[0],'label'=>$row[0],'desc'=>$row[1]));
    }  

	//Nom exploitant(gestion de l'autocomplétion) : 
    $rqt3="SELECT nom, nom_exploitation FROM compte_utilisateur WHERE id_type_utilisateur='2'";
    $result3 = $connex->requete($rqt3);// requête SQL grâce au mot-clé
    $array3 = array(); // création du tableau

    while ($row = pg_fetch_array($result3)){   // boucle pour obtenir toutes les données
		array_push($array3,array('value'=>$row[0],'label'=>$row[0],'desc'=>$row[1]));
    }  

    $connex->fermer();
	?>
	
    <div class="form-group">
        <label for="preconisation"><br/>Préconisations :</label>
        <textarea class="form-control" rows="5" id="preconisations"></textarea>
    </div>
	<div class="center">	
	<input type="submit" class="btn bouton-sonnaille bouton-m" value="Ajouter ce diagnostic">
        </div>
	</form>
                
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>     
    <script type="text/javascript"> 
	var liste= <?php echo json_encode($array);?>;
			$(function () {      
			$('#commune').autocomplete({ //apres le #
					source : liste,  //a definir( c'est un fichier php)  
					focus: function( event, ui ) {
					$( "#commune" ).val( ui.item.label );
					return false;
			},
                //minLength : 1 // on indique qu'il faut taper au moins 2 caract?res pour afficher l'autocompl?t
    select : function(event, ui){ // lors de la sélection d'une proposition
			$( '#commune' ).val( ui.item.label);     
			$('#commune_id').val(ui.item.value);
			$('#description').html( ui.item.desc );// on ajoute la description de l'objet dans un bloc
			return false;
            }
          })
          .autocomplete( "instance" )._renderItem = function( ul, item ) {
            return $( "<li>" )
              .append( "<div>" + item.label + "(" + item.desc + ") </div>" )
              .appendTo( ul );
          };
        } );    
		
	var liste2= <?php echo json_encode($array3);?>;
			$(function () {      
			$('#nom').autocomplete({ //apres le #
					source : liste2,  //a definir( c'est un fichier php)  
					focus: function( event, ui ) {
					$( "#nom" ).val( ui.item.label );
					return false;
			},
                //minLength : 1 // on indique qu'il faut taper au moins 2 caract?res pour afficher l'autocompl?t
    select : function(event, ui){ // lors de la sélection d'une proposition
			$( '#nom' ).val( ui.item.label);     
			$('#id_compte').val(ui.item.value);
			$('#description').html( ui.item.desc );// on ajoute la description de l'objet dans un bloc
			return false;
            }
          })
          .autocomplete( "instance" )._renderItem = function( ul, item ) {
            return $( "<li>" )
              .append( "<div>" + item.label + "(" + item.desc + ") </div>" )
              .appendTo( ul );
          };
        } );    
    </script> 
	<script src="validation_formdiagnostic.js"></script>
	</body>
</html>
