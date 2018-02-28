<html>
<head> 
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
<!--By les Pokemen-->
    <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/themes/smoothness/jquery-ui.css" />
    <script type="text/javascript" src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href='../general/front/style.css'>
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
		<form method = 'POST' name = 'form_eleveur' action = 'validation_compte_utilisateur.php'>
            <h4>Type de compte:</h4>
                <INPUT type = radio name = rb value = 'DDPP' ><label>DDPP</label></INPUT>
                <INPUT type = radio name = rb value = 'GDS'><label>GDS</label> </INPUT>
                <INPUT type = radio name = rb value = 'veterinaire'><label>Vétérinaire / GTV </label></INPUT>
                <INPUT type = radio name = rb value = 'laboratoire'><label>Laboratoire </label></INPUT>
                <INPUT type = radio name = rb value = 'eleveur'><label>Eleveur</label></INPUT>
            <br/><br/>
                
            <label for="Login">Login :</label> 
                <input type=text name='login' placeholder='Login'><br/><br/>
            
            <label for="Mot de Passe">Mot de passe :</label>
                <input type=password name='mot_de_passe' placeholder='Mot de Passe'><br/><br/>
            
            <label for="Nom">Nom : </label>
                <input type=text name='nom' placeholder='Nom'><br/><br/>
            
            <label for="Adresse">Adresse : </label>
                <input type=text name='adresse' placeholder='Adresse' size = 100><br/><br/>
            
            <label for="Adresse (suite)">Adresse (suite) : </label>
            <input type=text name='adresse2' placeholder='Adresse (suite)' size = 100><br/><br/>
            
            <label for="Commune">Commune : </label>
                <input type=text id='commune' name='commu' placeholder='Commune' size = 75> 
                <input type='hidden' id='commune_id' name="commune" value =''> <br/> <br/> 
            
            <label for="Code Postal">Code postal : </label>
                <input type=text id='code_postal' name='code_postal' placeholder='Code Postal' size = 20><br/><br/> 
            
            <label for="Numéro de Téléphone">Téléphone :</label>
                <input type=tel name='telephone' placeholder='Numéro de Téléphone'><br/><br/> 
            
            <label for="Adresse Mail">Adresse mail : </label>
            <input type=email name='mail' placeholder='Adresse Mail'><br/><br/><br/>
            
            <input type="submit" name="bt_submit" value="Valider"><br/><br/>
        </form>
        <?php include('../general/front/footer.html');?>
        </div>
	</body>
</html>