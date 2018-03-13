<?php session_start() ?>
<html>
<head>
    <META charset="UTF-8"/>
    <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/themes/smoothness/jquery-ui.css" />
    <script type="text/javascript" src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
    <title> Ajout de zone tampon </title>
</head>
<body>
    <!-- Lien vers la barre de navigation-->
    <?php include ("../general/front/navigation.php"); ?>

    <br>
    <h1 class="sonnaille_titre">Ajouter des zones tampons</h1>
    <br>
    <?php
        //Connexion à la base de donnée
        $connex = new connexionPostgreSQL();
        //Requête pour la liste déroulante des maladies
        $result1 = $connex->requete("SELECT libelle_maladie, id_maladie FROM maladie");
        //Requête qui sélectionne les départements
        $result2 = $connex->requete("SELECT id_dpt, libelle_dep FROM departement");
        //Requête qui permet de sélectionner le premier id de zone_tampon disponible
        $result5 =  $connex->requete("SELECT id_zone_tampon FROM zonetampon ORDER BY id_zone_tampon");
        $nbre_col = pg_num_fields($result1);
        $id = 1;

        while ($row = pg_fetch_array($result5, null, PGSQL_NUM)) {
            if ($id < $row[0]) {
                break;
            }
            $id++;
        }
        
        //Récupération des communes et stockage dans un tableau
            $rqt="SELECT id_commune,nom_commune,code_postal FROM commune ORDER BY nom_commune";
            $result4 = $connex->requete($rqt);
            // Création du tableau
            $array = array();  
            // Boucle pour obtenir la liste des communes
            while ($row = pg_fetch_array($result4))   
            { 
                // Ajout de celles-ci au tableau 
                array_push($array,array('value'=>$row[0],'label'=>$row[1],'desc'=>$row[2]));
            }  

        //Récupération des exploitations et stockage dans un tableau
            $rqt3="SELECT gid, nom_exploi, id_compte FROM exploitation2 join compte_utilisateur on nom_exploitation=nom_exploi ORDER BY nom_exploi";
            $result3 = $connex->requete($rqt3);
            $array3 = array();
            while ($row = pg_fetch_array($result3))
            {   
                array_push($array3,array('value'=>$row[2],'label'=>$row[1],'desc'=>$row[1]));
            } 
    ?>
    
    <!--Mise en place de l'autocomplétion-->    
    
    <!--Lien nécessaires-->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
   
    <script type="text/javascript"> 
        
        //Fonction d'autocomplétion pour le choix de la commune
        var liste= <?php echo json_encode($array);?>;
        $(function () {      
            $('#commune').autocomplete({ //Sélection du champ ou on veut mettre l'autocmplétion apres le #
                source : liste,  //definit plus haut(c'est un fichier php)  
                focus: function( event, ui ) {
                $( "#commune" ).val( ui.item.label );
                return false;
                },
                select : function(event, ui){ // Evènement lors de la sélection d'une proposition
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
        });
        
        //Fonction d'autocomplétion pour le choix de l'exploitation		
        var liste2= <?php echo json_encode($array3);?>;
        $(function () {      
            $('#exploi').autocomplete({
                source : liste2,
                focus: function( event, ui ) {
                    $( "#exploi" ).val( ui.item.label );
                    return false;
                },
                select : function(event, ui){
                    $( '#exploi' ).val( ui.item.label);
                    $('#id_compte').val(ui.item.value);
                    $('#description2').html( ui.item.desc );
                    return false;
                }
            })
            .autocomplete( "instance" )._renderItem = function( ul, item ) {
                return $( "<li>" )
                .append( "<div>" + item.label + "</div>" )
                .appendTo( ul );
            };
        });        
    </script>
    
    <!--Mise en place du formualire -->
    <FORM METHOD = "POST" ACTION = "confirmation_zone_tampon.php" >
        <div class="fond_gris">
            <div class="padding">
                <div class="form-group col-md-6">
                    <label for="id_zt">Id zone Tampon</label>:
                    <?php echo "<input type='text' class='form-control' name='id_zt' value = '$id' readonly >" ?>
                </div>    
                <label>Maladie concernée</label>:
                <select class="form-control form-control-lg" name="liste_maladie">
                    <?php 
                    while ($line = pg_fetch_array($result1) ){
                        echo "<option id = ".$line[0]." value =".$line[1].">".$line[0]."</option>";
                    }?>    
                </select> 
                    
                <BR/><BR/>
                <div class= "form-row">
                   <div class="form-group col-lg-6">
                        <label for="exploi">Nom de l'exploitation</label>
                        <input type='text' class="form-control" id="exploi" name='exploit' value="">
                        <input type="hidden" name="exploi" id="id_compte">
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="commune">Commune</label>
                        <input type='text' class="form-control" id="commune" name='commune' value ='' >
                        <input type='hidden' id='commune_id' name="commu" value =''>
                    </div>
                </div>                  
            </div>
        </div>

        <BR/>
        <div class="padding">
           <i>Rayon autour du foyer</i>
            <BR/><BR/>
            <div class="form-row">
                <div class="form-group col-lg-6">
                    <label for="zt_rayon">Rayon de protection</label>
                    <div class="input-group mb-2">
                        <INPUT TYPE = "text" class="form-control" NAME = "zt_rayon" PATTERN = "\d+(,\d{2})?" id="zt_rayon"/>
                        <div class="input-group-prepend">
                          <div class="input-group-text">km</div>
                        </div>
                  </div>
                </div>
                <div class="form-group col-lg-6">
                    <label for="zt_rayon2">Rayon de surveillance</label>
                    <div class="input-group mb-2">
                         <INPUT TYPE = "text" class="form-control" NAME = "zt_rayon2" PATTERN = "\d+(,\d{2})?" id="zt_rayon2"/>
                        <div class="input-group-prepend">
                          <div class="input-group-text">km</div>
                        </div>
                  </div>
                </div>
            </div>
                
            <div class="form-row col-lg-6">
                <label for="datefin">Date de fin de quarantaine </label>
                <INPUT  TYPE = 'date' class="form-control" NAME='datefin' ID="datefin"/>
            </div>
        </div>
                
        <BR/>
       <div class="center">
            <INPUT TYPE = "SUBMIT"  class="btn bouton-sonnaille bouton-m" NAME = "zt_ajout" VALUE = "Ajouter cette zone tampon"/>
        </div>
        <BR/>                   
          
    </FORM>
    <?php include ("../general/Front/footer.html"); ?> 
</body>
</html>