<html>
    <head>
        <title>Déclaration de transhumance</title>

    </head>
    <body>
        <?php
// Connexion, sélection de la base de données

        $dbconn = pg_connect("host=194.199.251.139 port=5433 dbname=testprojet user=postgres password=postgres")
                or die('Connexion impossible : ' . pg_last_error());

// Exécution de la requête SQL

        $query1 = "SELECT id_transhumance FROM transhumances"; //sélectionne le premier id  de transhumance disponible
        $result1 = pg_query($query1) or die('Echec de la requête : ' . pg_error($link));
        $nbre_col = pg_num_fields($result1);
        $id = 1;

        while ($row = pg_fetch_array($result1)) {

            if ($id < $row[0]) {
                break;
            }
            $id++;
        }

// Affichage des résultats en HTML
// Libère le résultat

        
// Ferme la connexion

        pg_close($dbconn);
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



        <h1 align="center"><b>Déclarer une transhumance intrarégionale</b></h1>
        <h2>Renseignements responsable alpage</h2>
        <form method="post" action="validation_transhumance.php" name='form' onsubmit='return valider()' >
            <table>
                <tr>
                    <td><label>Id Transhumance</label> :</td>
                    <?php echo "<td><input type='text' name='id_transhumance' value = '$id' readonly ></td>" ?> 
                </tr>
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
            <input name="date_arrivee" type="date">
            (*)Date fin :
            <input name="date_sortie" type="date"><br><br>
            <label>(*)Commune de destination :</label>
            <input type='text' name='commune' value ='' pattern="^([A-Za-z]+[,.]?[ ]?|[A-Za-z]+['-]?)+$">
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
                        <input type='text' name='nom_transp' value ='' pattern="^([A-Za-z]+[,.]?[ ]?|[A-Za-z]+['-]?)+$">
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
                        <input type='text' name='entreprise_transp' value =''>
                    </td>
                    <td>
                        <label>Téléphone</label>
                    </td>
                    <td>
                        <input type='text' name='tel_transp' pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" value =''>
                    </td>                  
                </tr>
                
            </table>
            <input type='submit'   name='bouton' value='valider'>
            

        </form>
    </body>




