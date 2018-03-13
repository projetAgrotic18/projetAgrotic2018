<?php session_start();?>
<html>
    
        <META charset="UTF-8">  
        
    
<!-- Load CSS--->
    <!--- Style Sonnaille-->
    <LINK rel="stylesheet" type="text/css" href="style.css">
    <!--- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
 <!-- inclusion du style CSS de base -->
	<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/themes/smoothness/jquery-ui.css" />
        
         <script type="text/javascript" src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
        <title>Déclaration de transhumance</title>
        <link rel="icon" href="sonnaille.ico">
       
    </head>
    <body>
        <?php include ("../general/Front/navigation.php"); ?>
        
        <?php
            require "../general/connexionPostgreSQL.class.php";
            // Connexion, sélection de la base de données du projet

            $connex = new connexionPostgreSQL();
            
            $result =  $connex->requete("SELECT nom,portable,mail FROM compte_utilisateur WHERE id_compte = ".$_SESSION['id_compte']." ") ;
            while ($row = pg_fetch_array($result, null, PGSQL_NUM)) {
                $nom = $row[0];
                $num = $row[1];
                $mail = $row[2];
            }
	
            // Exécution de la requête SQL

            $result1 =  $connex->requete("SELECT id_lot_mvt FROM lot_mvt ORDER BY id_lot_mvt"); //sélectionne le premier id  de transhumance disponible
            $nbre_col = pg_num_fields($result1);
            $id = 1;

            while ($row = pg_fetch_array($result1, null, PGSQL_NUM)) {

                if ($id < $row[0]) {
                    break;
                }
                $id++;
            }
            
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
        <script type='text/javascript'>

            function valider() {
                
               
                var $msg = "";

                if (document.form1.nom_responsable.value === "" ) {
                    console.log('coucou');
                    $msg += "saisissez un nom  \n";
                }
                if (document.form1.prenom_responsable.value === "" ) {
                    console.log('coucou');
                    $msg += "saisissez un prénom  \n";
                }
                if (document.form1.num_responsable.value === "") {
                    $msg += "saisissez un numéro  \n";
                }
                if (document.form1.marquage.value === "") {
                    $msg += "saisissez un marquage \n";
                }
                if (document.form1.date_sortie.value === "") {
                    $msg += "saisissez une date de sortie \n";
                }
                if (document.form1.date_arrivee.value === "") {
                    $msg += "saisissez une date d'arrivee \n";
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
        


        <h1 class="sonnaille_titre">Déclarer une transhumance intrarégionale</h1>
        <div class="padding">(*) : champs obligatoires <br/></div>
        <br>
        <div class="fond_gris">
            <div class="padding">
                <h2>Renseignements responsable alpage</h2>
                <form method="post" action="validation_transhumance.php" name='form1' onsubmit='return valider()' >

                    <div class="form-row">
                    <div class="form-group col-md-6">
                            
                            <?php echo "<input type='hidden' name='id_lot_mvt'  value=$id />"; ?>
                    </div>
                    </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                            <label for="inputNom">(*) Nom</label>
                            <?php echo "<input type='text' name='nom_responsable' id= 'nom_responsable' value =  $nom  pattern='^([A-Za-z]+[,.]?[ ]?|[A-Za-z]+['-]?)+$' class='form-control'>";?>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputNom">(*) Prenom</label>
                        <input type='text' name='prenom_responsable' value ='' pattern="^([A-Za-z]+[,.]?[ ]?|[A-Za-z]+['-]?)+$" class="form-control">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="inputEmail4">Email</label>
                      <?php echo "<input type='email' class='form-control' id='inputEmail4' value = $mail>";?>
                    </div>
                    <div class="form-group col-md-6">
                                <label for="inputNom">(*) Numero</label>
                                <?php echo "<input type='text' name='num_responsable' value =$num pattern='^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$' class='form-control'>";?>
                        </div>
                </div>   

            </div>
        </div>
        
        <div class="padding">
            
            <h2>Renseignements généraux</h2>
                
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputDateDepart">(*)Date Début Transhumance :</label>
                    <input type="date" class="form-control" id="inputDateDepart" placeholder="Date_depart" name="date_arrivee">
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="inputDateSortie">(*)Date Fin Transhumance :</label>
                        <input type="date" class="form-control" id="inputDateSortie" placeholder="Date_sortie" name="date_sortie">
                    </div>
                </div>
            </div>
            

            <div class="form-group">
                <label for="inputDateDepart">(*)Commune de destination :</label>
                <input type="text" class="form-control" id="commune" placeholder="Entrez la commune" name="commune">
                <input type="hidden" id="commune_id" name="commu">
            </div> 
        </div>
            
            <div class="fond_gris">
            <div class="padding">
                
            <h2>Vos animaux déplacés</h2>
                <br>
            
            <div class="form-row align-items-center">
                    <div class="col-lg-6">
                        <!---<div class="form-row">
                            <div class="form-group col-md-2">
                                Caprins                            
                            </div>
                            <div class="form-group col-md-4">
                                <label for="nbrcap"><i>Ag�s de moins de 6 mois </i>:</label>
                                <input type='text' name='nbr_cap_-' value ='' pattern = "[0-9]+">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="nbrcap"><i>Ag�s de plus de 6 mois </i>:</label>
                                <input type='text' name='nbr_cap_-' value ='' pattern = "[0-9]+">
                            </div>
                        </div>-->
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
                                <input type='text' name='nbr_cap_-' value ='' pattern = "[0-9]+" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <input type='text' name='nbr_cap_-' value ='' pattern = "[0-9]+" class="form-control">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-1">
                                Ovins                           
                            </div>
                            <div class="form-group col-md-4">
                                <input type='text' name='nbr_ov_-' value ='' pattern = "[0-9]+" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <input type='text' name='nbr_ov_-' value ='' pattern = "[0-9]+" class="form-control">
                            </div>
                        </div>
                        

                    </div>
                    <div class="col-lg-6">
                        (*) Description du marquage :<br>
                        <br>
                        <TEXTAREA class="textarea" name="marquage" rows=10 cols=40 placeholder='Description (forme,couleur,emplacement)'></TEXTAREA>
                    </div>
            </div>
                
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="customRadioInline1" name="type_paturage" class="custom-control-input" value=1 checked>
              <label class="custom-control-label" for="customRadioInline1">Alpage/Pâturage collectif</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="customRadioInline2" name="type_paturage" class="custom-control-input" value=0>
              <label class="custom-control-label" for="customRadioInline2">Alpage/Pâturage individuel</label>
            </div>
                </div>
            </div>
            
            <div class="padding">
                <h2>Transporteur</h2>
                <br>
                <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="inputNom">Nom</label>
                      <input type="text" class="form-control" id="NomTransporteur" name='nom_transp' value ='' pattern="^([A-Za-z]+[,.]?[ ]?|[A-Za-z]+['-]?)+$">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputNom">Adresse</label>
                        <input type='text' name='adresse_transp' value ='' class="form-control">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="inputNom">Nom de l'entreprise</label>
                      <input type="text" class="form-control" id="entreprise" name='entreprise_transp' value =''>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputNom">Téléphone</label>
                        <input type='text'  name='tel_transp' pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" value ='' class="form-control">
                    </div>
                </div>
            
            <!--    
            <table>
                <tr>
                    <td>
                        <label>Nom  </label>
                    </td>
                    <td>
                        <input type='text' name='nom_transp' value ='' pattern="^([A-Za-z]+[,.]?[ ]?|[A-Za-z]+['-]?)+$">
                    </td>
                    <td>
                        <label> Adresse </label>
                    </td>
                    <td>
                        <input type='text' name='adresse_transp' value =''>
                    </td>
                    
                </tr>
                <tr>
                    <td>
                        <label>Nom de l'entreprise  </label>
                    </td>
                    <td>
                        <input type='text' name='entreprise_transp' value =''>
                    </td>
                    <td>
                        <label> Téléphone </label>
                    </td>
                    <td>
                        <input type='text' name='tel_transp' pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" value =''>
                    </td>                  
                </tr>
                
            </table>
-->
            </div>
            <div class="center">
            <input type='submit' class="btn bouton-sonnaille bouton-m"  name='bouton' value='Valider la Déclaration'>
            </div>
                <br>
                <br>
        </form>
    <?php include ("../general/Front/footer.html"); ?>         
        
            </body>
    </META>
</html>




