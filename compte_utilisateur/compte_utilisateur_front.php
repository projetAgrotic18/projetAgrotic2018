<html>
<head> 
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
<!--By les Pokemen-->
    <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/themes/smoothness/jquery-ui.css" />
    <script type="text/javascript" src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href='../general/front/style.css'>
    
<!-- Load CSS--->
    <!--- Style Sonnaille-->
    <LINK rel="stylesheet" type="text/css" href="style.css">
    <!--- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        
    <title> Création de Compte </title>
    <link rel="icon" href="sonnaille.ico">
	
	<!-- Partie ajax -->
	<script type="text/javascript">

	function afficheNomExploit(str){
		$.ajax({
			type: 'get',
			url: 'majNomExploit.php',
			data: {
				rb:str
				},
			success: function (response) {
				document.getElementById("txtNomExploit").innerHTML=response; 
			}
		});
	
	}
	
</script>
        
</head>
	<body>
        <?php 
            include('../general/front/navigation.html');
            echo "<center><h1 class='sonnaille_titre'>Création de compte Utilisateur</h1></center><br><br>";
            echo "<div class='padding'>";
 
            //Pour appeler la fonction d'ouverture de la BDD,
            //Mettre juste après la balise ouvrante de php (<?php) :
            require "../general/connexionPostgreSQL.class.php";

            //Puis la ligne suivante pour établir une connexion avec la BDD du projet :
            $connex = new connexionPostgreSQL();

            //Pour faire une requête sur la BDD du projet, écrire ENSUITE la ligne suivante :
            $rqt="SELECT nom_commune,code_postal FROM commune";
            $result = $connex->requete($rqt);// j'effectue ma requ?te SQL gr?ce au mot-cl?

            // $result = pg_query("SELECT libelle FROM communes WHERE libelle LIKE '$term'"); 
            //$result->execute(array('commune' => '%'.$term.'%'));

            $array = array(); // on créé le tableau 

            while ($row = pg_fetch_array($result))   // on effectue une boucle pour obtenir les données 
            { 
                //$array[]=$row['nom_commune']." (".$row['code_postal'].")"; // et on ajoute celles-ci à notre tableau 
                    array_push($array,array('value'=>$row[0],'label'=>$row[0],'desc'=>$row[1]));
            }  

            $connex->fermer; 

        ?>
            
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
		<script type="text/javascript" src="confirm_valid.js"></script>

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
                    select : function(event, ui){ // lors de la sélection d'une proposition
                        $( '#commune' ).val( ui.item.label);     
                        $('#commune_id').val(ui.item.value);
                        $('#code_postal').val( ui.item.desc );// on ajoute la description de l'objet dans un bloc
                        return false;
                    }
                })
                .autocomplete( "instance" )._renderItem = function( ul, item ) {
                    return $( "<li>" )
                    .append( "<div>" + item.label + "(" + item.desc + ") </div>" )
                    .appendTo( ul );
                };
            });
        </script> 
        
<!-- !!!!!!!!!!!!!  DEBUT DE LA MISE EN FORME DE LA PAGE !!!!!!!!!!!!!!!!!!!-->
        
		<!-- Radio-boutonpour selectionner le type de formulaire à remplir-->
		<form method = 'POST' name = 'form_eleveur' action = 'validation_compte_utilisateur.php' onsubmit="return valid_compte_utilisateur()">
            
            <h4>Type de compte:</h4>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="customRadioInline1" name = rb class="custom-control-input"value = 'DDPP' onclick='afficheNomExploit(this.value)'>
                  <label class="custom-control-label" for="customRadioInline1">DDPP</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="customRadioInline2" name = rb class="custom-control-input" value = 'GDS' onclick='afficheNomExploit(this.value)'>
                  <label class="custom-control-label" for="customRadioInline2">GDS</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="customRadioInline3" name = rb class="custom-control-input" value = 'veterinaire' onclick='afficheNomExploit(this.value)'>
                  <label class="custom-control-label" for="customRadioInline3">Vétérinaire / GTV</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="customRadioInline4" name = rb class="custom-control-input" value = 'laboratoire' onclick='afficheNomExploit(this.value)'>
                  <label class="custom-control-label" for="customRadioInline4">Laboratoire </label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="customRadioInline5" name = rb class="custom-control-input" value = 'eleveur' onclick='afficheNomExploit(this.value)'>
                  <label class="custom-control-label" for="customRadioInline5">Eleveur</label>
                </div>

            <br/><br/>
            <div class="form-row">
                <div class="form-group col-lg-6">
                    <label for="Login">(*)Identifiant :</label>
                    <input type="text" class="form-control" placeholder="Identifiant" name="login">
                </div>
                <div class="form-group col-lg-6">
                    <label for="Mot de Passe">(*)Mot de Passe :</label>
                    <input type="text" class="form-control" placeholder="Mot de Passe" name='mot_de_passe'>
                </div>
            </div>
            <div class="form-group">
                <label for="Nom">(*)Nom :</label>
                <input type="text" class="form-control" placeholder="Nom" name='nom'>
            </div>
            
            <div class="form-group">
                <label for="Nom">(*)Adresse:</label>
                <input type="text" class="form-control" placeholder="Adresse" name='adresse'>
            </div>
            <div class="form-group">
                <label for="Nom">(*)Adresse (suite):</label>
                <input type="text" class="form-control" placeholder="Adresse (suite)" name='adresse2'>
            </div>
            <div class="form-row">
                <div class="form-group col-lg-6">
                    <label for="commune">(*)Commune :</label>
                    <input type="text" class="form-control" placeholder="Commune" name="commu" id='commune'>
                </div>
                <div class="form-group col-lg-6">
                    <label for="Code Postal">(*)Code postal :</label>
                    <input type="text" class="form-control" placeholder="Code Postal" name='code_postal' id='code_postal'>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-lg-6">
                    <label for="Numéro de Téléphone">(*)Téléphone :</label>
                    <input type="tel" class="form-control" placeholder="Numéro de Téléphone" name="telephone">
                </div>
                <div class="form-group col-lg-6">
                    <label for="Adresse Mail">(*)Adresse Mail :</label>
                    <input type="email" class="form-control" placeholder="Adresse Mail" name='mail'>
                </div>
            </div>
			<div class="form-group">
			    <span id="txtNomExploit" class="form-control"></span>
			</div>
        <br>
        <div class="center">
            <input type="submit" name="bt_submit" value="M'enregistrer" class="btn bouton-sonnaille bouton-m">
        </div>
        <br>
        </form>
        <?php include('../general/front/footer.html');?>

	</body>
</html>