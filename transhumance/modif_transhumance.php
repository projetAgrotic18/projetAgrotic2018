<html>
    <head>
        <title>DÃ©claration de transhumance</title>
           <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/themes/smoothness/jquery-ui.css" />
        
         <script type="text/javascript" src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
       
    </head>
    <body>
        <?php
// Connexion, sÃ©lection de la base de donnÃ©es

        require "../general/connexionPostgreSQL.class.php";

        $connex = new connexionPostgreSQL();

// ExÃ©cution de la requÃªte SQL

		$id_transhumance = $_GET["id_lot_mvt"];

// R&cupÃ©ration des champs correspondant Ã  la transhumance que l'on veut modifier

		$result = $connex->requete("SELECT * FROM lot_mvt lm JOIN commune c ON lm.id_commune = c.id_commune WHERE lm.id_lot_mvt=".$id_transhumance);
		while ($row=pg_fetch_array($result,null,PGSQL_NUM)){
			$date_arrivee = $row[3];
			$date_depart = $row[4];
			$description_marque = $row[5];
			$nom_responsable = $row[6];
			$tel_responsable = $row[7];
			$nom_transporteur = $row[8];
			$contact_transporteur = $row[9];
			$alp_collectif = $row[10];
			$capr_msm = $row[11];
			$capr_psm = $row[12];
			$ov_msm = $row[13];
			$ov_psm = $row[14];
			$prenom_responsable = $row[15];
			$adresse_transporteur = $row[16];
			$entreprise_transporteur = $row[17];
			$commune = $row[20];
		}
	
                
                       $rqt="SELECT nom_commune,code_postal FROM commune";
                   $result2 = $connex->requete($rqt);// j'effectue ma requ?te SQL gr?ce au mot-cl?

             // $result = pg_query("SELECT libelle FROM communes WHERE libelle LIKE '$term'"); 

            //$result->execute(array('commune' => '%'.$term.'%'));

                   

           $array = array(); // on créé le tableau 

           while ($row = pg_fetch_array($result2))   // on effectue une boucle pour obtenir les données 
           { 
               //$array[]=$row['nom_commune']." (".$row['code_postal'].")"; // et on ajoute celles-ci à notre tableau 
                   array_push($array,array('value'=>$row[0],'label'=>$row[0],'desc'=>$row[1]));
           }  
// Affichage des rÃ©sultats en HTML
// LibÃ¨re le rÃ©sultat

        
// Ferme la connexion
      
        $connex->fermer();
        ?>
        <script type='text/javascript'>

            function valider() {

                var regexmot = /[(\d)]/g;
                var $msg = "";

                if (document.form.nom_responsable.value === "" || regexmot.test(document.form.nom_responsable.value)) {
                    $msg += "saisissez un nom  \n";
                }
                if (document.form.prenom_responsable.value === "" || regexmot.test(document.form.prenom_responsable.value)) {
                    $msg += "saisissez un prÃ©nom  \n";
                }
                if (document.form.num_responsable.value === "") {
                    $msg += "saisissez un numÃ©ro  \n";
                }

                if ($msg === "") {
                    return true;
                } else {
                    alert($msg);

                    return false;
                }

            }

        </script>

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

        <h1 align="center"><b>DÃ©clarer une transhumance intrarÃ©gionale</b></h1>
        <h2>Renseignements responsable alpage</h2>
        <form method="post" action="valid_modif_transhumance.php" name='form' onsubmit='return valider()' >
            <table>
                <tr>
                    <td><label>Id Transhumance</label> :</td>
                    <?php echo "<td><input type='text' name='id_lot_mvt' value = '$id_transhumance' readonly ></td>" ?> 
                </tr>
                <tr>
                    <td><label>(*)Nom</label> :</td>
                    <td><input type='text' name='nom_responsable' value ='<?php echo "$nom_responsable"; ?>' pattern="^([A-Za-z]+[,.]?[ ]?|[A-Za-z]+['-]?)+$"></td>
                </tr>
                <tr>
                    <td><label>(*)PrÃ©nom</label> :</td>
                    <td><input type='text' name='prenom_responsable' value ='<?php echo "$prenom_responsable"; ?>' pattern="^([A-Za-z]+[,.]?[ ]?|[A-Za-z]+['-]?)+$"></td>
                </tr>
                <tr>
                    <td> <label>(*)NumÃ©ro de tÃ©lÃ©phone :</label></td>
                    <td><input type='tel' pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" name='num_responsable' value ='<?php echo "$tel_responsable" ?>'></td>
                </tr>
            </table>
            <h2>Renseignements gÃ©nÃ©raux</h2>
            (*)Date dÃ©part : 
            <input name="date_arrivee" type="date" value="<?php echo "$date_arrivee"; ?>">
            (*)Date fin :
            <input name="date_sortie" type="date" value="<?php echo "$date_depart"; ?>"><br><br>
            <label>(*)Commune de destination :</label>
            <input type='text' id="commune" name='commune' value ='<?php echo "$commune"; ?>' pattern="^([A-Za-z]+[,.]?[ ]?|[A-Za-z]+['-]?)+$">
              <input type='hidden' id='commune_id' name="commu" value ='<?php echo "$commune"; ?>'>
            <h2>Vos animaux dÃ©placÃ©s</h2>
            <table>
                <tr>
                    <td>

                    </td>
                    <td>
                        AgÃ©s de moins de 6 mois
                    </td>
                    <td>
                        AgÃ©s de plus de 6 mois
                    </td>

                </tr>
                <tr>
                    <td>
                        Caprins
                    </td>
                    <td>
                        <input type='text' name='nbr_cap_-' value ='<?php echo "$capr_msm"; ?>' pattern = "[0-9]+">
                    </td>
                    <td>
                        <input type='text' name='nbr_cap_+' value ='<?php echo "$capr_psm"; ?>' pattern = "[0-9]+">
                    </td>

                </tr>
                <tr>
                    <td>
                        Ovins
                    </td>
                    <td>
                        <input type='text' name='nbr_ov_-' value ='<?php echo "$ov_msm"; ?>' pattern = "[0-9]+">
                    </td>
                    <td>
                        <input type='text' name='nbr_ov_+' value ='<?php echo "$ov_psm"; ?>' pattern = "[0-9]+">
                    </td>


                </tr>
            </table>
            Description du marquage :<br>
            <TEXTAREA name="marquage" rows=10 cols=40><?php echo "$description_marque"; ?></TEXTAREA><Br><br>
           <?php 
           if($alp_collectif=='t'){
               echo "<input type='radio' name='type_paturage' value='1' checked/> Alpage/PÃ¢turage collectif";
               echo "<input type='radio' name='type_paturage' value='0' /> Alpage/PÃ¢turage individuel";
           } else {
            echo "<input type='radio' name='type_paturage' value='1' /> Alpage/PÃ¢turage collectif";
             echo "<input type='radio' name='type_paturage' value='0' checked /> Alpage/PÃ¢turage individuel";
           }
           ?>     
            <h2>Transporteur</h2>
            <table>
                <tr>
                    <td>
                        <label>Nom :</label>
                    </td>
                    <td>
                        <input type='text' name='nom_transp' value ='<?php echo "$nom_transporteur"; ?>' pattern="^([A-Za-z]+[,.]?[ ]?|[A-Za-z]+['-]?)+$">
                    </td>
                    <td>
                        <label>Adresse</label>
                    </td>
                    <td>
                        <input type='text' name='adresse_transp' value ='<?php echo "$adresse_transporteur"; ?>'>
                    </td>
                    
                </tr>
                <tr>
                    <td>
                        <label>Nom de l'entreprise</label>
                    </td>
                    <td>
                        <input type='text' name='entreprise_transp' value ='<?php echo "$entreprise_transporteur"; ?>'>
                    </td>
                    <td>
                        <label>TÃ©lÃ©phone</label>
                    </td>
                    <td>
                        <input type='text' name='tel_transp' pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" value ='<?php echo "$contact_transporteur" ?>'>
                    </td>                  
                </tr>
                
            </table>
            <input type='submit'   name='bouton' value='valider'></Br>
        </form>
    </body>
</html>