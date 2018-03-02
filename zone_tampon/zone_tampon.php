<html>
    <head>
        <META charset="UTF-8">
       <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/themes/smoothness/jquery-ui.css" />
        
         <script type="text/javascript" src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
        <SCRIPT TYPE="text/javascript" LANGUAGE = "Javascript">
            //verifier si le veto a check une case
       function Checked() {
           if($('#zt_type').is(':checked'))
{
           var count=$('#checkboxes input:checked').length;
           if(count > 0){             
               return (true);
            } else {    
                alert("Cochez un d√©partement");
                return(false);
            }
       
       
                       }
                       
    }
        </SCRIPT>
    </head>
    <body>
        
        
       
        <h1>Ajouter des zones tampons</h1>
        <?php

            require "../general/connexionPostgreSQL.class.php";
            $connex = new connexionPostgreSQL();
            $result1 = $connex->requete("SELECT libelle_maladie, id_maladie FROM maladie");
            $result2 = $connex->requete("SELECT id_dpt, libelle_dep FROM departement");
             $result3 =  $connex->requete("SELECT id_zone_tampon FROM zone_tampon ORDER BY id_zone_tampon"); //s√©lectionne le premier id  de transhumance disponible
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



           $array = array(); // on crÈÈ le tableau 

           while ($row = pg_fetch_array($result4))   // on effectue une boucle pour obtenir les donnÈes 
           { 
               //$array[]=$row['nom_commune']." (".$row['code_postal'].")"; // et on ajoute celles-ci ‡ notre tableau 
                   array_push($array,array('value'=>$row[0],'label'=>$row[1],'desc'=>$row[2]));
           }  

                   // Affichage des r√©sultats en HTML
                   // Lib√®re le r√©sultat
            
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
                select : function(event, ui){ // lors de la sÈlection d'une proposition
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
            
         
         
               <FORM METHOD = "POST" ACTION = "confirmation_zone_tampon.php" ONSUBMIT = "return Checked()">
                   <label>Id zone Tampon</label>:
                    <?php echo "<td><input type='text' name='id_zt' value = '$id' readonly ></td>" ?>  <br><br>
           
                    <select name="liste_maladie"><?php

                while ($line = pg_fetch_array($result1) ){
        
                    echo "<option id = ".$line[0]." value =".$line[1].">".$line[0]."</option>";
    
                }
    
            ?></select>
            <BR/>Commune : <input type='text' id="commune" name='commune' value ='' >
                   <input type='hidden' id='commune_id' name="commune" value =''>
            
       

        <BR/><BR/>


            <INPUT TYPE = "radio" ID="zt_type2" NAME = "zt_type" VALUE = 1 checked> Zone tampon par rayon autour du foyer <BR/>
                Rayon : <INPUT TYPE = "text" NAME = "zt_rayon" PATTERN = "\d+(,\d{2})?"> km
        
        
            <BR/><BR/>
                
            <INPUT TYPE = "radio" ID="zt_type" NAME = "zt_type" VALUE = 2> Zone tampon par d√©partement <BR/><BR/>
                <?php
                  echo "<div id='checkboxes'>";
                while ($line = pg_fetch_array($result2)){
                    echo "<INPUT TYPE ='checkbox' NAME = 'departement[]' VALUE = ".$line[0]."> ".$line[1]."<BR/>";
                }
                  echo "</div>";
                ?>
                <BR/>
                
                  <?php
                echo "Date de fin de quarantaine :<BR/><INPUT TYPE = 'date' VALUE = ".getdate().">";
            ?>
            <INPUT TYPE = "SUBMIT" NAME = "zt_ajout" VALUE = "Ajouter cette zone tampon">
                    
      
          
        </FORM>
    </body>
</html>