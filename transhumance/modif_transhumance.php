<?php session_start(); ?>
<html>
    <head>
        <title>Modifier une transhumance</title>
        <META charset="UTF-8"/>
        
        <!--- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <!-- inclusion du style CSS de base -->
        <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/themes/smoothness/jquery-ui.css" />
        
         <script type="text/javascript" src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
        <link rel="icon" href="sonnaille.ico">
           <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/themes/smoothness/jquery-ui.css" />
        
         <script type="text/javascript" src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
       
    </head>
    <body>
        <?php
        include('../general/Front/navigation.php');

        $connex = new connexionPostgreSQL();

        //Récupération de l'id_transhumance à modifier
		$id_transhumance = $_GET["id_lot_mvt"];
                
        // Éxecution de la requête
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
        
        //Requête pour récupérer les communes
        $rqt="SELECT nom_commune, code_postal FROM commune";
        $result2 = $connex->requete($rqt);
        
        $array = array(); // on créé le tableau 

        while ($row = pg_fetch_array($result2)){   // on effectue une boucle pour obtenir les données 
            array_push($array,array('value'=>$row[0],'label'=>$row[0],'desc'=>$row[1]));
        }  
        
        ?>
        
       <script type='text/javascript'>
            function valider() {
                var regexmot = /[(\d)]/g;
                var $msg = "";
                if (document.form.nom_responsable.value === "" || regexmot.test(document.form.nom_responsable.value)) {
                    $msg += "saisissez un nom  \n";
                }
                if (document.form.prenom_responsable.value === "" || regexmot.test(document.form.prenom_responsable.value)) {
                    $msg += "saisissez un prénom  \n";
                }
                if (document.form.num_responsable.value === "") {
                    $msg += "saisissez un numéro  \n";
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
        
        <!--Code pour l'autocomplétion-->
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

        <h1 class="sonnaille_titre">Modifier une transhumance intrarégionale</h1>
        
        <div class="fond_gris">
            <div class="padding">
                <h2>Renseignements responsable alpage</h2>
                <form method="post" action="valid_modif_transhumance.php" name='form' onsubmit='return valider()' >
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <?php echo "<input type='text' name='id_lot_mvt' value = '$id_transhumance' readonly >" ?> 
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                                <label for="inputNom">(*) Nom</label>
                                <input type='text' name='nom_responsable' value ='<?php echo "$nom_responsable"; ?>' pattern="^([A-Za-z]+[,.]?[ ]?|[A-Za-z]+['-]?)+$" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputNom">(*) Prenom</label>
                            <input type='text' name='prenom_responsable' value ='<?php echo "$prenom_responsable"; ?>' pattern="^([A-Za-z]+[,.]?[ ]?|[A-Za-z]+['-]?)+$" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                                    <label for="inputNom">(*) Numero</label>
                                    <input type='text' name='num_responsable' value ='<?php echo "$tel_responsable" ?>' pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" class="form-control">
                        </div>
                    </div>
                    <h2>Renseignements généraux</h2>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputDateDepart">(*)Date départ :</label>
                            <input type="date" class="form-control" id="inputDateDepart" placeholder="Date_depart" name="date_arrivee" value="<?php echo "$date_arrivee"; ?>">
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="inputDateSortie">(*)Date Arrivée :</label>
                                <input type="date" class="form-control" id="inputDateSortie" placeholder="Date_sortie" name="date_sortie" value="<?php echo "$date_depart"; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputDateDepart">(*)Commune de destination :</label>
                        <input type="text" class="form-control" id="commune" placeholder="Entrez la commune" name="commune" value ='<?php echo "$commune"; ?>'>
                        <input type="hidden" id="commune_id" name="commu">
                    </div> 
                    <div class="fond_gris">
                        <h2>Vos animaux déplacés</h2>
                        <br>
                        <div class="form-row align-items-center">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <i>Agés de moins de 6 mois</i>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <i>Agés de plus de 6 mois</i>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-1">
                                        Caprins                            
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type='text' name='nbr_cap_-' value ='<?php echo "$capr_msm"; ?>' pattern = "[0-9]+" class="form-control">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type='text' name='nbr_cap_-' value ='<?php echo "$capr_psm"; ?>' pattern = "[0-9]+" class="form-control">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-1">
                                        Ovins                           
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type='text' name='nbr_ov_-' value ='<?php echo "$ov_msm"; ?>' pattern = "[0-9]+" class="form-control">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type='text' name='nbr_ov_-' value ='<?php echo "$ov_psm"; ?>' pattern = "[0-9]+" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                (*) Description du marquage :<br>
                                <br>
                                <TEXTAREA class="textarea" name="marquage" rows=10 cols=40 placeholder='Description (forme,couleur,emplacement)' value='<?php echo "$description_marque"; ?>'></TEXTAREA>
                            </div>
                        </div>

                       <?php 
                       if($alp_collectif=='t'){ ?>
                        <div class='custom-control custom-radio custom-control-inline'>
                            <input type='radio' id='customRadioInline1' name='type_paturage' value='1' class='custom-control-input' checked/>
                            <label class='custom-control-label' for='customRadioInline1'>Alpage/Pâturage collectif</label>
                        </div>
                        <div class='custom-control custom-radio custom-control-inline'>
                            <input type='radio' id='customRadioInline2' name='type_paturage' class='custom-control-input' value='0' />
                            <label class='custom-control-label' for='customRadioInline2'>Alpage/Pâturage individuel</label>
                        </div>
                        <?php
                       } else { ?>
                        <div class='custom-control custom-radio custom-control-inline'>
                            <input type='radio' id='customRadioInline1' name='type_paturage' class='custom-control-input' value='1'/> 
                            <label class='custom-control-label' for='customRadioInline1'>Alpage/Pâturage collectif</label>
                        </div>
                        <div class='custom-control custom-radio custom-control-inline'>
                            <input type='radio' id='customRadioInline2' name='type_paturage' class='custom-control-input' value='0' checked/>
                            <label class='custom-control-label' for='customRadioInline2'>Alpage/Pâturage individuel</label>
                        </div>
                        <?php
                        }
                        ?>
                     </div>
                    <h2>Transporteur</h2>
                    <br>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputNom">Nom</label>
                            <input type="text" class="form-control" id="NomTransporteur" name='nom_transp' value ='<?php echo "$nom_transporteur"; ?>' pattern="^([A-Za-z]+[,.]?[ ]?|[A-Za-z]+['-]?)+$">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputNom">Adresse</label>
                            <input type='text' name='adresse_transp' value ='<?php echo "$adresse_transporteur"; ?>' class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputNom">Nom de l'entreprise</label>
                            <input type="text" class="form-control" id="entreprise" name='entreprise_transp' value ='<?php echo "$entreprise_transporteur"; ?>'>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputNom">Téléphone</label>
                            <input type='text'  name='tel_transp' pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" value ='<?php echo "$contact_transporteur" ?>' class="form-control">
                        </div>
                    </div>
                    <div class="center">
                        <input type='submit' class="btn bouton-sonnaille bouton-m"  name='bouton' value='Valider la DÃ©claration'>
                    </div>
                    <br>
                    <br>
                </form>
                <?php include ("../general/Front/footer.html"); ?>
            </div>
        </div>
    </body>
</html>




