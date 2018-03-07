<html>
    <head>
                <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
          
        <title>Déclaration de transhumance</title>
 <!-- inclusion du style CSS de base -->
	<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/themes/smoothness/jquery-ui.css" />
    </head>
    <body>
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
                if (document.form.num_responsable.value === "" ) {
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
         
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/jquery-ui.min.js"></script>
            
          
            
          
       <script type="text/javascript"> 
              //   Charge la version 1.4.1. 
          //  google.load('jquery','1.4.1'); 
             $(function() {      
         $('#commune').autocomplete({  //apres le # 
          source : 'fonction.php',  //a definir(c'est un fichier php)  
          minLength : 2 // on indique qu'il faut taper au moins 2 caract?res pour afficher l'autocompl?t
        }); 
        })(jQuery); 
            
        </script> 
        
            
        </script>  
           
  


     

        <h1 align="center"><b>Déclarer une transhumance intrarégionale</b></h1>
        <h2>Renseignements responsable alpage</h2>
        <form method="post" action="validation_transhumance.php" name='form' onsubmit='return valider()' >
            <table>

                <tr>
                    <td><label>(*)Nom</label> :</td>
                    <td><input type='text' name='nom_responsable' value ='' pattern="^([A-Za-z]+[,.]?[ ]?|[A-Za-z]+['-]?)+$"></td>
                </tr>
                <tr>
                    <td><label>(*)Prénom</label> :</td>
                    <td><input type='text' name='prenom_responsable' value ='' pattern="^([A-Za-z]+[,.]?[ ]?|[A-Za-z]+['-]?)+$"></td>
                </tr>
                <tr>
                    <td> <label>(*)Numéro de téléphone :</label></td>
                    <td><input type='tel' pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" name='num_responsable' value =''></td>
                </tr>
            </table>
            <h2>Renseignements généraux</h2>
            (*)Date départ : 
            <input id="date_debut" type="date">
            (*)Date fin :
            <input id="date_fin" type="date"><br><br>
            <label>(*)Commune de destination :</label>
            <input type='text' id="commune" name="commune" value ='' pattern="^([A-Za-z]+[,.]?[ ]?|[A-Za-z]+['-]?)+$">
            <h2>Vos animaux déplacés</h2>
            <table>
                <tr>
                    <td>

                    </td>
                    <td>
                        Agés de moins de 6 mois
                    </td>
                    <td>
                        Agés de plus de 6 mois
                    </td>

                </tr>
                <tr>
                    <td>
                        Caprins
                    </td>
                    <td>
                        <input type='text' name='nbr_cap_-' value ='' pattern = "[0-9]+">
                    </td>
                    <td>
                        <input type='text' name='nbr_cap_+' value ='' pattern = "[0-9]+">
                    </td>

                </tr>
                <tr>
                    <td>
                        Ovins
                    </td>
                    <td>
                        <input type='text' name='nbr_ov_-' value ='' pattern = "[0-9]+">
                    </td>
                    <td>
                        <input type='text' name='nbr_ov_+' value ='' pattern = "[0-9]+">
                    </td>


                </tr>
            </table>
            Description du marquage :<br>
            <TEXTAREA name="marquage" rows=10 cols=40></TEXTAREA><Br><br>
            
            <input type="radio" name="type_paturage" value="collectif" checked /> Alpage/Pâturage collectif
            <input type="radio" name="type_paturage" value="individuel" /> Alpage/Pâturage individuel
            <h2>Transporteur</h2>
            <table>
                <tr>
                    <td>
                        <label>Nom :</label>
                    </td>
                    <td>
                        <input type='text' name='nom_transp' value =''>
                    </td>
                    <td>
                        <label>Adresse</label>
                    </td>
                    <td>
                        <input type='text' name='adresse_transp' value =''>
                    </td>
                    
                </tr>
                <tr>
                    <td>
                        <label>Nom de l'entreprise</label>
                    </td>
                    <td>
                        <input type='text' name='entreprise_trans' value =''>
                    </td>
                    <td>
                        <label>Téléphone</label>
                    </td>
                    <td>
                        <input type='text' name='tel_transp' value =''>
                    </td>                  
                </tr>
                
            </table>
            <input type='submit'   name='bouton' value='valider'>
            

        </form>
    </body>




