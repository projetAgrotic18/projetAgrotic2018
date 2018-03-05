<html>
    <head>
        <META charset="UTF-8">
       <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/themes/smoothness/jquery-ui.css" />
        
         <script type="text/javascript" src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
    
    </head>
    <body>
        
        
       
        <h1>Ajouter des zones tampons</h1>
        <?php

            require "../general/connexionPostgreSQL.class.php";
            $connex = new connexionPostgreSQL();
            $result1 = $connex->requete("SELECT libelle_maladie, id_maladie FROM maladie");
            $result2 = $connex->requete("SELECT id_dpt, libelle_dep FROM departement");
             $result3 =  $connex->requete("SELECT id_zone_tampon FROM zone_tampon ORDER BY id_zone_tampon"); //sÃ©lectionne le premier id  de transhumance disponible
            $nbre_col = pg_num_fields($result1);
            $id = 1;

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
            
         
         
               <FORM METHOD = "POST" ACTION = "confirmation_zone_tampon.php" >
                   <label>Id zone Tampon</label>:
                    <?php echo "<td><input type='text' name='id_zt' value = '$id' readonly ></td>" ?>  <br><br>
                    
                    <label>Maladie concernée</label>:
                    <select name="liste_maladie"><?php 
                        
                while ($line = pg_fetch_array($result1) ){
        
                    echo "<option id = ".$line[0]." value =".$line[1].">".$line[0]."</option>";
    
                }
                
            ?>
                    </select>
                    <br>
                    <BR/>
                    Nom de l'exploitation: <input type='text' id="exploi" name="exploi" value="">
                    <input type="hidden" id="id_compte">
            <BR/>Commune : <input type='text' id="commune" name='commune' value ='' >
                   <input type='hidden' id='commune_id' name="commu" value =''>
            
       

        <BR/><BR/>


           Rayon autour du foyer <BR/>
                Rayon de protection : <INPUT TYPE = "text" NAME = "zt_rayon" PATTERN = "\d+(,\d{2})?"> km <BR/>
                Rayon de surveillance : <input TYPE = "text" NAME = "zt_rayon2" PATTERN = "\d+(,\d{2})?"> km
        
            <BR/><BR/>
                
    
                <BR/>
                
                  
                 Date de fin de quarantaine :<BR/><INPUT  TYPE = 'date' NAME='datefin'>
           
            <INPUT TYPE = "SUBMIT" NAME = "zt_ajout" VALUE = "Ajouter cette zone tampon">
                    
      
          
        </FORM>
    </body>
</html>