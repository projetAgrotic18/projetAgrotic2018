<?php session_start() ?>
<html>
	<head>
	<META charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/themes/smoothness/jquery-ui.css" />
	<script src="https://code.jquery.com/jquery-3.3.1.min.js">
	</script>

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
		//if (document.formsaisie.commune.value == "")
		//{
		//	ok = 0;
		//	msg = msg + "[Lieu du diagnostic]";
		//}
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
         
         
	<form method="GET" action="diagnostic_v3_2.php" onsubmit="return valider()" name="formsaisie">
	
	<h1>Diagnostic vétérinaire</h1>
	(*) : champs obligatoires <br/>	
	
	<!--Caractéristiques-->
	<h2>Caractéristiques générales :</h2>
	* Nom de l'exploitant : <br/>
	<input type="text" name="nom_exploitant" size="20"><br/>
	  Nom de l'exploitation : <br/>
	<input type="text" name="nom_exploitation" size="20"><br/>
	<!-- A mettre en autocomplétion en fonction du nom de l'exploitant -->
	<!-- Si homonymes, une liste de suggestion des noms d'exploitation des homonymes sera fournie -->
	* Commune du diagnostic : <br/>
	<input type="text" id='commune' name="commune" size="20" value =''><br/>
        <input tpye='hidden' name="commu" id="commune_id" value =''>
        
	<!-- Champ autocomplété quand les 2 champs "nom exploitant" et "nom exploitation" sont remplis -->
	* Date du diagnostic : <br/>
	<input type="date" name="date" size="10"><br/><br/>
	<!-- La date du jour est récupérée sur l'ordi -->
	
	<h2>Caractéristiques du diagnostic :</h2>
	* Espèce : <br/>	
	<input type=radio name="espece" value="1">Bovin
	<input type=radio name="espece" value="2">Ovin
	<input type=radio name="espece" value="3">Caprin
	<br/><br/>
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
	echo "<br/>";
	echo "<span id='actuFormulaire_maladie'></id>";

	//Maladies :
	echo "<br/>Maladies : <br/>";
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
        
         $rqt="SELECT nom_commune,code_postal FROM commune";
                   $result2 = $connex->requete($rqt);// j'effectue ma requ?te SQL gr?ce au mot-cl?

             // $result = pg_query("SELECT libelle FROM communes WHERE libelle LIKE '$term'"); 

            //$result->execute(array('commune' => '%'.$term.'%'));
           $array = array(); // on cr�� le tableau 

           while ($row = pg_fetch_array($result2))   // on effectue une boucle pour obtenir les donn�es 
           { 
               //$array[]=$row['nom_commune']." (".$row['code_postal'].")"; // et on ajoute celles-ci � notre tableau 
                   array_push($array,array('value'=>$row[0],'label'=>$row[0],'desc'=>$row[1]));
           }  

                   // Affichage des résultats en HTML
                   // Libère le résultat


                   // Ferme la connexion
            $connex->fermer();
	?>
	
        
	Préconisations : <br/>
	<input type="text" name="preconisation" size="150"><br/><br/>
		
	<input type="submit" value="Ajouter ce diagnostic">
	</form>
                
             <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
            
          
            
          
       <script type="text/javascript"> 

                    //   Charge la version 1.4.1. 
                //  google.load('jquery','1.4.1'); 
                var liste= <?php echo json_encode($array);?>;
                   $(function () {      
               $('#commune').autocomplete({ //apres le #
                source : liste,  //a definir(c'est un fichier php)  
                focus: function( event, ui ) {
              $( "#commune" ).val( ui.item.label );
              return false;
              },
                //minLength : 1 // on indique qu'il faut taper au moins 2 caract?res pour afficher l'autocompl?t
                select : function(event, ui){ // lors de la s�lection d'une proposition
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
        
           
        </script>
            
	</body>
</html>
