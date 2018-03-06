<html>
    <head>
        <META charset="UTF-8">
       <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/themes/smoothness/jquery-ui.css" />
        
         <script type="text/javascript" src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
        <title> Ajout de zone tampon </title>
    <link rel="icon" href="sonnaille.ico">
        
    <!-- Load CSS--->
    <!--- Style Sonnaille-->
    <LINK rel="stylesheet" type="text/css" href="style.css">
    <!--- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
    <body>
        <?php include ("../general/Front/navigation_gds.html"); ?>

        
       <br>
        <h1 class="sonnaille_titre">Ajouter des zones tampons</h1>
        <br><br>
        <?php
		
			$id_zt = $_GET["id_zone_tampon"];
			
			require "../general/connexionPostgreSQL.class.php";
            $connex = new connexionPostgreSQL();
			
			//Récupère les champs correspondant à l'identifiant de la zone tampon que l'on veut récupérer
			$result = $connex->requete("SELECT m.libelle_maladie, cu.nom_exploitation, c.nom_commune, zt.rayon_prot, zt.rayon_surv, zt.date_fin
										FROM ((commune c JOIN compte_utilisateur cu ON c.id_commune=cu.id_commune) JOIN zone_tampon zt ON cu.id_compte=zt.id_compte)JOIN maladie m ON zt.id_maladie=m.id_maladie
										WHERE id_zone_tampon=$id_zt");
										
			while ($row=pg_fetch_array($result,null,PGSQL_NUM)){
				$libelle_maladie = $row[0];
				$nom_exploitation = $row[1];
				$nom_commune = $row[2];
				$rayon_prot = $row[3];
				$rayon_surv = $row[4];
				$date_fin = $row[5];
			}

            
            $result1 = $connex->requete("SELECT libelle_maladie, id_maladie FROM maladie");
            $result2 = $connex->requete("SELECT id_dpt, libelle_dep FROM departement");
            $result3 =  $connex->requete("SELECT id_zone_tampon FROM zone_tampon ORDER BY id_zone_tampon"); //sÃ©lectionne le premier id  de transhumance disponible
            $nbre_col = pg_num_fields($result1);

            while ($row = pg_fetch_array($result3, null, PGSQL_NUM)) {

                if ($id < $row[0]) {
                    break;
                }
                $id++;
            }
            
                     $rqt="SELECT id_commune,nom_commune,code_postal FROM commune";
                   $result4 = $connex->requete($rqt);// j'effectue ma requ?te SQL gr?ce au mot-cl?

             // $result = pg_query("SELECT libelle FROM communes WHERE libelle LIKE '$term'"); 

            //$result->execute(array('commune' => '%'.$term.'%'));



           $array = array(); // on créé le tableau 

           while ($row = pg_fetch_array($result4))   // on effectue une boucle pour obtenir les données 
           { 
               //$array[]=$row['nom_commune']." (".$row['code_postal'].")"; // et on ajoute celles-ci à notre tableau 
                   array_push($array,array('value'=>$row[0],'label'=>$row[1],'desc'=>$row[2]));
           }  

                   // Affichage des rÃ©sultats en HTML
                   // LibÃ¨re le rÃ©sultat
           //Nom exploitant(gestion de l'autocomplÃ©tion) : 
            $rqt3="SELECT nom, nom_exploitation FROM compte_utilisateur WHERE id_type_utilisateur='2'";
            $result3 = $connex->requete($rqt3);// requÃªte SQL grÃ¢ce au mot-clÃ©
            $array3 = array(); // crÃ©ation du tableau

            while ($row = pg_fetch_array($result3)){   // boucle pour obtenir toutes les donnÃ©es
                        array_push($array3,array('value'=>$row[0],'label'=>$row[0],'desc'=>$row[1]));
            }  

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
			$('#exploi').autocomplete({ //apres le #
					source : liste2,  //a definir( c'est un fichier php)  
					focus: function( event, ui ) {
					$( "#nom" ).val( ui.item.label );
					return false;
			},
                //minLength : 1 // on indique qu'il faut taper au moins 2 caract?res pour afficher l'autocompl?t
    select : function(event, ui){ // lors de la sÃ©lection d'une proposition
			$( '#exploi' ).val( ui.item.label);     
			$('#id_compte').val(ui.item.value);
			$('#description2').html( ui.item.desc );// on ajoute la description de l'objet dans un bloc
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
            
         
         
               <FORM METHOD = "POST" ACTION = "valid_modif_zone_tampon.php" >
                <div class="fond_gris">
                   <div class="padding">
                        <div class="form-group col-md-6">
                           <label for="id_zt">Id zone Tampon</label>:
                            <?php echo "<input type='text' class='form-control' name='id_zt' value = '$id' readonly >" ?>
                       </div>
                       
                    <label>Maladie concernÃ©e</label>:
                    <select class="form-control form-control-lg" name="liste_maladie">
						<option selected><?php echo "$libelle_maladie"; ?>
                        <?php 
                        
							while ($line = pg_fetch_array($result1) ){
        
								echo "<option id = ".$line[0]." value =".$line[1].">".$line[0]."</option>";
							}
    
                    ?>    
                    </select>
                       
                    <br>
                    <BR/>
                    <div class= "form-row">
                       <div class="form-group col-lg-6">
                            <label for="exploi">Nom de l'exploitation</label>
                            <input type='text' class="form-control" id="exploi" name="exploi" value="<?php echo "$nom_exploitation"; ?>">
                            <input type="hidden" id="id_compte">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="commune">Commune</label>
                            <input type='text' class="form-control" id="commune" name='commune' value ='<?php echo "$nom_commune"; ?>' >
                            <input type='hidden' id='commune_id' name="commu" value =''>
                        </div>
                    </div>                  
            
                   </div>
                    </div>

        <BR/>
            <div class="padding">

           <i>Rayon autour du foyer</i> <br><br>
                <div class="form-row">
                    <div class="form-group col-lg-6">
                        <label for="zt_rayon">Rayon de protection</label>
                        <div class="input-group mb-2">
                            <INPUT TYPE = "text" class="form-control" NAME = "zt_rayon" PATTERN = "\d+(,\d{2})?" id="zt_rayon" value='<?php echo "$rayon_prot"; ?>'>
                            <div class="input-group-prepend">
                              <div class="input-group-text">km</div>
                            </div>
                      </div>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="zt_rayon2">Rayon de surveillance</label>
                        <div class="input-group mb-2">
                             <INPUT TYPE = "text" class="form-control" NAME = "zt_rayon2" PATTERN = "\d+(,\d{2})?" id="zt_rayon2" value='<?php echo "$rayon_surv"; ?>'>
                            <div class="input-group-prepend">
                              <div class="input-group-text">km</div>
                            </div>
                      </div>
                    </div>
                </div>
        
                
                <div class="form-row col-lg-6">
                    <label for="datefin">Date de fin de quarantaine </label>
                    <INPUT  TYPE = 'date' class="form-control" NAME='datefin' ID="datefin" value='<?php echo "$date_fin"; ?>'>
                </div>
            </div>
                
            <br>
           <div class="center">
                <INPUT TYPE = "SUBMIT"  class="btn bouton-sonnaille bouton-m" NAME = "zt_ajout" VALUE = "Ajouter cette zone tampon">
            </div>
            <br>       
                    
          
        </FORM>
        <?php include ("../general/Front/footer.html"); ?> 
    </body>
</html>